<?php

namespace App\Controller;

use App\Entity\Editeur;
use App\Form\CreateEditeurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditeurController extends AbstractController
{
    /**
     * @Route("/editeur", name="editeur")
     */
    public function index()
    {
        $editeurs = $this->getDoctrine()->getRepository(Editeur::class)->findAll();
        return $this->render('editeur/index.html.twig', [
            'editeurs' => $editeurs,
        ]);
    }

    /**
     * @Route("/editeur/add", name="editeur_add")
     */
    public function add_editeur(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $entityManager = $this->getDoctrine()->getManager();

        $editeur = new Editeur();

        $form = $this->createForm(CreateEditeurType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $editeur = $form->getData();

            $entityManager->persist($editeur);

            $entityManager->flush();

            return $this->redirectToRoute('confirmation', ['id' => $editeur->getId(), 'entity' => 'editeur']);
        }

        return $this->render("editeur/new.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editeur/{id}/", name="editeur_show")
     */
    public function show_editeur(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $editeur = $em->getRepository(Editeur::class)->find($id);

        if (!$editeur) {
            throw $this->createNotFoundException(
                "Pas d'éditeurs correspondant à l'id ".$id
            );
        }

        return $this->render("editeur/details.html.twig", [
            'editeur' => $editeur,
        ]);
    }

    /**
     * @Route("/editeur/{id}/edit/", name="editeur_edit")
     */
    public function edit_editeur(int $id, Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $em = $this->getDoctrine()->getManager();
        $editeur = $em->getRepository(Editeur::class)->find($id);

        if (!$editeur) {
            throw $this->createNotFoundException(
                'No editeur found for id '.$id
            );
        }

        $form = $this->createForm(CreateEditeurType::class, $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $editeur = $form->getData();
            $em->flush();
            
            return $this->redirectToRoute("confirmation", ['id' => $id, 'entity' => 'editeur']);
        }

        return $this->render('editeur/update.html.twig', [
            'form' => $form->createView(),
            'editeur' => $editeur,
        ]);
    }
}
