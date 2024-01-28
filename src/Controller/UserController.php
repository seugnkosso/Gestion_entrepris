<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        $filtre['pointId'] = $session->get('pointActive')->getId();
        if($session->has("selectFiltreDate")){
            $filtre['selectFiltreDate'] = $DateJR = $session->get("selectFiltreDate");
        }else{
            $d = new \DateTimeImmutable();
            $session->set("selectFiltreDate",$d->format("Y-m-d"));
            $filtre['selectFiltreDate'] = $DateJR = $session->get("selectFiltreDate");
        }
        $user = $userRepository->findByFiltre($filtre);
        $pagination = $paginator->paginate(
            $user, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('user/index.html.twig', [
            "pagination" => $pagination,
        ]);
    }
}
