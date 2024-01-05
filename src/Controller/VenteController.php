<?php

namespace App\Controller;

use App\Entity\VC;
use App\Entity\Vente;
use App\Entity\DetailVC;
use App\Repository\DetteParVenteRepository;
use App\Repository\DetteRepository;
use App\Repository\DueRepository;
use App\Repository\FraisRepository;
use App\Repository\PayementRepository;
use App\Repository\VenteRepository;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VenteController extends AbstractController
{

// VENTE AFFICHAGE ON 
    #[Route('/vente', name: 'app_vente')]
    public function index(DetteParVenteRepository $detteParVenteRepository, DetteRepository $detteRepository,FraisRepository $fraisRepository,VenteRepository $venteRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        
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
            if (array_search('ROLE_VENDEUR',$this->getUser()->getRoles()) !== false) {
                $filtre['inputFiltreUserVente'] = $user = $this->getUser()->getUserIdentifier();
            }     
        }
        $session->set("filtre",$filtre);
        $succes = $session->get('succes');
        $session->remove('succes');
        $ventes = $venteRepository->findByFiltre($filtre);
        $total = $venteRepository->findByFiltreTotal($filtre);
        $pagination = $paginator->paginate(
            $ventes, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        // BENEFICE VENTE ON                         
            $totalFrais = $fraisRepository->findAllDay($filtre['inputFiltredateVente']);                                        
            $venteBenefice = $venteRepository->findTotalDate($filtre);
            $TotalDusNonPayer = $detteRepository->findTotalDate($filtre);            
            $detteBeneficeDay = $detteParVenteRepository->findTotalDatedette($filtre['inputFiltredateVente']);
            $benefice = ($venteBenefice + $detteBeneficeDay) - ($totalFrais + $TotalDusNonPayer);
        // BENEFICE VENTE OFF 
        return $this->render('vente/index.html.twig', [
            "pagination" => $pagination,
            "date" => $date??"",
            "client" => $client??"",
            "user" => $user??"",
            "total" => $total,
            "benefice" => $benefice,
            "succes" => $succes,
        ]);
    }
// VENTE AFFICHAGE OFF

// VENTE FILTRE ON 
    #[Route('/vente/filtre', name: 'app_vente_filtre')]
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
        return new JsonResponse($this->generateUrl("app_vente"));
    }
// VENTE FILTRE OFF 

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
                
        $produits = $produitRepository->findByFiltreVente($filtre);        
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

// REMPLISSAGGE PANIER ON 
    #[Route('/vendre/panier', name: 'app_vendre_panier')]
    public function remplissagePanier(ProduitRepository $produitRepository,Request $request,Session $session): Response
    {
        // $session->remove("produits");
        $produits = [];
        $produit = $produitRepository->find($request->request->get('idProduit'));
        if(!$session->has("produits")){            
            $produit->setQte($request->request->get('qteDonner'));
            $produit->setPrixVenteFix($request->request->get('prixVente'));
        
            $produits [] = $produit;
            $session->set("produits",$produits);
        }else{
            $produits = $session->get("produits");
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
                $session->set("produits",$produits);
                }else{
                    $errors["qteExcés"] = "la quantité donner est supperieur au stock"; 
                    $session->set("errors",$errors);
                }
            }else{
                $produit->setQte($request->request->get('qteDonner'));
                $produit->setPrixVenteFix($request->request->get('prixVente'));
            
                $produits[] = $produit;
                $session->set("produits",$produits);
            }
        }
        
        return  $this->redirectToRoute('app_vendre');;
    }
// REMPLISSAGGE PANIER OFF 

// FAIRE LA VENTE ON 
    #[Route('/vendre/DoVente', name: 'app_vendre_doVente')]
    public function dovente(UserRepository $userRepository,ProduitRepository $produitRepository,EntityManagerInterface $manager,Request $request,Session $session): Response
    {        
            $produitpaniers = $session->get("produits");
            $session->remove("produits");
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
            $user = $userRepository->findOneBy(["email"=>$this->getUser()->getUserIdentifier()]);
            $vente->setClient($session->get("client"));
            $vente->setTotal($total);
            $vente->setUser($user);
            $vente->setNumero("venteN°".$vente->getId().$vente->getCreatAt()->format('d-m-Y').$vente->getCreatAt()->format('H:i'));
            $manager->persist($vente);        
            $manager->flush();
            $succes["venteSucces"] = "vente réussi";
            $session->set("succes",$succes);
            return  $this->redirectToRoute('app_vendre');;
    }
