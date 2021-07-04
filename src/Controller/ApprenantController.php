<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Form\ApprenantType;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApprenantController extends AbstractController
{
    /**
     * @Route("/apprenant", name="apprenant")
     */
    public function index(): Response
    {
        return $this->render('apprenant/index.html.twig', [
            'controller_name' => 'ApprenantController',
        ]);
    }
    /**
     * @Route("/apprenant", name="apprenant")
     */
    public function form(Request $request, EntityManagerInterface $manager, ApprenantRepository $repos){

        $appre = $repos->findAll();
        $app = new Apprenant();
        $form = $this->createForm(ApprenantType::class,$app);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $manager->persist($app);
            $manager->flush();

            return $this->redirectToRoute('apprenant');
        }
        return $this->render('apprenant/index.html.twig',[

            'form' =>$form->createView(),
            'app' => $appre
        ]);
    }
     /**
     * @Route("/edit/{id}}", name="apprenant_edit")
     */
    public function edit(Apprenant $apprenant,EntityManagerInterface $em,Request $request){
        $form=$this -> createForm(ApprenantType::class,$apprenant);
        $form -> handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid()){
            $em -> flush();
           return  $this -> redirectToRoute('apprenant');
        }
        return $this->render('apprenant/edit.html.twig',[
            'apprenant' => $apprenant,
            'form'  => $form -> createView()
        ]);

        
    }
    


    /**
     * @Route("/apprenant/delete{id}", name="apprenant_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $appre = $manager->getRepository(Apprenant::class)->find($id);
        if ($appre != null ){
            $manager->remove($appre);
            $manager->flush();
        }
        return $this->redirectToRoute('apprenant');
    }



}
