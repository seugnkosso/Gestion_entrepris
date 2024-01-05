<?php

namespace App\Controller;

use App\Entity\Superviseur;
use App\Form\SuperviseurFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SuperviseurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SuperviseurController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    #[Route('/superviseur', name: 'app_superviseur')]
    public function index(Session $session,PaginatorInterface $paginator,SuperviseurRepository $superviseurRepository,Request $request): Response
    {
        $filtre = [];
        
        if($session->has("inputUserFiltre")){
            $filtre['inputUserFiltre'] = $user = $session->get("inputUserFiltre");
            $session->remove("inputUserFiltre");
        }  
                
        $superviseur = $superviseurRepository->findByFiltre($filtre);
        $pagination = $paginator->paginate(
            $superviseur, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('superviseur/index.html.twig', [
            "pagination" => $pagination,
            "client" => $user??""
        ]);
    }

    #[Route('/superviseur/filtre', name: 'app_superviseur_filtre')]
    public function filtre(Request $request,Session $session): Response
    {        
        
        if($request->isXmlHttpRequest() || $request->query->get('attruser') != null){            
            $session->set("inputUserFiltre" , $request->query->get('attruser'));
        }

        if($request->query->get('attruser') === ""){
            $session->remove("inputUserFiltre");
        }

        
        return new JsonResponse($this->generateUrl("app_superviseur"));
    }

    #[Route('/superviseur/save/{id?}', name: 'app_superviseur_save')]
    public function save($id,SuperviseurRepository $superviseurRepository,Request $request,EntityManagerInterface $manager): Response
    {
        if($id == null){
            $superviseur = new Superviseur();
        }else{
            $superviseur = $superviseurRepository->find($id);
        }

        $form = $this->createForm(SuperviseurFormType::class, $superviseur);
        $form->handleRequest($request);
        // dd($superviseur);
        if ($form->isSubmitted() && $form->isValid()) { 
            $superviseur->setPassword($this->hasher->hashPassword(
                $superviseur, 
                $superviseur->getPassword()
            ));
            $manager->persist($superviseur);
            $manager->flush();
            $succes["addSucces"] = "superviseur ajouter avec succes";

        }
        return $this->render('superviseur/form.html.twig', [
            "form" => $form->createView(),  
            "succes" => $succes??null            

        ]);
    }
}
