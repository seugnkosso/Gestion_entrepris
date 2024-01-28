<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminFormType;
use App\Repository\AdminRepository;
use App\Repository\PointRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    #[Route('/admin', name: 'app_admin')]
    public function index(AdminRepository $adminRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        $filtre['pointId'] = $session->get('pointActive')->getId();
        if($session->has("inputUserFiltre")){
            $filtre['inputUserFiltre'] = $user = $session->get("inputUserFiltre");
            $session->remove("inputUserFiltre");
        }
        $admin = $adminRepository->findByFiltre($filtre);
        $pagination = $paginator->paginate(
            $admin, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('admin/index.html.twig', [
            "pagination" => $pagination,
            "client" => $user??"",
        ]);
    }

    #[Route('/admin/save/{id?}', name: 'app_admin_save')]
    public function save($id,Session $session,PointRepository $pointRepository, UserRepository $userRepository,AdminRepository $adminRepository,Request $request,EntityManagerInterface $manager): Response
    {
        if($id == null){
            $admin = new Admin();
        }else{
            $admin = $adminRepository->find($id);
        }
        $form = $this->createForm(AdminFormType::class, $admin);
        $form->handleRequest($request);
        // dd($admin);
        if ($form->isSubmitted() && $form->isValid()) { 
            $admin->setPassword($this->hasher->hashPassword(
                $admin, 
                $admin->getPassword()
            ));
            foreach ($session->get('points') as $key => $value) {
                $admin->addPoint($pointRepository->find($value));
            }
            $manager->persist($admin);
            $manager->flush();
            $succes["addSucces"] = "admin ajouter avec succes";

        }
        return $this->render('admin/form.html.twig', [
            "form" => $form->createView(), 
            "succes" => $succes??null            

        ]);
    }

    #[Route('/admin/filtre', name: 'app_admin_filtre')]
    public function filtre(Request $request,Session $session): Response
    {        
        
        if($request->isXmlHttpRequest() || $request->query->get('attruser') != null){            
            $session->set("inputUserFiltre" , $request->query->get('attruser'));
        }

        if($request->query->get('attruser') === ""){
            $session->remove("inputUserFiltre");
        }

        
        return new JsonResponse($this->generateUrl("app_admin"));
    }
}
