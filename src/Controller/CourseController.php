<?php

namespace App\Controller;

use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    #[Route('/course', name: 'course')]
    public function index(CourseRepository $course): Response
    {
        $liste = $course->findAll();
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
            'courses' => $liste
        ]);
    }
}
