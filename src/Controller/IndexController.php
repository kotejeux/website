<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function main_page()
    {
        return $this->render('index.html.twig');
    }

    public function to_mainpage()
    {
        return $this->redirectToRoute("index");
    }
}