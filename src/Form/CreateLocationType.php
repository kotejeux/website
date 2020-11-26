<?php

namespace App\Form;

use App\Entity\Jeu;
use App\Entity\Location;
use Doctrine\ORM\EntityRepository;
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
        $this->jeu_default = $options['jeu_default'];
        $builder
            ->add('jeu', EntityType::class, [
                'class' => Jeu::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')->orderBy('u.titre', 'ASC');
                },
                'choice_label' => 'titre',
                'data' => $this->jeu_default,
            ])
            ->add('date_debut', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTimeImmutable(),
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
                'expanded' => true,
                'label' => 'Payé ?',
            ])
            ->add('nom', TextType::class, [
                "label" => 'Nom * '
            ])
            ->add('mail', TextType::class, [
                'required' => false,
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => "GSM "
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
            'jeu_default' => null,
        ]);
    }
}
