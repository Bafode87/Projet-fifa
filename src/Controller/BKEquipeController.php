<?php

namespace App\Controller;

use App\Entity\BKEquipe;
use App\Form\BKEquipeType;
use App\Repository\BKEquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin/equipe')]
class BKEquipeController extends AbstractController
{
    #[Route('/', name: 'b_k_equipe_index', methods: ['GET'])]
    public function index(BKEquipeRepository $bKEquipeRepository): Response
    {

        return $this->render('bk_equipe/index.html.twig', [
            'b_k_equipes' => $bKEquipeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'b_k_equipe_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $bKEquipe = new BKEquipe();
        $form = $this->createForm(BKEquipeType::class, $bKEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bKEquipe);
            $entityManager->flush();

            return $this->redirectToRoute('b_k_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bk_equipe/new.html.twig', [
            'b_k_equipe' => $bKEquipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'b_k_equipe_show', methods: ['GET'])]
    public function show(BKEquipe $bKEquipe): Response
    {
        return $this->render('bk_equipe/show.html.twig', [
            'b_k_equipe' => $bKEquipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'b_k_equipe_edit', methods: ['GET','POST'])]
    public function edit(Request $request, BKEquipe $bKEquipe): Response
    {
        $form = $this->createForm(BKEquipeType::class, $bKEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('b_k_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bk_equipe/edit.html.twig', [
            'b_k_equipe' => $bKEquipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'b_k_equipe_delete', methods: ['POST'])]
    public function delete(Request $request, BKEquipe $bKEquipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bKEquipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bKEquipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('b_k_equipe_index', [], Response::HTTP_SEE_OTHER);
    }
}
