<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api')]
class ApiController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    #[Route('/simulation', name: 'simulation', methods: 'POST')]
    public function simulation(Request $request): Response {
        $data = json_decode($request->getContent());
        $poids = $data->poids;
        $taille = $data->taille;
        $imc = round($poids / pow($taille,2), 2);
        $array = array('poids' => $poids, 'taille' => $taille, 'imc' => $imc, 'status' => $this->getStatus($imc));
        return $this->json($array);
    }

    public function getStatus($imc) : string
    {
        switch(true)
        {
            case ($imc < 18.5): {
                return 'maigreur';
            }
            case ($imc < 25): {
                return 'normal';
            }
            case ($imc < 30): {
                return 'surpoids';
            }
            case ($imc < 35): {
                return 'Obésité modérée';
            }
            case ($imc < 40): {
                return 'Obésité sévère';
            }
            default: {
                return 'Obésité morbide ou massive';
            }
        }
    }
}
