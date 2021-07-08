<?php

namespace App\Controller;

use App\Entity\Conventions;
use App\Form\SearchWordType;
use App\Form\ConventionsType;
use App\Repository\ConventionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/conventions')]
class ConventionsController extends AbstractController
{
    #[Route('/', name: 'conventions_index', methods: ['GET', 'POST'])]
    public function index(ConventionsRepository $conventionsRepository,Request $request): Response
    {
        $conventions = $conventionsRepository->findAll();
        // recherche 
        $form= $this->createForm(SearchWordType::class);
    //    $formStatut =$this->createForm(conventionsStatutType::class);
        $search = $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $conventions= $conventionsRepository->search(
            $search->get('mots')->getData(),
            );
        }
        return $this->render('conventions/index.html.twig', [
            'conventions' => $conventions,
            'form'=> $form->createView(),
            
        ]);
    }


    #[Route('/new', name: 'conventions_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $convention = new Conventions();
        $form = $this->createForm(ConventionsType::class, $convention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($convention);
            $entityManager->flush();

            return $this->redirectToRoute('conventions_index');
        }

        return $this->render('conventions/new.html.twig', [
            'convention' => $convention,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'conventions_show', methods: ['GET'])]
    public function show(Conventions $convention): Response
    {
        return $this->render('conventions/show.html.twig', [
            'convention' => $convention,
        ]);
    }

    #[Route('/{id}/edit', name: 'conventions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conventions $convention): Response
    {
        $form = $this->createForm(ConventionsType::class, $convention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conventions_index');
        }

        return $this->render('conventions/edit.html.twig', [
            'convention' => $convention,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'conventions_delete', methods: ['POST'])]
    public function delete(Request $request, Conventions $convention): Response
    {
        if ($this->isCsrfTokenValid('delete'.$convention->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($convention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conventions_index');
    }
}
