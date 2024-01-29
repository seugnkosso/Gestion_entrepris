<?php

namespace App\Controller;

use App\Entity\Point;
use App\Form\PointFormType;
use App\Repository\UserRepository;
use App\Repository\PointRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PointController extends AbstractController
{
    #[Route('/point', name: 'app_point')]
    public function index(PointRepository $pointRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $points = $pointRepository->findPointByUser($this->getUser()->getUserIdentifier());
        $pagination = $paginator->paginate(
            $points, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('point/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/point/save/{id?}', name: 'app_point_save')]
    public function save($id,UserRepository $userRepository,PointRepository $pointRepository,Request $request,EntityManagerInterface $manager): Response
    {
        if($id == null){
            $point = new Point();
        }else{
            $point = $pointRepository->find($id);
        }
        $form = $this->createForm(PointFormType::class, $point);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $point->addUser($this->getUser());
            try {
                $manager->persist($point);
                $manager->flush();
                $succes["addSucces"] = "point de vente ajouter avec succes";                
            } catch (\Throwable $th) {
                $succes["addSucces"] = "point de vente existe deja";
            }
        }
        return $this->render('point/form.html.twig', [
            "form" => $form->createView(),
            "succes" => $succes??null
        ]);
    }

    #[Route('/point/charge', name: 'app_point_charge')]
    public function chargePoint(Session $session,PointRepository $pointRepository): Response
    {
        $session->set('useremail',$this->getUser()->getUserIdentifier());
        $point = $pointRepository->findPointByUser($this->getUser()->getUserIdentifier());
        $session->set('points', $point);
        foreach ($point as $key => $value) {
            $session->set('pointActive',$value);
            break;
        }
        return $this->redirectToRoute("app_vendre");
    }

    #[Route('/point/change', name: 'app_produit_change')]
    public function filtre(PointRepository $pointRepository,Request $request,Session $session): Response
    {
        if($request->query->get('id') != null){
            $point = $pointRepository->find($request->query->get('id'));
            $session->set("pointActive",$point);
        }
        return new JsonResponse($this->generateUrl("app_vendre"));
    }
    
    
}
