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
            ->add('titre', TextType::class)
            ->add('description', TextType::class)
            ->add('joueurs_min', IntegerType::class)
            ->add('joueurs_max', IntegerType::class)
            ->add('duree', IntegerType::class)
            ->add('annee', IntegerType::class)
            ->add('editeur', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'name',
            ])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => "genre",
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('auteur', EntityType::class, [
                'class' => Auteur::class,
                'choice_label' => "getCompleteName",
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
        ]);
    }
}
