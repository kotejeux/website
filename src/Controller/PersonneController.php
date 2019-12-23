<?php

namespace App\Controller;


use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="add_personne")
     */
    public function add_personn(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $personne = new Personne();
        $personne->setNom("Vanneste");
        $personne->setPrenom("Jean");
        $personne->setEmail("jeanvanneste@gmail.com");
        $personne->setKap("kotejeux");

        $form = $this->createFormBuilder($personne)
            ->add("nom", TextType::class, ['label' => 'Nom*'])
            ->add("prenom", TextType::class, ['required' => false])
            ->add("email", EmailType::class, ['required' => false])
            ->add("kap", TextType::class, ['required' => false])
            ->add('save', SubmitType::class, ["label" => "Enregistrer la personne"])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $personne = $form->getData();

            $entityManager->persist($personne);

            $entityManager->flush();

            return $this->redirectToRoute('confirmation', ['id' => $personne->getId(), 'entity' => 'personne']);
        }
        
        return $this->render("personne/new.html.twig", [
            'form' => $form->createView(),
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

        return $this->render('personne/details.html.twig', [
            "nom" => $personne->getNom(),
            "prenom" => $personne->getPrenom(),
            "kap" => $personne->getKap(),
        ]);
    }
}
