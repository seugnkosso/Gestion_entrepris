<?php

namespace App\Controller;

use App\Entity\Due;
use App\Form\DueFormType;
use App\Form\DueFormPayType;
use App\Repository\DueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DueController extends AbstractController
{
    // #[Route('/dette', name: 'app_due')]
    // public function index(DueRepository $dueRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    // {
    //     $filtre = [];
        
    //     if($session->has("dateFiltreDue")){
    //         $filtre['dateFiltreDue'] = $date = $session->get("dateFiltreDue");            
    //     }
        
    //     if($session->has("dateFiltreClient")){
    //         $filtre['dateFiltreClient'] = $session->get("dateFiltreClient");
    //         $client = $session->get("dateFiltreClient");
    //     }

    //     $due = $dueRepository->findByFiltre($filtre);
    //     $pagination = $paginator->paginate(
    //         $due, /* query NOT result */
    //         $request->query->getInt('page', 1), /*page number*/
    //         10 /*limit per page*/
    //     );

    //     $total =  $dueRepository->totalFiltre($filtre);
    //     return $this->render('due/index.html.twig', [
    //         "pagination" => $pagination,
    //         "total" => $total,
    //         "date" => $date??"",
    //         "client" => $client??""
    //     ]);
    // }
   
    // #[Route('/dette/save/{id?}', name: 'app_due_save')]
    // public function save($id,DueRepository $dueRepository,Request $request,EntityManagerInterface $manager): Response
    // {
    //     if($id == null){
    //         $due = new Due();
    //     }else{
    //         $due = $dueRepository->find($id);
    //     }
    //     $form = $this->createForm(DueFormType::class, $due);
    //     $form->handleRequest($request);
    //     // dd($due);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $due->setMontantRestant($due->getMontantTotal()); 
    //         $due->setMontantDonnee(0);           ;
    //         $manager->persist($due);
    //         $manager->flush();
    //         $succes["addSucces"] = "dette ajouter avec succes";
    //     }
    //     return $this->render('due/form.html.twig', [
    //         "form" => $form->createView(),
    //         'succes' => $succes??''            
    //     ]);
    // }

    // #[Route('/dette/pay/{id?}', name: 'app_due_pay')]
    // public function payer($id,DueRepository $dueRepository,Request $request,EntityManagerInterface $manager): Response
    // {
    //     if($id == null){
    //         $due = new Due();
    //     }else{
    //         $due = $dueRepository->find($id);
    //     }
    //     $form = $this->createForm(DueFormPayType::class, $due);
    //     $form->handleRequest($request);
    //     // dd($due);
    //     if ($form->isSubmitted() && $form->isValid()) {
            
    //         // dd($due);
    //         if ($due->getMontantDonnee() > $due->getMontantRestant()) {
    //             $error['erreurMontant'] = "le montant donner est supperieur au reste a payer";
    //         }else{
    //             $due->setMontantRestant($due->getMontantRestant()-$due->getMontantDonnee()); 
    //             $due->setMontantDonnee(0);  
    //             $manager->persist($due);
    //             $manager->flush();
    //             $succes["paySucces"] = "payement réussi";
    //         }
    //     }
    //     return $this->render('due/formPay.html.twig', [
    //         "form" => $form->createView(),
    //         "due" => $due,
    //         "error" => $error??[],
    //         "succes" => $succes??[]
    //     ]);
    // }
    // #[Route('/dette/filtre', name: 'app_due_filtre')]
    // public function filtre(Request $request,Session $session): Response
    // {        
    //     if($request->isXmlHttpRequest() || $request->query->get('attrclient') != null){            
    //         $session->set("dateFiltreClient" , $request->query->get('attrclient'));
    //     }

    //     if($request->query->get('attrclient') === ""){
    //         $session->remove("dateFiltreClient");
    //     }

    //     if($request->isXmlHttpRequest() || $request->query->get('attrdate-due') != null){            
    //         $session->set("dateFiltreDue" , $request->query->get('attrdate-due'));
    //     }

    //     if($request->query->get('attrdate-due') === ""){
    //         $session->remove("dateFiltreDue");
    //     }
    //     return new JsonResponse($this->generateUrl("app_due"));
    // }
}
