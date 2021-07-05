<?php

namespace App\Controller;

use App\Entity\Prospects;
use App\Form\ProspectsType;
use App\Repository\ProspectsRepository;
use App\Form\SearchFormationsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prospects')]
class ProspectsController extends AbstractController
{
    #[Route('/', name: 'prospects_index', methods: ['GET','POST'])]
    public function index(ProspectsRepository $prospectsRepository, Request $request): Response
    {
        // recherche 
        $prospects = $prospectsRepository->findAll();
        $form= $this->createForm(SearchformationsType::class);
        $search = $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            // rechercher les formations correspondants aux mots-clés
            $prospects= $prospectsRepository->search(
            $search->get('mots')->getData(),
            );
        }

        return $this->render('prospects/index.html.twig', [
            // 'prospects' => $prospectsRepository->findAll(),
            'prospects'=>$prospects,
            'form'=> $form->createView()
        ]);
       
    }

    #[Route('/new', name: 'prospects_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $prospect = new Prospects();
        $form = $this->createForm(ProspectsType::class, $prospect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prospect);
            $entityManager->flush();

            return $this->redirectToRoute('prospects_index');
        }

        return $this->render('prospects/new.html.twig', [
            'prospect' => $prospect,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'prospects_show', methods: ['GET'])]
    public function show(Prospects $prospect): Response
    {
        return $this->render('prospects/show.html.twig', [
            'prospect' => $prospect,
        ]);
    }

    #[Route('/{id}/edit', name: 'prospects_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prospects $prospect): Response
    {
        $form = $this->createForm(ProspectsType::class, $prospect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prospects_index');
        }

        return $this->render('prospects/edit.html.twig', [
            'prospect' => $prospect,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'prospects_delete', methods: ['POST'])]
    public function delete(Request $request, Prospects $prospect): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prospect->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prospect);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prospects_index');
    }
}
