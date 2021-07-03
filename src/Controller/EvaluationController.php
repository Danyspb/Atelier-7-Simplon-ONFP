<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvaluationController extends AbstractController
{
    /**
     * @Route("/evaluation", name="evaluation")
     */
    public function index(): Response
    {
        return $this->render('evaluation/index.html.twig', [
            'controller_name' => 'EvaluationController',
        ]);
    }

    /**
     * @Route("/evaluation", name="evaluation")
     */
    public function form(Request $req, EntityManagerInterface $manager, ApprenantRepository $repo){

        $app = $repo->findAll();
        $eva = new Evaluation();
        $form = $this->createForm(EvaluationType::class);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($eva);
            $manager->flush();

            return $this->redirectToRoute('evaluation');
        }

        return $this->render('evaluation/index.html.twig',[
            'form' => $form->createView(),
            'app' => $app
        ]);

    }

    /**
     * @Route("/evaluation/delete{id}", name="evaluation_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $eva = $manager->getRepository(Evaluation::class)->find($id);
        if ($eva != null ){
            $manager->remove($eva);
            $manager->flush();
        }
        return $this->redirectToRoute('evaluation');
    }
}
