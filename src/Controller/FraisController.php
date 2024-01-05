<?php

namespace App\Controller;

use App\Entity\Frais;
use App\Form\FraisFormType;
use App\Repository\FraisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FraisController extends AbstractController
{
    #[Route('/frais', name: 'app_frais')]
    public function index(FraisRepository $fraisRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        
        if($session->has("selectFiltreDate")){
            $filtre['selectFiltreDate'] = $DateJR = $session->get("selectFiltreDate");
        }else{
            $d = new \DateTimeImmutable();
            $session->set("selectFiltreDate",$d->format("Y-m-d"));
            $filtre['selectFiltreDate'] = $DateJR = $session->get("selectFiltreDate");
        }
        

        $frais = $fraisRepository->findByFiltre($filtre);
        $pagination = $paginator->paginate(
            $frais, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $total =  $fraisRepository->totalFiltre($filtre);
        return $this->render('frais/index.html.twig', [
            "pagination" => $pagination,
            "total" => $total,
            "date" => $date??"",
            "dateJr" => $DateJR??""

        ]);
    }

    #[Route('/frais/save/{id?}', name: 'app_frais_save')]
    public function save($id,FraisRepository $fraisRepository,Request $request,EntityManagerInterface $manager): Response
    {
        if($id == null){
            $frais = new Frais();
        }else{
            $frais = $fraisRepository->find($id);
        }
        $form = $this->createForm(FraisFormType::class, $frais);
        $form->handleRequest($request);
        // dd($frais);
        if ($form->isSubmitted() && $form->isValid()) {          ;
            $manager->persist($frais);
            $manager->flush();
            $succes["addSucces"] = "frais ajouter avec succes";
        }
        return $this->render('frais/form.html.twig', [
            "form" => $form->createView(),
            "succes" => $succes??null           
        ]);
    }

    #[Route('/frais/filtre', name: 'app_frais_filtre')]
    public function filtre(Request $request,Session $session): Response
    {        
        
        if($request->isXmlHttpRequest() || $request->query->get('attrdateJr-frais') != null){            
            $session->set("selectFiltreDate" , $request->query->get('attrdateJr-frais'));
        }

        if($request->query->get('attrdateJr-frais') === ""){
            $session->remove("selectFiltreDate");
        }

        
        return new JsonResponse($this->generateUrl("app_frais"));
    }
}
