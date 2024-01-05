<?php

namespace App\Controller;

use App\Entity\Vendeur;
use App\Form\VendeurFormType;
use App\Repository\VendeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class VendeurController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    #[Route('/vendeur', name: 'app_vendeur')]
    public function index(VendeurRepository $vendeurRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        
        if($session->has("inputUserFiltre")){
            $filtre['inputUserFiltre'] = $user = $session->get("inputUserFiltre");
            $session->remove("inputUserFiltre");
        }  
                
        $vendeur = $vendeurRepository->findByFiltre($filtre);
        $pagination = $paginator->paginate(
            $vendeur, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('vendeur/index.html.twig', [
            "pagination" => $pagination,
            "client" => $user??""
        ]);
    }

    #[Route('/vendeur/save/{id?}', name: 'app_vendeur_save')]
    public function save($id,VendeurRepository $vendeurRepository,Request $request,EntityManagerInterface $manager): Response
    {
        if($id == null){
            $vendeur = new Vendeur();
        }else{
            $vendeur = $vendeurRepository->find($id);
        }

        $form = $this->createForm(VendeurFormType::class, $vendeur);
        $form->handleRequest($request);
        // dd($vendeur);
        if ($form->isSubmitted() && $form->isValid()) { 
            $vendeur->setPassword($this->hasher->hashPassword(
                $vendeur, 
                $vendeur->getPassword()
            ));
            $manager->persist($vendeur);
            $manager->flush();
            $succes["addSucces"] = "vendeur ajouter avec succes";
        }
        return $this->render('vendeur/form.html.twig', [
            "form" => $form->createView(), 
            "succes" => $succes??null            
        ]);
    }

    #[Route('/vendeur/filtre', name: 'app_vendeur_filtre')]
    public function filtre(Request $request,Session $session): Response
    {        
        
        if($request->isXmlHttpRequest() || $request->query->get('attruser') != null){            
            $session->set("inputUserFiltre" , $request->query->get('attruser'));
        }

        if($request->query->get('attruser') === ""){
            $session->remove("inputUserFiltre");
        }

        
        return new JsonResponse($this->generateUrl("app_vendeur"));
    }
}
