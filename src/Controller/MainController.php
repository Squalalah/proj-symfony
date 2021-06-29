<?php

namespace App\Controller;

use App\Repository\CouleurRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(CouleurRepository $repo): Response
    {
        $couleurs = $repo->findAll();
        $date = (new DateTime('now'))->format('d-m-Y H:i:s');
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
            'date' => $date,
            'couleurs' => $couleurs
        ]);
    }
}
