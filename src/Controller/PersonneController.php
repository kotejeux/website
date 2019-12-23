<?php

namespace App\Controller;


use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="add_personne")
     */
    public function add_personn()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $personne = new Personne();
        $personne->setNom("Vanneste");
        $personne->setPrenom("Jean");
        $personne->setEmail("jeanvanneste@gmail.com");
        $personne->setKap("kotejeux");
        
        $entityManager->persist($personne);

        $entityManager->flush();

        return $this->render("confirmation.html.twig", [
            'entity' => "Personne",
            "id" => $personne->getId(),
        ]);
    }

    /**
     * @Route("/personne/{id}", name="personne_detail")
     */
    public function show_personne(int $id)
    {
        $personne = $this->getDoctrine()
            ->getRepository(Personne::class)
            ->find($id);
        
        if (!$personne)
        {
            throw  $this->createNotFoundException(
                'No person fount for id '.$id
            );
        }

        return $this->render('personne/personne.html.twig', [
            "nom" => $personne->getNom(),
            "prenom" => $personne->getPrenom(),
            "kap" => $personne->getKap(),
        ]);
    }
}
