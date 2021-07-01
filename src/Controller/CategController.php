<?php

namespace App\Controller;

use App\Entity\Categ;
use App\Form\CategType;
use App\Repository\CategRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categ')]
class CategController extends AbstractController
{
    #[Route('/', name: 'categ_index', methods: ['GET'])]
    public function index(CategRepository $categRepository): Response
    {
        return $this->render('categ/index.html.twig', [
            'categs' => $categRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'categ_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $categ = new Categ();
        $form = $this->createForm(CategType::class, $categ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categ);
            $entityManager->flush();

            return $this->redirectToRoute('categ_index');
        }

        return $this->render('categ/new.html.twig', [
            'categ' => $categ,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'categ_show', methods: ['GET'])]
    public function show(Categ $categ): Response
    {
        return $this->render('categ/show.html.twig', [
            'categ' => $categ,
        ]);
    }

    #[Route('/{id}/edit', name: 'categ_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categ $categ): Response
    {
        $form = $this->createForm(CategType::class, $categ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categ_index');
        }

        return $this->render('categ/edit.html.twig', [
            'categ' => $categ,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'categ_delete', methods: ['POST'])]
    public function delete(Request $request, Categ $categ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categ->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categ);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categ_index');
    }
}
