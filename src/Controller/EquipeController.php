<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equipe', name: 'equipe')]
class EquipeController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(EquipeRepository $er): Response
    {
        return $this->render('equipe/index.html.twig', [
            'controller_name' => 'EquipeController',
            'equipes' => $er->findAll()
        ]);
    }
    #[Route('/add', name: '_add')]
    public function ajouter(EquipeRepository $er, Request $request, EntityManagerInterface $em): Response
    {
        //Form ajout d'equipe
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, null, array ('action' => $this->generateUrl('equipe_dead')));
        return $this->render('equipe/add.html.twig', [
            'formAdd' => $form->createView()
        ]);
    }
    #[Route('/dead', name: '_dead')]
    public function dead(Request $request) : response {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe, array ('action' => $this->generateUrl('equipe_dead')));
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            return $this->redirectToRoute('yolo');
        }
    }
}
