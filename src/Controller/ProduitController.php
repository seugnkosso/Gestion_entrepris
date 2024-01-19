<?php

namespace App\Controller;

use App\Entity\Produit;
use SimpleExcel\SimpleExcel;
use App\Form\ProduitFormType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{

    #[Route('/produit', name: 'app_produit')]
    public function index(ProduitRepository $produitRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        
        if($session->has("inputFiltreProduit")){
            $filtre['inputFiltreProduit'] = $prod = $session->get("inputFiltreProduit");
            $session->remove("inputFiltreProduit");
        }        
        $produit = $produitRepository->findByFiltre($filtre);
        $pagination = $paginator->paginate(
            $produit, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('produit/index.html.twig', [
            "pagination" => $pagination,
            "produit" => $prod??""
        ]);
    }

    #[Route('/produit/all', name: 'app_produit_all')]
    public function AllProduit(ProduitRepository $produitRepository,Request $request,Session $session): Response
    {

        $filtre = [];
        
        if($session->has("qteFiltreExiste")){
            $filtre['qteFiltreExiste'] = $qteFiltreExiste =  $session->get("qteFiltreExiste");            
        }   
        if($session->has("qteFiltreManque")){
            $filtre['qteFiltreManque'] = $qteFiltreManque =  $session->get("qteFiltreManque");            
            // dd($qteFiltreManque);
        }
        $produit = $produitRepository->findByFiltre($filtre);
        if($request->query->get("imprimer")){
            $excel = new SimpleExcel('csv');

            $excel->writer->addRow(array('id', 'detail', 'qte', 'prix_achat', 'prix_vente_fix', 'prix_vente_min', 'categorie')); // insert more record
            foreach ($produit as $key => $value) {            
                $excel->writer->addRow(array($value->getId(), $value->getDetail(), $value->getQte(), $value->getPrixAchat(), $value->getPrixVenteFix(), $value->getPrixventeMin(), $value->getCategorie())); // insert more record
            }
            if($session->has("qteFiltreExiste")){
                $name = "produit reel";
            }else if($session->has("qteFiltreManque")){                
                $name = "produit manquant";
            }else{
                $name = "All produit";
            }
            $excel->writer->saveFile($name);
        }
        return $this->render('produit/AllProduit.html.twig', [
            "pagination" => $produit,
            "qteFiltreExiste" => $qteFiltreExiste??"",
            "qteFiltreManque" => $qteFiltreManque??"",
            "imprimer" => $imprimer??null
        ]);
    }

    #[Route('/produit/saveExcel', name: 'app_produit_save_excel')]
    public function saveExcel(ProduitRepository $produitRepository,Request $request,EntityManagerInterface $manager,Session $session): Response
    {

        $excel = new SimpleExcel('CSV');
        $excel->parser->loadFile('C:/xampp/htdocs/Gestion_entrepris/stock/All produit.csv');

        // récupération de tous les produit du excel         
        $AllProduits = $excel->parser->getAllRow();

        foreach ($AllProduits as $key => $value) {
            $prod = explode(";",$value);
            if($prod[0] !== "id"){
                $produit = $produitRepository->find($prod[0]);
                if($produit == null){
                    $produit = new Produit();
                }
                $produit->setDetail($prod[1]);
                $produit->setQte($prod[2]);
                $produit->setPrixAchat($prod[3]);
                $produit->setPrixVenteFix($prod[4]);
                $produit->setPrixventeMin($prod[5]);
                $produit->setCategorie($prod[6]);
                // dd($produit);
                $manager->persist($produit);            
            }        
        }                
        // dd("ok");
        $manager->flush();
        // $succes["addSucces"] = "produit ajouter avec succes";
        return $this->redirectToRoute("app_produit");
    }
    #[Route('/produit/save/{id?}', name: 'app_produit_save')]
    public function save($id,ProduitRepository $produitRepository,Request $request,EntityManagerInterface $manager,Session $session): Response
    {
        if($id == null){
            $produit = new Produit();
        }else{
            $produit = $produitRepository->find($id);
            $session->set("qte",$produit->getQte());
        }
        $form = $this->createForm(ProduitFormType::class, $produit);
        $form->handleRequest($request);
        // dd($produit);
        if ($form->isSubmitted() && $form->isValid()) {
            if($id != null){
                $produit->setQte($produit->getQte()+$session->get("qte"));                
            }            
            $manager->persist($produit);                
            $manager->flush();
            $succes["addSucces"] = "produit ajouter avec succes";
        }
        return $this->render('produit/form.html.twig', [
            "form" => $form->createView(),
            "succes" => $succes??null
        ]);
    }

    #[Route('/produit/filtre', name: 'app_produit_filtre')]
    public function filtre(Request $request,Session $session): Response
    {        
        if($request->isXmlHttpRequest() || $request->query->get('attrproduit') != null){            
            $session->set("inputFiltreProduit" , $request->query->get('attrproduit'));
        }
        return new JsonResponse($this->generateUrl("app_produit"));
    }
    #[Route('/produit/filtre/all', name: 'app_produit_filtre_all')]
    public function filtreAll(Request $request,Session $session): Response
    {        
        if($request->isXmlHttpRequest() || $request->query->get('qte') == 0){
            $session->remove("qteFiltreManque");
            $session->set("qteFiltreExiste",$request->query->get('qte'));
        }
        if($request->isXmlHttpRequest() || $request->query->get('qte') == 5){
            $session->remove("qteFiltreExiste");
            $session->set("qteFiltreManque",$request->query->get('qte'));
        }

        if($request->query->get('qte') == -1){
            $session->remove("qteFiltreExiste");
            $session->remove("qteFiltreManque");
        }
        return new JsonResponse($this->generateUrl("app_produit_all"));
    }
}
