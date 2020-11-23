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
        } elseif ($request->query->get("jeu")) {
            $jeuId = $request->query->get("jeu");
            $jeu = $this->getDoctrine()->getRepository(Jeu::class)->find($jeuId);
        }

        $entityManager = $this->getDoctrine()->getManager();

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

    /**
     * @Route("location/{id}/", name="location_show")
     */
    public function show_location(int $id)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $location = $this->getDoctrine()->getRepository(Location::class)->find($id);

        return $this->render("location/details.html.twig", [
            "location" => $location,
        ]);
    }

    /**
     * @Route("location/{id}/paiement", name="location_paiement")
     */
    public function location_is_payed(int $id)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $entityManager = $this->getDoctrine()->getManager();

        $location = $this->getDoctrine()->getRepository(Location::class)->find($id);

        $location->setPaye(true);

        $entityManager->persist($location);

        $entityManager->flush();

        return $this->redirectToRoute('location_show', ["id" => $id]);
    }

    /**
     * @Route("location/{id}/retour", name="location_retour")
     */
    public function retour_location(int $id)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $em = $this->getDoctrine()->getManager();

        $location = $this->getDoctrine()->getRepository(Location::class)->find($id);

        $location->setOk(true);

        $em->persist($location);
        $em->flush();

        return $this->redirectToRoute('location_show', ["id" => $id]);
    }

    /**
     * @Route("location/{id}/edit" , name="location_edit")
     */
    public function update_location(int $id, Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $em = $this->getDoctrine()->getManager();

        $location = $em()->getRepository(Location::class)->find($id);

        if (!$location) {
            throw $this->createNotFoundException(
                "Pas de location correspondant à l'id."
            );
        }

        $form = $this->createForm(CreateLocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $location= $form->getData();
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute("location");
        }

        return $this->render("jeu/update.html.twig", [
            "location" => $location,
            "form" => $form->createView()
        ]);
    }
}