// FAIRE LA VENTE OFF 

// CHOISIR VENTE OU COMMANDE ON 
    #[Route('/vendre/VC', name: 'app_vendre_choixVC')]
    public function choixVC(ProduitRepository $produitRepository,Request $request,Session $session): Response
    {
        if($session->has("produits")){
            if($session->get("produits") != null){
                $session->set("client",$request->request->get('client'));
                if(!empty($request->request->get('vente'))){
                    return  $this->redirectToRoute('app_vendre_doVente');;            
                }elseif(!empty($request->request->get('dette'))){                    
                    return  $this->redirectToRoute('app_vendre_dodetteParVente');;                        
                }else{
                    return  $this->redirectToRoute('app_vendre_doCommande');;                        
                }
            }else{
                $errors["panierVide"] = "le panier est vide";
                $session->set("errors",$errors);
            }
        }else{
            $errors["panierVide"] = "le panier est vide";
            $session->set("errors",$errors);
        }
        return  $this->redirectToRoute('app_vendre');                             
    }
// CHOISIR VENTE OU COMMANDE OFF 

// SHOW FACTURE AND PRINT ON 
    #[Route('/vente/facture/{id?}', name: 'app_vente_facture')]
    public function facture($id,VenteRepository $venteRepository,Request $request,Session $session): Response
    {       
        $pagination = $venteRepository->find($id);     
        return $this->render('vente/facture.html.twig', [
            "pagination" => $pagination,
        ]); 
    }
// SHOW FACTURE AND PRINT OFF 

// SHOW ALLVENTE AND PRINT ON 
    #[Route('/vente/imprime', name: 'app_vente_imprimer')]
    public function venteImprime(VenteRepository $venteRepository,Request $request,Session $session): Response
    {       
        $filtre = $session->get("filtre");
        $pagination = $venteRepository->findByFiltre($filtre);
        $total = $venteRepository->findByFiltreTotal($filtre);  
        return $this->render('vente/venteImprime.html.twig', [
            "pagination" => $pagination,
            "total" => $total,
            "date" => $filtre['inputFiltredateVente']??null,
            "client" => $filtre['inputFiltreClientVente']??null,
            "vendeur" => $filtre['inputFiltreUserVente']??null
        ]); 
    }
// SHOW ALLVENTE AND PRINT OFF

// ANNULER VENTE  ON 
    #[Route('/vente/annuler/{id?}', name: 'app_vente_annuler')]
    public function annulerVente($id,VenteRepository $venteRepository,UserRepository $userRepository,ProduitRepository $produitRepository,EntityManagerInterface $manager,Request $request,Session $session): Response
    {        
            $vente = $venteRepository->find($id);
            foreach ($vente->getDetailVc() as $pn){
                $prod = $produitRepository->find($pn->getProduit()->getId());            
                $produitRepository->updateQte($prod->getQte()+$pn->getQteVente(),$pn->getProduit()->getId());                                                 
                $manager->remove($pn);
            }     
            $manager->remove($vente);        
            $manager->flush();
            $succes["deletteSucces"] = "vente annuler";
            $session->set("succes",$succes);
            return  $this->redirectToRoute('app_vente');;
    }
// ANNULER VENTE  OFF 

// SUPPRIMER PRODUIT DE LA SESSION  ON 
    #[Route('/vendre/sessionDellete/{id?}', name: 'app_vendre_delete_session')]
    public function deleteSession($id,VenteRepository $venteRepository,UserRepository $userRepository,ProduitRepository $produitRepository,EntityManagerInterface $manager,Request $request,Session $session): Response
    {        
            $produits = $session->get('produits');
            foreach ($produits as $key => $value) {
                if($value->getId() == $id){
                    unset($produits[$key]);                    
                    break;
                }
            }
            $session->set("produits",$produits);                
            return  $this->redirectToRoute('app_vendre');
    }
// SUPPRIMER PRODUIT DE LA SESSION  OFF 

// FILTRE DES PRODUIT AU VENTE ON
    #[Route('/vendre/filtre', name: 'app_vendre_filtreProduit')]
    public function filtre(Request $request,Session $session): Response
    {        
        if($request->isXmlHttpRequest() || $request->query->get('attrproduit') != null){            
            $session->set("inputFiltreProduit" , $request->query->get('attrproduit'));
        }
        return new JsonResponse($this->generateUrl("app_vendre"));
    }
// FILTRE DES PRODUIT AU VENTE OFF
}
