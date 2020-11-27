<?php

namespace App\Controller;

use App\Entity\Jeu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class JeuAPIController extends AbstractController
{
    /**
     * @Route("/api/jeux", name="jeuAPI", methods={"GET"})
     */
    public function index()
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        $serializer = new Serializer([$normalizer], [$encoder]);
        $em = $this->getDoctrine()->getManager();
        $jeux = $em->getRepository(Jeu::class)->findBy([], array('titre' => 'ASC'));
        $jsonContent = $serializer->serialize($jeux, "json");

        $response = new JsonResponse();
        $response->setContent($jsonContent);
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/api/jeux/{id}", name="jeuDetailsAPI", methods={"GET"})
     */
    public function show_game(int $id)
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        $serializer = new Serializer([$normalizer], [$encoder]);
        $em = $this->getDoctrine()->getManager();
        $jeu = $em->getRepository(Jeu::class)->find($id);
        $jsonContent = $serializer->serialize($jeu, "json");

        $response = new JsonResponse();
        $response->setContent($jsonContent);
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
