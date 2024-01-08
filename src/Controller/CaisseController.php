<?php

namespace App\Controller;

use App\Entity\Caisse;
use App\Repository\DetteRepository;
use App\Repository\FraisRepository;
use App\Repository\VenteRepository;
use App\Repository\CaisseRepository;
use App\Repository\CommandeRepository;
use App\Repository\DetteParVenteRepository;
use App\Repository\PayementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CaisseController extends AbstractController
{
    #[Route('/caisse', name: 'app_caisse')]
    public function index(CaisseRepository $caisseRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
    {
        $filtre = [];
        
        if($session->has("inputFiltreCaisse")){
            $filtre['inputFiltreCaisse'] = $date = $session->get("inputFiltreCaisse");
        }
        
        $caisse = $caisseRepository->findByFiltre($filtre);         
        $pagination = $paginator->paginate(
            $caisse, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('caisse/index.html.twig', [
            "pagination" => $pagination,
            "date" => $date??"",
        ]);
    } 

    // CAISSE FILTRE ON 
        #[Route('/caisse/filtre', name: 'app_caisse_filtre')]
        public function filtreCaisse(Request $request,Session $session): Response
        {        
            if($request->isXmlHttpRequest() || $request->query->get('attrdate_caisse') != null){            
                $session->set("inputFiltreCaisse" , $request->query->get('attrdate_caisse'));
            }
            if($request->isXmlHttpRequest() || $request->query->get('attrdate_caisse') === ""){            
                $session->remove("inputFiltreCaisse");
            }
            
            return new JsonResponse($this->generateUrl("app_caisse"));
        }
    // CAISSE FILTRE OFF 

    // CLOTURE CAISSE ON 
        #[Route('/caisse/save', name: 'app_caisse_save')]
        public function save(DetteParVenteRepository $detteParVenteRepository,DetteRepository $detteRepository,EntityManagerInterface $manager,CommandeRepository $commandeRepository,PayementRepository $payementRepository,FraisRepository $fraisRepository,VenteRepository $venteRepository): Response
        {
            $date = new \DateTimeImmutable();
            $caisse = new Caisse();
            
            $totalVente = $venteRepository->findAllDay($date->format('Y-m-d'));
            $caisse->setTotalVente($totalVente??0);
            
            $totalFrais = $fraisRepository->findAllDay($date->format('Y-m-d'));
            $caisse->setTotalFrais($totalFrais??0);
            
            $totalDettePayer = $payementRepository->findAllDayDette($date->format('Y-m-d'));        
            $caisse->setTotalDettePayer($totalDettePayer??0);
            
            $totalDusPayer = $payementRepository->findAllDayDus($date->format('Y-m-d')); 
            // dd($totalDusPayer);
            $caisse->setTotalDusPayer($totalDusPayer??0);
            
            $totalCommande = $commandeRepository->findAllDay($date->format('Y-m-d'));        
            $caisse->setTotalCommande($totalCommande??0);

            $venteBenefice = $venteRepository->findTotalDate($date->format('Y-m-d'));
            // $TotalDusNonPayer = $detteRepository->findTotalDate($date->format('Y-m-d'));
            
            $detteBeneficeDay = $detteParVenteRepository->findTotalDatedette($date->format('Y-m-d'));
            $benefice = ($venteBenefice + $detteBeneficeDay) - ($totalFrais);
            // dd($detteBeneficeDay);
            $caisse->setBenefice($benefice);

            $manager->persist($caisse);
            $manager->flush();
            return $this->redirectToRoute("app_caisse");
        }        
    // CLOTURE CAISSE OFF 
    
    // DETAIL CAISSE ON 
        #[Route('/caisse/detail/ByDate/{date?}', name: 'app_caisse_detail_date')]
        public function detailDate($date,DetteRepository $detteRepository,EntityManagerInterface $manager,CommandeRepository $commandeRepository,PayementRepository $payementRepository,FraisRepository $fraisRepository,VenteRepository $venteRepository,CaisseRepository $caisseRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
        {                
            $caisse = $caisseRepository->findByDate($date);
            // dd($caisse);
            if(!empty($caisse)){
                $totalCaisse = $caisse["totalVente"] + $caisse["totalDettePayer"] - $caisse["totalFrais"] - $caisse["TotalDusPayer"];       
            }
            // dd($caisse);
            return $this->render('caisse/Alldetail.html.twig', [
                "caisse"  => $caisse,
                "date" =>$date??"",
                "totalCaisse" =>$totalCaisse??""
            ]);
        }        
    // DETAIL CAISSE OFF 

    // DETAIL CAISSE ON 
        #[Route('/caisse/detail/{id?}', name: 'app_caisse_detail')]
        public function detail($id,DetteRepository $detteRepository,EntityManagerInterface $manager,CommandeRepository $commandeRepository,PayementRepository $payementRepository,FraisRepository $fraisRepository,VenteRepository $venteRepository,CaisseRepository $caisseRepository,PaginatorInterface $paginator,Request $request,Session $session): Response
        {                        
            $caisse = $caisseRepository->find($id);
            
            return $this->render('caisse/detail.html.twig', [
                "caisse"  => $caisse
            ]);
        }        
    // DETAIL CAISSE OF 
}
