<?php

namespace App\Controller;

use App\Entity\Jeu;
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
}
