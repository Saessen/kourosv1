<?php

namespace App\Controller;

use App\Entity\Conventions;
use App\Form\SearchWordType;
use App\Form\ConventionsType;
use App\Repository\DevisRepository;
use App\Form\ConventionsParticipantsType;
use App\Repository\ConventionsRepository;
use jonasarts\Bundle\TCPDFBundle\TCPDF\TCPDF;
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
        // dd("1");
        if ($form->isSubmitted() && $form->isValid()) {
            // dd("2");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($convention);
            // dd($convention);
            $entityManager->flush();
            // dd('ca marche');
            return $this->redirectToRoute('conventions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conventions/new.html.twig', [
            'convention' => $convention,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/conventions/{id}/pdf", name="conventions_pdf", methods={"GET","POST"})
     */
    public function makePdf(Conventions $conventions, ConventionsRepository $conventionsRepository, $id,  \jonasarts\Bundle\TCPDFBundle\TCPDF\TCPDF $pdf)
    {
        
        $conventions = $conventionsRepository->find($id);
        // Les paramètres pour la mise en page ne sont modifiables qu'avec une classe extends. Sinon modifier à même le twig.
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        // Ces informations ne sont pas visibles directement sur le pdf
        $pdf->SetCreator('Aure&Lu');
        $pdf->SetAuthor('Cie, Lu Cie');
        $pdf->SetTitle('Titre bien cool');
        $pdf->SetSubject('Créer un pdf en lisant parfois la doc');


        // Pour supprimer les headers et footer par défaut
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Créer la page du pdf
        $pdf->AddPage();

        // Appel du template et peuplage de la variable devis
        // $html = $this->renderView('devis/pdfdevis.html.twig', ['devis' => $devisRepository->find($id)]);
        // $pdf->WriteHtml($html);

        // Mofifier l'array pour definir chaque variable et remplacer les expressions du twig par les informations de la variable
        $html = $this->renderView('@templates/essai-template.html.twig', [  'Id' => $conventions->getId(),
                                                                            'prospect' => $conventions->getProspect(),
                                                                            'lienFormation' => $conventions->getLieuFormation(),
                                                                            'devis' => $conventions->getDevis(),
                                                                            'commentaire' => $conventions->getCommentaire(),
                                                                            'participants' => $conventions->getParticipants(),
                                                                    ]);
        $pdf->WriteHtml($html);


        $pdf->lastPage();

        
        //On ferme et on exporte le document 
        $pdf->Output('conventions' . $conventions->getId() . '.pdf', 'I');
    }


    // ANCHOR
    #[Route('/new/{id}/devis', name: 'convention_new_devis', methods: ['GET', 'POST'])]
    public function newDevis(Request $request, DevisRepository $devisRepository, $id): Response
    {   
        $devis = $devisRepository->find($id);
        
        $convention = new Conventions();
        // $convention->setEntrepriseName($devis->getClient());
        $convention->setDevis($devis);
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
