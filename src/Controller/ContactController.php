<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(): Response
    {
        $request = Request::createFromGlobals();
        $result = $this->formEvent($request);
        return $this->render('contact/index.html.twig', $result);
    }

    public function formEvent(Request $request) : ?array {
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        if(!empty($nom) && !empty($prenom))
        {
            return ['nom' => $nom, 'prenom'=>$prenom];
        }
        return ['nom' => null, 'prenom' => null];
    }
}
