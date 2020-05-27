<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Form\CreateJeuType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    /**
     * @Route("/jeu", name="jeu")
     */
    public function index()
    {
        $jeux = $this->getDoctrine()->getRepository(Jeu::Class)->findAll();

        return $this->render('jeu/index.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    /**
     * @Route("/jeu/add", name="jeu_add")
     */
    public function add_jeu(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $entityManager = $this->getDoctrine()->getManager();
        
        $jeu = new Jeu();

        $form = $this->createForm(CreateJeuType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jeu = $form->getData();

            $entityManager->persist($jeu);

            $entityManager->flush();

            return $this->redirectToRoute('confirmation', ['id' => $jeu->getId(), "entity" => "jeu"]);
        }

        return $this->render("jeu/new.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
