<?php

namespace App\Controller;

use App\Entity\Opco;
use App\Form\OpcoType;
use App\Form\SearchWordType;
use App\Repository\OpcoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/opco')]
class OpcoController extends AbstractController
{
    #[Route('/', name: 'opco_index', methods: ['GET', 'POST'])]
    public function index(OpcoRepository $opcoRepository, Request $request): Response
    {
        // recherche 
        $opco = $opcoRepository->findAll();
        $form= $this->createForm(SearchWordType::class);
        $search = $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            // rechercher les opco correspondants aux mots-clés
            $opco= $opcoRepository->search(
            $search->get('mots')->getData(),
            );
        }

        return $this->render('opco/index.html.twig', [
            // 'opco' => $opcoRepository->findAll(),
            'opco'=>$opco,
            'form'=> $form->createView()
        ]);
        
    }

    #[Route('/new', name: 'opco_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $opco = new Opco();
        $form = $this->createForm(OpcoType::class, $opco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($opco);
            $entityManager->flush();

            return $this->redirectToRoute('opco_index');
        }

        return $this->render('opco/new.html.twig', [
            'opco' => $opco,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'opco_show', methods: ['GET'])]
    public function show(Opco $opco): Response
    {
        return $this->render('opco/show.html.twig', [
            'opco' => $opco,
        ]);
    }

    #[Route('/{id}/edit', name: 'opco_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Opco $opco): Response
    {
        $form = $this->createForm(OpcoType::class, $opco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('opco_index');
        }

        return $this->render('opco/edit.html.twig', [
            'opco' => $opco,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'opco_delete', methods: ['POST'])]
    public function delete(Request $request, Opco $opco): Response
    {
        if ($this->isCsrfTokenValid('delete'.$opco->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($opco);
            $entityManager->flush();
        }

        return $this->redirectToRoute('opco_index');
    }
}
