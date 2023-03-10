<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/tag')]
class BKTagController extends AbstractController
{
    #[Route('/', name: 'b_k_tag_index', methods: ['GET'])]
    public function index(TagRepository $tagRepository): Response
    {
        return $this->render('bk_tag/index.html.twig', [
            'tags' => $tagRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'b_k_tag_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute('b_k_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bk_tag/new.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'b_k_tag_show', methods: ['GET'])]
    public function show(Tag $tag): Response
    {
        return $this->render('bk_tag/show.html.twig',  [
            'tag' => $tag,
        ]);
    }

    #[Route('/{id}/edit', name: 'b_k_tag_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Tag $tag): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('b_k_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bk_tag/edit.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'b_k_tag_delete', methods: ['POST'])]
    public function delete(Request $request, Tag $tag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tag);
            $entityManager->flush();
        }

        return $this->redirectToRoute('b_k_tag_index', [], Response::HTTP_SEE_OTHER);
    }
}
