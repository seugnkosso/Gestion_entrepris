<?php

namespace App\Controller;

use App\Entity\Dette;
use App\Entity\Vente;
use App\Entity\DetailVC;
use App\Entity\Payement;
use App\Form\DetteFormType;
use App\Form\DetteFormpayType;
use App\Repository\UserRepository;
use App\Repository\DetteRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DetteController extends AbstractController
{

// DETTE SHOW ON   
    #[Route('/due', name: 'app_dette')]
    public function index(DetteRepository $detteRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {      
        if($session->has("idDette")){
            $session->remove('idDette');
        }
        if($session->has("produitsDette")){
            $session->remove('produitsDette');
        }
        $filtre = [];
        
        if($session->has("dateFiltreDue")){
            $filtre['dateFiltreDue'] = $session->get("dateFiltreDue");
            $date = $session->get("dateFiltreDue");
        }
        if($session->has("dateFiltreClient")){
            $filtre['dateFiltreClient'] = $session->get("dateFiltreClient");
            $client = $session->get("dateFiltreClient");
        }

        $due = $detteRepository->findByFiltre($filtre);
        $pagination = $paginator->paginate(
            $due, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $total =  $detteRepository->totalFiltre($filtre);
        return $this->render('dette/index.html.twig', [
            "pagination" => $pagination,
            "total" => $total,
            "date" => $date??"",
            "client" => $client??""
        ]);
    }
// DETTE SHOW OFF     

// DETTE SAVE ON 
    #[Route('/due/save/{id?}', name: 'app_dette_save')]
    public function save($id,UserRepository $userRepository, DetteRepository $detteRepository,Request $request,EntityManagerInterface $manager): Response
    {
        if($id == null){
            $dette = new Dette();
        }else{
            $dette = $detteRepository->find($id);
        }
        $form = $this->createForm(DetteFormType::class, $dette);
        $form->handleRequest($request);
        // dd($dette);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $userRepository->findOneBy(["email"=>$this->getUser()->getUserIdentifier()]);
            $dette->setUser($user);
            $dette->setMontantRestant($dette->getMontantTotal()); 
            $dette->setMontantDonnee(0);           ;
            $manager->persist($dette);
            $manager->flush();
            $succes["addSucces"] = "dus ajouter avec succes";
        }
        return $this->render('dette/form.html.twig', [
            "form" => $form->createView(),  
            "succes" => $succes??null           
        ]);
    }
// DETTE SAVE OFF

// DETTE FILTRE ON 
    #[Route('/due/filtre', name: 'app_dette_filtre')]
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
        return new JsonResponse($this->generateUrl("app_dette"));
    }
// DETTE FILTRE OFF 

// DETTE PAY INTERFACE ON
    #[Route('/due/pay/{id?}', name: 'app_dette_pay')]
    public function payer($id,DetteRepository $detteRepository,Request $request,EntityManagerInterface $manager,ProduitRepository $produitRepository,PaginatorInterface $paginator,Session $session): Response
    {
        if(!$session->has("idDette")){
            if($id == null){
                $dette = new Dette();
            }else{
                $dette = $detteRepository->find($id);
                $session->set('idDette',$id); // supprimer a l'affichage de dette
                $session->set("montantDonnee",$dette->getMontantDonnee());
            }
        }else{
            $dette = $detteRepository->find($session->get("idDette"));
            $session->set("montantDonnee",$dette->getMontantDonnee());
        }
        $form = $this->createForm(DetteFormpayType::class, $dette);
        $form->handleRequest($request);
        // dd($due);
        $prixTotal = 0;
        if($session->has("produitsDette") && $session->get("produitsDette") != null){
            foreach($session->get("produitsDette") as $prod){                
                $prixTotal += $prod->getPrixVenteFix() * $prod->getQte();            
            }
        }
        if ($form->isSubmitted() && $form->isValid()) {                        
            if ($dette->getMontantDonnee() + $prixTotal > $dette->getMontantRestant()) {
                $errors['erreurMontant'] = "le montant donner est supperieur au reste a payer";
            }else{
                $payement = new Payement();
                $payement->setMontantVerser($dette->getMontantDonnee());
                $dette->setMontantRestant($dette->getMontantRestant()-($dette->getMontantDonnee()+$prixTotal));  

                if($session->has("montantDonnee")){
                    $dette->setMontantDonnee($dette->getMontantDonnee() + $session->get("montantDonnee"));                   
                    $session->remove("montantDonnee");
                }

                $session->set("clientDette",$dette->getClient());
                $session->set("succesPay","payement réussi");                
                $payement->setDD($dette);
                $payement->setNumero("payementN°".$payement->getId().$payement->getCreatAt()->format('d-m-Y').$payement->getCreatAt()->format('H:i'));

                $manager->persist($dette);
                $manager->persist($payement);
                $manager->flush();
                
                return $this->redirectToRoute('app_dette_doVente');
            }
        }

        $filtre = [];
        
        if($session->has("inputFiltreProduit")){
            $filtre['inputFiltreProduit'] = $session->get("inputFiltreProduit");
            $session->remove("inputFiltreProduit");
        }else{
            $filtre['inputFiltreProduit'] = "null";
        }
        $produits = $produitRepository->findByFiltre($filtre);        
        $pagination = $paginator->paginate(
            $produits, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        if($session->has("errors")){
            $errors = $session->get("errors");
            $session->remove("errors");
        }
        if($session->has("succes")){
            $succes = $session->get("succes");
            $session->remove("succes");
        }
        if($session->has("succesPay")){
            $succesPay = $session->get("succesPay");            
            $session->remove("succesPay");
        }

        return $this->render('dette/formPay.html.twig', [
            "form" => $form->createView(),
            "due" => $dette,
            "pagination" => $pagination,
            "produitpaniers" => $session->get("produitsDette")??null,            
            "errors" => $errors??null,
            "succes" => $succes??null,
            "succesPay" => $succesPay??null
        ]);
    }
// DETTE PAY INTERFACE Off

// FILTRE DES PRODUIT AU VENTE ON
    #[Route('/due/filtreProduit', name: 'app_dette_filtreProduit')]
    public function filtreproduit(Request $request,Session $session): Response
    {        
        if($request->isXmlHttpRequest() || $request->query->get('attrproduit_Dette') != null){            
            $session->set("inputFiltreProduit" , $request->query->get('attrproduit_Dette'));
        }
        return new JsonResponse($this->generateUrl("app_dette_pay"));
    }
// FILTRE DES PRODUIT AU VENTE OFF

// REMPLISSAGGE PANIER ON 
    #[Route('/due/panier', name: 'app_dette_panier')]
    public function remplissagePanier(ProduitRepository $produitRepository,Request $request,Session $session): Response
    {    
        // $session->remove("produits");
        $produits = [];
        $produit = $produitRepository->find($request->request->get('idProduit'));
        if(!$session->has("produitsDette")){        
            $produit->setQte($request->request->get('qteDonner'));
            $produit->setPrixVenteFix($request->request->get('prixVente'));
        
            $produits [] = $produit;
            $session->set("produitsDette",$produits);
        }else{
            $produits = $session->get("produitsDette");
            $existe = false;
            foreach ($produits as $key => $value) {
                if ($value->getId() == $produit->getId()){
                    $existe = true;                    
                    break;                    
                }
            }

            if($existe == true){
                if($request->request->get('qteDonner') + $produits[$key]->getQte() < $produit->getQte()){
                $produits[$key]->setQte($request->request->get('qteDonner') + $produits[$key]->getQte());
                $session->set("produitsDette",$produits);
                }else{
                    $errors["qteExcés"] = "la quantité donner est supperieur au stock"; 
                    $session->set("errors",$errors);
                }
            }else{
                $produit->setQte($request->request->get('qteDonner'));
                $produit->setPrixVenteFix($request->request->get('prixVente'));
            
                $produits[] = $produit;
                $session->set("produitsDette",$produits);
            }
        }
        
        return  $this->redirectToRoute('app_dette_pay');;
    }
// REMPLISSAGGE PANIER OFF 

// SUPPRIMER PRODUIT DE LA SESSION  ON 
    #[Route('/due/sessionDellete/{id?}', name: 'app_session_delete_session')]
    public function deleteSession($id,Session $session): Response
    {        
            $produits = $session->get('produitsDette');
            foreach ($produits as $key => $value) {
                if($value->getId() == $id){
                    unset($produits[$key]);                    
                    break;
                }
            }
            $session->set("produitsDette",$produits);                
            return  $this->redirectToRoute('app_dette_pay');
    }
// SUPPRIMER PRODUIT DE LA SESSION  OFF 

// FAIRE LA VENTE ON 
    #[Route('/due/doVente', name: 'app_dette_doVente')]
    public function dovente(DetteRepository $detteRepository,UserRepository $userRepository,ProduitRepository $produitRepository,EntityManagerInterface $manager,Request $request,Session $session): Response
    {                   
        if($session->has("produitsDette")){
                if($session->get("produitsDette") != null){
                    $produitpaniers = $session->get("produitsDette");
                    $session->remove("produitsDette");
                    $vente = new Vente();
                    $total = 0;       
                    foreach ($produitpaniers as $pn){
                        $prod = $produitRepository->find($pn->getId());            
                        $produitRepository->updateQte($prod->getQte()-$pn->getQte(),$pn->getId());
                        $total += $pn->getPrixVenteFix() * $pn->getQte();
                        $detailVc = new DetailVC();
                        $detailVc->setQteVente($pn->getQte());
                        $detailVc->setPrixVente($pn->getPrixVenteFix());
                        $detailVc->setProduit($prod);
                        $detailVc->setVC($vente);
                        $manager->persist($detailVc);
                    }     
                    $vente->setClient($session->get("clientDette"));
                    $session->remove("clientDette");
                    $vente->setTotal($total);
                    $user = $userRepository->findOneBy(["email"=>$this->getUser()->getUserIdentifier()]);
                    $vente->setUser($user);
                    $manager->persist($vente);        
                    $manager->flush();
                    $succes["venteSucces"] = "vente réussi";
                    $session->set("succes",$succes);
                }
        }          
        return  $this->redirectToRoute('app_dette_pay');
    }
// FAIRE LA VENTE OFF 

// VENDRE INTERFACE ON 
    #[Route('/vendre', name: 'app_vendre')]
    public function vendre(ProduitRepository $produitRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        
        if($session->has("inputFiltreProduit")){
            $filtre['inputFiltreProduit'] = $session->get("inputFiltreProduit");
            $session->remove("inputFiltreProduit");
        }else{
            $filtre['inputFiltreProduit'] = "null";
        }
                
        $produits = $produitRepository->findByFiltre($filtre);        
        $pagination = $paginator->paginate(
            $produits, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        if($session->has("errors")){
            $errors = $session->get("errors");
            $session->remove("errors");
        }
        if($session->has("succes")){
            $succes = $session->get("succes");
            $session->remove("succes");
        }
        return $this->render('vente/vendre.html.twig', [
            "pagination" => $pagination,
            "produitpaniers" => $session->get("produits")??null,
            "errors" => $errors??null,
            "succes" => $succes??null
        ]);
    }
// VENDRE INTERFACE OFF 
}
