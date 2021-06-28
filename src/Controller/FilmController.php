<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'film')]
    public function film(): Response
    {
        $valeur = 42;
        $chaine = 'Coucou twig';
        $name = 'Film';
        $tableau = ['pomme', 'poire', 'cerise'];
        $tab = [
            'valeur' => $valeur,
            'chaine' => $chaine,
            'tableau'=> $tableau,
            'name' => $name
        ];
        //1er paramètre : page twig à laquelle on envoit les données
        //2e paramètre : tableau de variables à envoyer
        return $this->render('film/film.html.twig', $tab);
    }
}
