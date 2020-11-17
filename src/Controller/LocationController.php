<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Location;
use App\Form\CreateLocationType;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="location")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $locations = $this->getDoctrine()->getRepository(Location::Class)->findBy(array('ok' => false));

        return $this->render('location/index.html.twig', [
            'locations' => $locations,
        ]);
    }

    /**
     * @Route("/location/add", name="location_add")
     */
    public function add_location(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $entityManager = $this->getDoctrine()->getManager();

        $location = new Location();

        $form = $this->createForm(CreateLocationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $location = $form->getData();
            $location->setOk(false);


            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('location');
        }

        return $this->render("location/new.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
