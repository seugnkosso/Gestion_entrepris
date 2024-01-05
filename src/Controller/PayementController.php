<?php

namespace App\Controller;

use App\Repository\PayementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PayementController extends AbstractController
{
    #[Route('/payement', name: 'app_payement')]
    public function index(): Response
    {
        return $this->render('payement/index.html.twig', [
            'controller_name' => 'PayementController',
        ]);
    }

    #[Route('/dette/listPayement/{id?}', name: 'app_payment_list')]
    public function payementDette($id,PayementRepository $payementRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        if(!empty($id)){            
            $filtre["idDette"] = $id;
            $session->remove("idPay");
            $session->set("idPay",$id);         
        }else{
            $filtre["idDette"] = $session->get("idPay");         
        }
        
        if($session->has("dateFiltreDue")){
            $filtre['dateFiltreDue'] = $date = $session->get("dateFiltreDue"); 
        }
        
        $payement = $payementRepository->findByFiltreDette($filtre);
        // dd($payement);
        $pagination = $paginator->paginate(
            $payement, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $total =  $payementRepository->totalFiltreDette($filtre);
        return $this->render('payement/index.html.twig', [
            "pagination" => $pagination,
            "total" => $total,
            "date" => $date??"",
            "client" => $client??""
        ]);
    }

    #[Route('/dette/payementList/filtre', name: 'app_payementList_filtre')]
    public function filtre(Request $request,Session $session): Response
    {        
        
        if($request->isXmlHttpRequest() || $request->query->get('attrdate-due') != null){            
            $session->set("dateFiltreDue" , $request->query->get('attrdate-due'));
        }

        if($request->query->get('attrdate-due') === ""){
            $session->remove("dateFiltreDue");
        }
        return new JsonResponse($this->generateUrl("app_payment_list"));
    }


    // SHOW FACTURE AND PRINT ON 
        #[Route('/dette/payement/facture/{id?}', name: 'app_payment_facture')]
        public function facture($id,PayementRepository $payementRepository,Request $request,Session $session): Response
        {       
            $pagination = $payementRepository->find($id);
            // dd($pagination)     ;
            return $this->render('payement/facture.html.twig', [
                "pagination" => $pagination,
            ]); 
        }
    // SHOW FACTURE AND PRINT OFF 
}
