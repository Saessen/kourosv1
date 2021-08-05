<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Form\DevisType;
use App\Entity\Prospects;
use App\Form\SearchWordType;
use App\Form\DevisStatutType;
use App\Repository\DevisRepository;
use App\Repository\ProspectsRepository;
use App\Repository\FormationsRepository;
use jonasarts\Bundle\TCPDFBundle\TCPDF\TCPDF;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DevisController extends AbstractController
{
    /**
     * @Route("/devis", name="devis_index", methods={"GET","POST"})
     */
    public function index(DevisRepository $devisRepository, Request $request, FormationsRepository $formationsRepository): Response
    {   
        $devis = $devisRepository->findAll();
        $formations= $formationsRepository->findAll();

        $form= $this->createForm(SearchWordType::class);
        $formStatut =$this->createForm(DevisStatutType::class);
        $search = $form->handleRequest($request);
     
        if($form->isSubmitted() && $form->isValid()){
            $devis= $devisRepository->search(
            $search->get('mots')->getData(),
            );
        }

        $formStatut->handleRequest($request);

        if ($formStatut->isSubmitted() && $formStatut->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devis_index');
        }
    
       // calcul
    // $prix = 0;
    // for($i=0; $i<count($devis); $i++){
    //     foreach ($devis->getFormations()as $formations)
    //     {
    //         $prix = ($formations->getPrixJour() * $devis->getNbrParticipants()) + $devis->getFraisAnnexes();
    //     }
    // }
    //    $calcul= $devisRepository->find($id);
    //    $prix = 0;
    //   foreach($calcul->getFormations()as $formations=>$prixJour){
    //       $prix = ($formations->getPrixJour() * $calcul->getNbrParticipants()) + $calcul->getFraisAnnexes();
    //   }
    //    $devis=[];
    //    $prix = 0;
    //    foreach($devis->getFormation()as $formations){
    //        $prix = $formations->getPrixJour() * $devis->getNbrParticipants();
    //    }
    //    foreach ($formations as $devis->getFormations()=>$prixJour){
    //        $prix= ($formations->getPrixJour()* $devis->getNbrParticipants())+ $devis->getFraisAnnexes();
    //    }
    //    foreach ($devis as $devi)
    //    {
    //      print_r($devi);
    //         foreach ($devi as $prix){
    //             $prix= (($devi->getFormations("prixJour") * $devi->getNbrParticipants())+ $devi->getFraisAnnexes());
    //             dd($prix);
    //         }
    // }
        return $this->render('devis/index.html.twig', [
            'devis' => $devis,
            'form'=> $form->createView(),
            'formStatut'=>$formStatut->createView(),
            'formations'=>$formations,
            // 'prix'=>$prix,
        ]);
    }


    /**
     * @Route("/devis/new", name="devis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $devi = new Devis();
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($devi);
            $entityManager->flush();

            return $this->redirectToRoute('devis_index');
        }

        return $this->render('devis/new.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/devis/{id}/pdf", name="devis_pdf", methods={"GET","POST"})
     */
    public function makePdf(Devis $devis, DevisRepository $devisRepository, $id,  \jonasarts\Bundle\TCPDFBundle\TCPDF\TCPDF $pdf)
    {
        
        $devis = $devisRepository->find($id);
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
        $html = $this->renderView('@templates/essai-template.html.twig', [  'formations' => $devis->getFormations(),
                                                                            'nbrParticipants' => $devis->getNbrParticipants(),
                                                                            'tva' => $devis->getTva(),
                                                                            'dateCreation' => $devis->getDateCreation(),
                                                                            'client' => $devis->getClient(),
                                                                            'dateDebut' => $devis->getDateDebut(),
                                                                            'dateFin' => $devis->getDateFin(),
                                                                            'numeroDevis' => $devis->getNumeroDevis(),
                                                                            'methode' => $devis->getMethode(),
                                                                            'fraisAnnexes' => $devis->getFraisAnnexes(),
                                                                            'opco' => $devis->getOpco(),
                                                                            'prix' => $devis->getPrixes(),
                                                                            'nomContact' => $devis->getNomContact(),
                                                                    ]);
        $pdf->WriteHtml($html);


        $pdf->lastPage();

        
        //On ferme et on exporte le document 
        $pdf->Output('devis' . $devis->getId() . '.pdf', 'I');
    }

    // ANCHOR
    /**
     * @Route("/new/{id}/prospect", name="devis_new_prospect", methods={"GET","POST"})
     */
    public function newProspect(Request $request, ProspectsRepository $prospectsRepository, $id): Response
    {   
        $prospects = $prospectsRepository->find($id);
        // dd($prospects);
        $devi = new Devis();
        
        // $devi->setNomContact($prospects->getNom());
        // $devi->setNomContact($prospects->getNom());
        $devi->setClient(($prospects));
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($devi);
            $entityManager->flush();

            return $this->redirectToRoute('devis_index');
        }

        return $this->render('devis/new.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/devis/{id}", name="devis_show", methods={"GET"})
     */
    public function show(Devis $devi, DevisRepository $devisRepository, $id): Response
    {
        $devis= $devisRepository->find($id);
        $prix = 0;
        foreach($devis->getFormations()as $formations){
           $prix = ($formations->getPrixJour() * $devis->getNbrParticipants()) + $devis->getFraisAnnexes();
        }
        return $this->render('devis/show.html.twig', [
            'devi' => $devi,
            'prix' => $prix,
        ]);
    }
// ANCHOR
    // /**
    //  * @Route("/devis/editStatut/{id}", name="edit_statut")
    //  */
    // public function inscriptionEvent($id, DevisRepository $devisRepository)
    // {
    //     $devis = $devisRepository->find($id);
    //     $statut = $devisRepository->findBy(['statut'=> '0']);
    //     // $devis = $this->getdevis();
    //     $devis->setStatut($devis);
    //     $em = $this->getDoctrine()->getManager();
    //     $em->persist($statut);
    //     $em->flush();
    //     //
    //     return $this->redirectToRoute('devis_index');
        
        
    // }

    /**
     * @Route("/devis/{id}/edit", name="devis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Devis $devi): Response
    {
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devis_index');
        }

        return $this->render('devis/edit.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }
   // ANCHOR

    /**
     * @Route("devis/{id}/edit/statut", name="edit_statut", methods={"GET","POST"})
     */
    public function editStatut(Request $request, Devis $devi): Response
    {
        $form = $this->createForm(DevisStatutType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devis_index');
        }

        return $this->render('devis/edit.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    // #[Route('/{id}/statutEdit', name: 'devis_statutEdit', methods: ['GET', 'POST'])]
    // public function statutEdit(Request $request, Devis $devi): Response
    // {
    //     $form = $this->createForm(DevisSatutType::class, $devi);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('devis_index');
    //     }

    //     return $this->render('devis/edit.html.twig', [
    //         'devi' => $devi,
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
     * @Route("/devis/{id}", name="devis_delete", methods={"POST"})
     */
    public function delete(Request $request, Devis $devi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($devi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devis_index');
    }
}
