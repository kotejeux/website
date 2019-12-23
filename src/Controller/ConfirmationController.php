<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ConfirmationController extends AbstractController
{
    /**
     * @Route("/confirmation", name="confirmation")
     */
    public function index(Request $request)
    {
        return $this->render('confirmation.html.twig', [
            'id' => $request->query->get('id'),
            'entity' => $request->query->get('entity'),
        ]);
    }
}
