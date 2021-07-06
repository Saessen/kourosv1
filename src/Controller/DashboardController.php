<?php

namespace App\Controller;

use App\Repository\DevisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    // TODO ajout des données des entités: Devis + Factures + Sessions 
    public function index(DevisRepository $devisRepository): Response
    {
        
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'devi'=>$devisRepository->findAll()]);
    }
}
