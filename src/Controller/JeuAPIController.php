<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Entity\Jeu;

class JeuAPIController extends AbstractController
{
    /**
     * @Route("/api/jeux", name="jeuAPI", methods={"GET"})
     */
    public function index()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $em = $this->getDoctrine()->getManager();
        $jeux = $em->getRepository(Jeu::class)->findAll();
        $jsonContent = $serializer->serialize($jeux, "json");

        $response = new JsonResponse();
        $response->setContent($jsonContent);
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
