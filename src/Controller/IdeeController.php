<?php

namespace App\Controller;

use App\Entity\Idee;
use App\Form\IdeeType;
use App\Repository\IdeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/idee')]
class IdeeController extends AbstractController
{
    #[Route('/', name: 'idee_index', methods: ['GET'])]
    public function index(IdeeRepository $ideeRepository): Response
    {
        return $this->render('idee/index.html.twig', [
            'idees' => $ideeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'idee_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $idee = new Idee();
        $form = $this->createForm(IdeeType::class, $idee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($idee);
            $entityManager->flush();

            return $this->redirectToRoute('idee_index');
        }
        return $this->render('idee/new.html.twig', [
            'idee' => $idee,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'idee_show', methods: ['GET'])]
    public function show(Idee $idee): Response
    {
        $categ = $idee->getIdeeCategory();
        return $this->render('idee/show.html.twig', [
            'idee' => $idee,
            'category' => $categ
        ]);
    }

    #[Route('/{id}/edit', name: 'idee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Idee $idee): Response
    {
        $form = $this->createForm(IdeeType::class, $idee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('idee_index');
        }

        return $this->render('idee/edit.html.twig', [
            'idee' => $idee,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'idee_delete', methods: ['POST'])]
    public function delete(Request $request, Idee $idee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$idee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($idee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('idee_index');
    }
}
