<?php

namespace App\Controller;

use App\Entity\Formateurs;
use App\Form\FormateursType;
use App\Repository\FormateursRepository;
use App\Repository\FormationsRepository;
use 
Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SearchFormateursType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formateurs')]
class FormateursController extends AbstractController
{
    #[Route('/', name: 'formateurs_index', methods: ['GET', 'POST'])]
    public function index(FormateursRepository $formateursRepository, Request $request,): Response
    {   
        // recherche 
        $formateurs = $formateursRepository->findAll();
        $form= $this->createForm(SearchformateursType::class);
        $search = $form->handleRequest($request);
        
        
        if($form->isSubmitted() && $form->isValid()){
            
            $formateurs= $formateursRepository->search(
            $search->get('mots')->getData(),
            );
        }
        return $this->render('formateurs/index.html.twig', [
            'formateurs' => $formateurs,
            'form'=> $form->createView(),
        ]);
    }

    #[Route('/new', name: 'formateurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $formateur = new Formateurs();
        $form = $this->createForm(FormateursType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formateur);
            $entityManager->flush();

            return $this->redirectToRoute('formateurs_index');
        }

        return $this->render('formateurs/new.html.twig', [
            'formateur' => $formateur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'formateurs_show', methods: ['GET'])]
    public function show(Formateurs $formateur): Response
    {
        return $this->render('formateurs/show.html.twig', [
            'formateur' => $formateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'formateurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formateurs $formateur): Response
    {
        $form = $this->createForm(FormateursType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formateurs_index');
        }

        return $this->render('formateurs/edit.html.twig', [
            'formateur' => $formateur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'formateurs_delete', methods: ['POST'])]
    public function delete(Request $request, Formateurs $formateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formateurs_index');
    }
}
