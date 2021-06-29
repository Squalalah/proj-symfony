<?php

namespace App\Controller;

use App\Entity\Course;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    #[Route('/course/delete/{id}', name: 'course_delete')]
    public function delete(Course $c,EntityManagerInterface $em) : Response {
        $em->remove($c);
        $em->flush();
        return $this->redirectToRoute('course');
    }
    #[Route('/course/update/{id}', name: 'course_update')]
    public function update(Course $c, EntityManagerInterface $em) : Response {
        $c->setStatus(!$c->getStatus());
        $em->flush();
        return $this->redirectToRoute('course');

    }

    #[Route('/course/add', name: 'course_add')]
    public function addCourse(Request $request, EntityManagerInterface $em) : Response {
        $title = $request->request->get('_title');
        if($title != null && strlen($title) > 0) {
            $title = htmlspecialchars($title);
            $c = new Course();
            $c->setStatus(0);
            $c->setTitle($title);
            $em->persist($c);
            $em->flush();
        }
        return $this->redirectToRoute('course');
    }
}