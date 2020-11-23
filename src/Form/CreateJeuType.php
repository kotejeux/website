<?php

namespace App\Form;

use App\Entity\Jeu;
use App\Entity\Editeur;
use App\Entity\Genre;
use App\Entity\Auteur;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateJeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                "label" => "Nom du jeu *"
            ])
            ->add('description', TextType::class, [
                "required" => false,
            ])
            ->add('joueurs_min', IntegerType::class, [
                "label" => "Nombre de joueurs minimum *",
            ])
            ->add('joueurs_max', IntegerType::class, [
                "label" => "Nombre de joueurs maximum *",
            ])
            ->add('duree', IntegerType::class, [
                "label" => "Durée en minute *",
            ])
            ->add('annee', IntegerType::class, [
                "label" => "Année de sortie",
                "required" => false,
            ])
            /*
            ->add('editeur', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => "genre",
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('auteur', EntityType::class, [
                'class' => Auteur::class,
                'choice_label' => "getCompleteName",
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            */
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
        ]);
    }
}
