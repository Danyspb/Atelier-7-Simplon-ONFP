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

}
