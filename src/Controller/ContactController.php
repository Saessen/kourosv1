<?php

namespace App\Controller;
use App\Repository\ProspectsRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\OpcoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'contact')]
    public function index(ProspectsRepository $ProspectsRepository): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'prospects'=> $ProspectsRepository->findAll()
        ]);
    }

    /**
    * @Route("contact/client/", name="contact_client")
    */
    public function client(ProspectsRepository $ProspectsRepository):Response
    {
        return $this->render('contact/client.html.twig', [
            'controller_name' => 'ContactController',
            'prospects'=> $ProspectsRepository->findAll()
        ]);
    }

    /**
    * @Route("contact/entreprise/", name="contact_entreprise")
    */
    public function entreprise(EntrepriseRepository $EntrepriseRepository):Response
    {
        $entreprise = $EntrepriseRepository->findAll();
        return $this->render('contact/entreprise.html.twig', [
            'controller_name' => 'ContactController',
            'entreprise'=>$entreprise
        ]);
    }
    // TODO ajouter le repository OPCO et récupérer les données 
    /**
    * @Route("contact/opco/", name="contact_opco")
    */
    public function opco(OpcoRepository $opcoRepository):Response
    {
        $opco = $opcoRepository->findAll();
        return $this->render('contact/opco.html.twig', [
            'controller_name' => 'ContactController',
            'opco'=> $opco
        ]);
    }
}
