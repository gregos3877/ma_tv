<?php

namespace App\Form;

use App\Entity\Chaine;
use App\Entity\Plateform;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChaineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plateform', EntityType::class, [
                'class' => Plateform::class,
                'choice_label'  => 'nomPlateform',
            ])
            ->add('nomChaine')
//            ->add('lienChaine')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chaine::class,
        ]);
    }
}
