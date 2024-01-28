<?php

namespace App\Controller;

use App\Entity\Vente;
use DateTimeImmutable;
use App\Entity\Commande;
use App\Entity\DetailVC;
use App\Repository\UserRepository;
use App\Repository\ProduitRepository;
use App\Repository\CommandeRepository;
use App\Repository\PointRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
// AFFICHAGE COMMANDE ON     
    #[Route('/commande', name: 'app_commande')]
    public function index(CommandeRepository $commandeRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        $filtre['pointId'] = $session->get('pointActive')->getId();
        if($session->has("inputFiltredateVente")){
            $filtre['inputFiltredateVente'] = $date = $session->get("inputFiltredateVente");
        }else{
            $d = new DateTimeImmutable();
            $filtre['inputFiltredateVente'] = $date = $d->format('Y-m-d');
        }
        if($session->has("inputFiltreClientVente")){
            $filtre['inputFiltreClientVente'] = $client = $session->get("inputFiltreClientVente");
        }
        if($session->has("inputFiltreUserVente")){
            $filtre['inputFiltreUserVente'] = $user = $session->get("inputFiltreUserVente");
        }else{            
            // $filtre['inputFiltreUserVente'] = $user = $this->getUser()->getUserIdentifier();
        }
        $session->set("filtreCommande",$filtre);
        $succes = $session->get("succes");
        $session->remove("succes");
        $commande = $commandeRepository->findByFiltre($filtre); 
        $total = $commandeRepository->findByFiltreTotal($filtre);
        $pagination = $paginator->paginate(
            $commande, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('commande/index.html.twig', [
            "pagination" => $pagination,
            "date" => $date??"",
            "client" => $client??"",
            "user" => $user??"",
            "total" => $total,
            "succes" => $succes
        ]);
    }
// AFFICHAGE COMMANDE OFF     

// COMMANDE FILTRE ON 
    #[Route('/commande/filtre', name: 'app_commande_filtre')]
    public function filtreVente(Request $request,Session $session): Response
    {        
        if($request->isXmlHttpRequest() || $request->query->get('attrdate-vente') != null){            
            $session->set("inputFiltredateVente" , $request->query->get('attrdate-vente'));
        }
        if($request->isXmlHttpRequest() || $request->query->get('attrdate-vente') === ""){            
            $session->remove("inputFiltredateVente");
        }
        if($request->isXmlHttpRequest() || $request->query->get('attrclient_vente') != null){            
            $session->set("inputFiltreClientVente" , $request->query->get('attrclient_vente'));
        }
        if($request->isXmlHttpRequest() || $request->query->get('attrclient_vente') === ""){            
            $session->remove("inputFiltreClientVente");
        }
        if($request->isXmlHttpRequest() || $request->query->get('attruser_vente') != null){            
            $session->set("inputFiltreUserVente" , $request->query->get('attruser_vente'));
        }
        if($request->isXmlHttpRequest() || $request->query->get('attruser_vente') === ""){            
            $session->remove("inputFiltreUserVente");
        }
        return new JsonResponse($this->generateUrl("app_commande"));
    }
// COMMANDE FILTRE OFF 

// FAIRE LA COMMANDE ON 
    #[Route('/commande/DoVente', name: 'app_vendre_doCommande')]
    public function doCommande(PointRepository $pointRepository,UserRepository $userRepository,ProduitRepository $produitRepository,EntityManagerInterface $manager,Request $request,Session $session): Response
    {        
            $produitpaniers = $session->get("produits");
            $session->remove("produits");
            $commande = new Commande();
            $commande->setPoint($pointRepository->find($session->get('pointActive')->getId()));
            $total = 0;
            foreach ($produitpaniers as $pn){
                $prod = $produitRepository->find($pn->getId());            
                // dd($prod->getQte()-$pn->getQte());
                $produitRepository->updateQte($prod->getQte()-$pn->getQte(),$pn->getId());
                $total += $pn->getPrixVenteFix() * $pn->getQte();
                $detailVc = new DetailVC();
                $detailVc->setQteVente($pn->getQte());
                $detailVc->setPrixVente($pn->getPrixVenteFix());
                $detailVc->setProduit($prod);
                $detailVc->setVC($commande);
                $detailVc->setPrixAchat($prod->getPrixAchat());
                $manager->persist($detailVc);
            }     
            $commande->setClient($session->get("client"));
            $commande->setTotal($total);
            $user = $userRepository->findOneBy(["email"=>$this->getUser()->getUserIdentifier()]);
            $commande->setUser($user);
            $commande->setNumero("commandeN°".$commande->getId().$commande->getCreatAt()->format('d-m-Y').$commande->getCreatAt()->format('H:i'));
            $manager->persist($commande);        
            $manager->flush();
            $succes["venteSucces"] = "commande réussi";
            $session->set("succes",$succes);
            return  $this->redirectToRoute('app_vendre');;
    }
// FAIRE LA COMMANDE OFF 

// SHOW FACTURE AND PRINT ON 
    #[Route('/commande/facture/{id?}', name: 'app_commande_facture')]
    public function facture($id,CommandeRepository $commandeRepository,Request $request,Session $session): Response
    {       
        $pagination = $commandeRepository->find($id);     
        return $this->render('commande/facture.html.twig', [
            "pagination" => $pagination,
        ]); 
    }
// SHOW FACTURE AND PRINT OFF 

// SHOW ALLCOMMANDE AND PRINT ON 
    #[Route('/commande/imprime', name: 'app_commande_imprimer')]
    public function venteImprime(CommandeRepository $commandeRepository,Request $request,Session $session): Response
    {       
        $filtre = $session->get("filtreCommande");
        $filtre['pointId'] = $session->get('pointActive')->getId();

        $pagination = $commandeRepository->findByFiltre($filtre);
        $total = $commandeRepository->findByFiltreTotal($filtre);  
        return $this->render('commande/commandeImprime.html.twig', [
            "pagination" => $pagination,
            "total" => $total,
            "date" => $filtre['inputFiltredateVente']
        ]); 
    }
// SHOW ALLCOMMANDE AND PRINT OFF 

// FAIRE LA VENTE ON 
    #[Route('/commande/valider/{id?}', name: 'app_commande_valider')]
    public function validerCommande($id,PointRepository $pointRepository,CommandeRepository $commandeRepository,UserRepository $userRepository,ProduitRepository $produitRepository,EntityManagerInterface $manager,Request $request,Session $session): Response
    {        
            $commande = $commandeRepository->find($id)    ;
            $vente = new Vente(); 
            $vente->setPoint($pointRepository->find($session->get('pointActive')->getId()));
            foreach ($commande->getDetailVc() as $pn){                                    
                $detailVc = new DetailVC();
                $detailVc->setQteVente($pn->getQteVente());
                $detailVc->setPrixVente($pn->getPrixVente());
                $detailVc->setProduit($pn->getProduit());
                $detailVc->setVC($vente);
                $detailVc->setPrixAchat($pn->getPrixAchat());
                $manager->persist($detailVc);
                $manager->remove($pn);
            }     
            $vente->setClient($commande->getClient());
            $vente->setTotal($commande->getTotal()); 
            $user = $userRepository->findOneBy(["email"=>$this->getUser()->getUserIdentifier()]);
            $vente->setUser($user);
            $commande->setNumero("commandeN°".$commande->getId().$commande->getCreatAt()->format('d-m-Y').$commande->getCreatAt()->format('H:i'));
            $manager->persist($vente);
            $manager->remove($commande);        
            $manager->flush();
            $succes["venteSucces"] = "vente réussi";
            $session->set("succes",$succes);
            return  $this->redirectToRoute('app_commande');;
    }
// FAIRE LA VENTE OFF 

// ANNULER COMMANDE  ON 
    #[Route('/commande/annuler/{id?}', name: 'app_commande_annuler')]
    public function annulerVente($id,CommandeRepository $commandeRepository,UserRepository $userRepository,ProduitRepository $produitRepository,EntityManagerInterface $manager,Request $request,Session $session): Response
    {        
            $commande = $commandeRepository->find($id);
            foreach ($commande->getDetailVc() as $pn){
                $prod = $produitRepository->find($pn->getProduit()->getId());            
                $produitRepository->updateQte($prod->getQte()+$pn->getQteVente(),$pn->getProduit()->getId());                                                 
                $manager->remove($pn);
            }     
            $manager->remove($commande);        
            $manager->flush();
            $succes["deletteSucces"] = "commande annuler";
            $session->set("succes",$succes);
            return  $this->redirectToRoute('app_commande');;
    }
// ANNULER COMMANDE  OFF 
}
