<?php

namespace App\Form;

use App\Entity\Jeu;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $today = new \DateTimeImmutable();
        $builder
            ->add('jeu', EntityType::class, [
                'class' => Jeu::class,
                'choice_label' => "titre",
            ])
            ->add('date_debut', DateType::class, [
                'widget' => 'single_text',
                'data' => $today,
            ])
            ->add('date_fin', DateType::class, [
                'widget' => 'single_text',
                'data' => date_add(new \DateTime, (new \DateInterval("P7D"))),
            ])
            ->add('paye', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
            ->add('nom', TextType::class)
            ->add('mail', TextType::class, [
                'required' => false,
            ])
            ->add('phone', TextType::class, [
                'required' => false,
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
