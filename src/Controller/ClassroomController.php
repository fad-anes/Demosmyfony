<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classroom;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/readC', name: 'app_readC')]
    public function readC(): Response
    {
        
        $r=$this->getDoctrine()->getRepository(Classroom::class);
        
        $classrooms=$r->findAll();
        return $this->render('classroom/readC.html.twig', [
            'c' => $classrooms,
        ]);
    }
}
