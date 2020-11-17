<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Entity\Location;
use App\Form\CreateLocationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="location")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $locations = $this->getDoctrine()->getRepository(Location::class)->findBy(array('ok' => false));

        return $this->render('location/index.html.twig', [
            'locations' => $locations,
        ]);
    }

    /**
     * @Route("/location/add/{jeuId}", name="location_add")
     */
    public function add_location(Request $request, $jeuId = null)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");
        $jeu = null;

        if ($jeuId) {
            $jeu = $this->getDoctrine()->getRepository(Jeu::class)->find($jeuId);
        }
        elseif ($request->query->get("jeu")) {
            $jeuId = $request->query->get("jeu");
            $jeu = $this->getDoctrine()->getRepository(Jeu::class)->find($jeuId);
        }

        $location = new Location();

        $form = $this->createForm(CreateLocationType::class, $location, array(
            'jeu_default' => $jeu,
        ));
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
