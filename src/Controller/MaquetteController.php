<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaquetteController extends AbstractController
{
    #[Route('/maquette', name: 'maquette')]
    public function index(): Response
    {
        $name = 'Essai de d\'intégration de maquette';
        $navTitle = 'Essai de maquette';
        $tableau = [
            ['prenom' => 'Brad', 'nom' => 'Pitt', 'age' => 42],
            ['prenom' => 'Angelina', 'nom' => 'Jolie', 'age' => 23],
            ['prenom' => 'Marie', 'nom' => 'Curie', 'age' => 45]
        ];
        return $this->render('maquette/index.html.twig', [
            'tableau' => $tableau,
            'name' => $name,
            'navTitle' => $navTitle
        ]);
    }
}
