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
    public function add_personn(ValidatorInterface $validator)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $personne = new Personne();
        $personne->setNom(null);
        $personne->setPrenom("Jean");
        $personne->setEmail("jeanvanneste@gmail.com");
        $personne->setKap("kotejeux");

        $errors = $validator->validate($personne);
        if (count($errors) > 0){
            return $this->render("error.html.twig",[
                "entity" => "Personne",
            ]);
        }
        
        $entityManager->persist($personne);

        $entityManager->flush();

        return $this->render("confirmation.html.twig", [
            'entity' => "Personne",
        ]);
    }
}
