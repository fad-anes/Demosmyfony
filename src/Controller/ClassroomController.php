<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classroom;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ClassroomformType;

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
    #[Route('/addC', name: 'app_addC')]
    public function addC(ManagerRegistry $doctrine,
    Request $request)
{
    $classroom= new Classroom();
$form=$this->createForm(ClassroomformType::class,$classroom);
                   $form->handleRequest($request);
                   if($form->isSubmitted()){
                    //Action d'ajout
                       $em =$doctrine->getManager() ;
                       $em->persist($classroom);
                       $em->flush();
            return $this->redirectToRoute("app_readC");
        }
    return $this->renderForm("classroom/addC.html.twig",
                       array("f"=>$form));
                   }
                   #[Route('/updateC/{id}', name: 'app_updateC')]
  public function updateC($id,ClassroomRepository $rep,
  ManagerRegistry $doctrine,Request $request)
               {
      
      $classroom=$rep->find($id);
    $form=$this->createForm(ClassroomFormType::class,$classroom);
                 $form->handleRequest($request);
                if($form->isSubmitted()){
            
                 $em =$doctrine->getManager() ;
                $em->flush();
             return $this->redirectToRoute("app_readC");
                       }
        return $this->renderForm("classroom/addC.html.twig",
                                      array("f"=>$form));
                                  }
                                  #[Route('/deleteC/{id}', name: 'app_deleteC')]
                                  public function delecteC($id, ClassroomRepository $rep, 
                                  ManagerRegistry $doctrine): Response
                                  {
                                      
                                      $classroom=$rep->find($id);
                                      
                                      $em=$doctrine->getManager();
                                      $em->remove($classroom);
                                      
                                      $em->flush();
                                      return $this->redirectToRoute('app_readC');
                                  }
                  
}
