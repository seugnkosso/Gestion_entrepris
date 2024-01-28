<?php

namespace App\Controller;

use App\Entity\Vente;
use App\Entity\DetailVC;
use App\Entity\Payement;
use App\Entity\DetteParVente;
use App\Repository\UserRepository;
use App\Form\DetteParVenteFormType;
use App\Repository\PointRepository;
use App\Repository\VenteRepository;
use App\Repository\ProduitRepository;
use App\Repository\PayementRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DetteParVenteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetteParVenteController extends AbstractController
{
    #[Route('/dette/par/vente', name: 'app_dette_par_vente')]
    public function index(DetteParVenteRepository $detteParVenteRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        if($session->has("idPay") ){
            $session->remove("idPay"); 
        }
        $filtre = [];
        $filtre['pointId'] = $session->get('pointActive')->getId();
        if($session->has("dateFiltreDue")){
            $filtre['dateFiltreDue'] = $date = $session->get("dateFiltreDue");
        }
        
        if($session->has("dateFiltreClient")){
            $filtre['dateFiltreClient'] = $session->get("dateFiltreClient");
            $client = $session->get("dateFiltreClient");
        }

        $detteparVente = $detteParVenteRepository->findByFiltre($filtre);
        
        $pagination = $paginator->paginate(
            $detteparVente, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $total =  $detteParVenteRepository->totalFiltre($filtre);
        return $this->render('dette_par_vente/index.html.twig', [
            "pagination" => $pagination,
            "total" => $total,
            "date" => $date??"",
            "client" => $client??""
        ]);
    }

    #[Route('/detteParVente/filtre', name: 'app_detteParVente_filtre')]
    public function filtre(Request $request,Session $session): Response
    {
        if($request->isXmlHttpRequest() || $request->query->get('attrclient') != null){
            $session->set("dateFiltreClient" , $request->query->get('attrclient'));
        }

        if($request->query->get('attrclient') === ""){
            $session->remove("dateFiltreClient");
        }

        if($request->isXmlHttpRequest() || $request->query->get('attrdate-due') != null){            
            $session->set("dateFiltreDue" , $request->query->get('attrdate-due'));
        }

        if($request->query->get('attrdate-due') === ""){
            $session->remove("dateFiltreDue");
        }
        return new JsonResponse($this->generateUrl("app_dette_par_vente"));
    }

    // AJOUTER DETTE PAR VENTE ON 
        #[Route('/detteParVente/DoVente', name: 'app_vendre_dodetteParVente')]
        public function dodetteParVente(PointRepository $pointRepository,UserRepository $userRepository,ProduitRepository $produitRepository,EntityManagerInterface $manager,Request $request,Session $session): Response
        {
                $produitpaniers = $session->get("produits");
                $session->remove("produits");
                $detteParVente = new DetteParVente();
                $detteParVente->setPoint($pointRepository->find($session->get('pointActive')->getId()));
                $vente = new Vente();
                $vente->setPoint($pointRepository->find($session->get('pointActive')->getId()));
                $total = 0;
                $benefice = 0;       
                foreach ($produitpaniers as $pn){
                    $total += $pn->getPrixVenteFix() * $pn->getQte();
                    $benefice += ($pn->getPrixVenteFix() * $pn->getQte()) - ($pn->getPrixAchat() * $pn->getQte());
                    $prod = $produitRepository->find($pn->getId());            
                    // dd($prod->getQte()-$pn->getQte());
                    $produitRepository->updateQte($prod->getQte()-$pn->getQte(),$pn->getId());
                    $detailVc = new DetailVC();
                    $detailVc->setQteVente($pn->getQte());
                    $detailVc->setPrixVente($pn->getPrixVenteFix());
                    $detailVc->setProduit($prod);
                    $detailVc->setVC($vente);
                    $detailVc->setDetteParVente($detteParVente);
                    $detailVc->setPrixAchat($prod->getPrixAchat());
                    $manager->persist($detailVc);
                }     
                $user = $userRepository->findOneBy(["email"=>$this->getUser()->getUserIdentifier()]);
                $detteParVente->setUser($user);
                $detteParVente->setBenefice($benefice);
                $detteParVente->setLibelle("dette ajouter par ".$user->getNomComplet());
                $detteParVente->setMontantTotal($total);
                $detteParVente->setMontantRestant($total);
                $detteParVente->setMontantDonnee(0);
                $detteParVente->setClient($session->get("client"));
                $vente->setClient($session->get("client"));
                $vente->setTotal(0);
                $vente->setUser($user);
                $manager->persist($vente);        
                $manager->persist($detteParVente);        
                $manager->flush();
                $succes["venteSucces"] = "dette Par Vente ajouter";
                $session->set("succes",$succes);
                return  $this->redirectToRoute('app_vendre');;
        }
    // AJOUTER DETTE PAR VENTE OFF
    
    // PAYEMENT DETTE PAR VENTE ON 
        #[Route('/detteParVente/pay/{id?}', name: 'app_detteParVente_pay')]
        public function payer($id,VenteRepository $venteRepository,DetteParVenteRepository $dette,Request $request,EntityManagerInterface $manager,Session $session): Response
        {
            if($id == null){
                $detteparVente = new DetteParVente();
            }else{
                $detteparVente = $dette->find($id);
                $session->set("montantDonnee",$detteparVente->getMontantDonnee());
            }
            $form = $this->createForm(DetteParVenteFormType::class, $detteparVente);
            $form->handleRequest($request);
            // dd($detteparVente);
            if ($form->isSubmitted() && $form->isValid()) {
                // dd($detteparVente);
                if ($detteparVente->getMontantDonnee() > $detteparVente->getMontantRestant()) {
                    $error['erreurMontant'] = "le montant donner est supperieur au reste a payer";
                }else{
                    $payement = new Payement();
                    $payement->setMontantVerser($detteparVente->getMontantDonnee());  
                    $detteparVente->setMontantRestant($detteparVente->getMontantRestant() - $payement->getMontantVerser());

                    if($session->has("montantDonnee")){
                        $detteparVente->setMontantDonnee($detteparVente->getMontantDonnee() + $session->get("montantDonnee"));                   
                        $session->remove("montantDonnee");
                    }

                    if($detteparVente->getMontantRestant() == 0) {
                        $vente = $venteRepository->find($detteparVente->getDetaillDette()[0]->getVC()->getId());
                        $vente->setTotal($detteparVente->getMontantTotal());
                        $manager->persist($vente);
                    } 

                    
                    $payement->setDetteParVente($detteparVente);
                    $payement->setNumero("payementN°".$payement->getId().$payement->getCreatAt()->format('d-m-Y').$payement->getCreatAt()->format('H:i'));
                    $payement->setDD($detteparVente);
                    $manager->persist($detteparVente);                    
                    $manager->persist($payement);
                    $manager->flush();
                    $succes["paySucces"] = "payement réussi";
                }
            }
            return $this->render('dette_par_vente/formPay.html.twig', [
                "form" => $form->createView(),
                "due" => $detteparVente,
                "error" => $error??[],
                "succes" => $succes??[]
            ]);
        }
    // PAYEMENT DETTE PAR VENTE OFF
}
