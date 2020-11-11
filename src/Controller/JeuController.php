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
        $jeux = $this->getDoctrine()->getRepository(Jeu::Class)->findBy([], array('titre' => 'ASC'));

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

    /**
     * @Route("jeu/{id}", name="jeu_show")
     */
    public function show_jeu(int $id)
    {
        $jeu = $this->getDoctrine()->getRepository(Jeu::class)->find($id);
        if (!$jeu)
        {
            throw $this->createNotFoundError(
                "Pas de jeu avec l'id ".$id
            );
        }

        return $this->render("jeu/details.html.twig", [
            "jeu" => $jeu,
            "editeur" => $jeu->getEditeur(),
        ]);
    }

    /**
     * @Route("jeu/{id}/edit", name="jeu_edit")
     */
    public function update_jeu(int $id, Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $entityManager = $this->getDoctrine()->getManager();
        $jeu = $entityManager->getRepository(Jeu::class)->find($id);

        if(!$jeu)
        {
            throw $this->createNotFoundException(
                "Pas de jeu correspondant à l'id ".$id
            );
        }

        $form = $this->createForm(CreateJeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $jeu = $form->getData();
            $entityManager->persist($jeu);
            $entityManager->flush();

            return $this->redirectToRoute("jeu_show", ['id' => $id]);
        }

        return $this->render("jeu/update.html.twig", [
            "jeu" => $jeu,
            "form" => $form->createView(),
        ]);

    }

    /**
     * @Route("jeu/{id}/delete", name="jeu_delete")
     */
    public function delete_jeu($id)
    {
        $this->denyAccessUnlessGranted("ROLE_KEJ");

        $em = $this->getDoctrine()->getManager();
        $jeu = $em->getRepository(Jeu::class)->find($id);

        $em->remove($jeu);
        $em->flush();

        return $this->render("confirmation_delete.html.twig", [
            "id" => $id,
            "entity" => "jeu",
        ]);
    }
}
