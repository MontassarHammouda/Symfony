<?php

namespace App\Controller;

use App\Entity\CompteRendue;
use App\Form\CompteRendueType;
use App\Repository\CompteRendueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\UploaderHelper;

/**
 * @Route("/compte/rendue")
 */
class CompteRendueController extends AbstractController
{
    /**
     * @Route("/", name="compte_rendue_index", methods={"GET"})
     */
    public function index(CompteRendueRepository $compteRendueRepository): Response
    {
        return $this->render('compte_rendue/index.html.twig', [
            'compte_rendues' => $compteRendueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="compte_rendue_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $compteRendue = new CompteRendue();
        $form = $this->createForm(CompteRendueType::class, $compteRendue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['FileCompteRendue']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadArticleImage($uploadedFile);
                $compteRendue->setFile($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compteRendue);
            $entityManager->flush();

            return $this->redirectToRoute('compte_rendue_index');
        }

        return $this->render('compte_rendue/new.html.twig', [
            'compte_rendue' => $compteRendue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="compte_rendue_show", methods={"GET"})
     */
    public function show(CompteRendue $compteRendue): Response
    {
        return $this->render('compte_rendue/show.html.twig', [
            'compte_rendue' => $compteRendue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="compte_rendue_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CompteRendue $compteRendue): Response
    {
        $form = $this->createForm(CompteRendueType::class, $compteRendue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compte_rendue_index', [
                'id' => $compteRendue->getId(),
            ]);
        }

        return $this->render('compte_rendue/edit.html.twig', [
            'compte_rendue' => $compteRendue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="compte_rendue_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CompteRendue $compteRendue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteRendue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($compteRendue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('compte_rendue_index');
    }
}
