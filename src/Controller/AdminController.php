<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(UserRepository $user): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $user->findAll()
        ]);
    }

    #[Route('/edit/{id}', name: '_edit')]
    public function edit(User $id, EntityManagerInterface $em) : Response {
        if(!in_array('ROLE_ADMIN',$id->getRoles()))
        {
            $id->setRoles(['ROLE_ADMIN']);
        }
        else {
            $id->removeRole('ROLE_ADMIN');
        }
        $em->flush();
        return $this->redirectToRoute('admin_index');
    }
    #[Route('/delete/{id}', name: '_delete')]
    public function delete(User $id, EntityManagerInterface $em) : Response {
        $em->remove($id);
        $em->flush();
        return $this->redirectToRoute('admin_index');
    }
}
