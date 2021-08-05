<?php

namespace App\Controller;

use App\Entity\Template;
use App\Form\TemplateType;
use App\Repository\TemplateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TemplateController extends AbstractController
{
    /**
     * @Route("/template", name="template_index", methods={"GET"})
     */
    public function index(TemplateRepository $templateRepository): Response
    {
        return $this->render('template/index.html.twig', [
            'templates' => $templateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/template/new", name="template_new", methods={"GET","POST"})
     */
    public function new(Request $request, Filesystem $filesystem): Response
    {
        $template = new Template();
        $form = $this->createForm(TemplateType::class, $template);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère le nom du fichier entré dans le formulaire 
            $filename = $template->getFilename();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($template);
            $entityManager->flush();

            // On veut créer un template dans un dossier templates situé à la racine de public et non plus dans le dossier templates à la racine du projet. Voir la doc pour changer le default_path du kernel.

            // La méthode dumpFile() permet de créer un fichier temporaire à l'endroit indiqué en premier argument, et ce qui doit y figurer dans le second.
            $filesystem->dumpFile('templates/' . $filename . '.html.twig', $template->getTexte());

            return $this->redirectToRoute('template_index');
        }

        return $this->renderForm('template/new.html.twig', [
            'template' => $template,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/template/{id}", name="template_show", methods={"GET"})
     */
    public function show(Template $template): Response
    {
        return $this->render('template/show.html.twig', [
            'template' => $template,
        ]);
    }

    /**
     * @Route("/template/{id}/edit", name="template_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Template $template): Response
    {
        $form = $this->createForm(TemplateType::class, $template);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('template_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('template/edit.html.twig', [
            'template' => $template,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/template/{id}", name="template_delete", methods={"POST"})
     */
    public function delete(Request $request, Template $template): Response
    {
        if ($this->isCsrfTokenValid('delete'.$template->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($template);
            $entityManager->flush();
        }

        return $this->redirectToRoute('template_index', [], Response::HTTP_SEE_OTHER);
    }
}
