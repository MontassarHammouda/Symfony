<?php

namespace App\Form;

use App\Entity\CompteRendue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Exercice;

class CompteRendueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('FileCompteRendue', FileType::class, [
                'mapped' => false
              ])
            ->add('url')
            ->add('etudiant', EntityType::class, [
                'class' => Etudiant::class,
             'choice_label' => 'Prenom'
         
              ])
              ->add('exercices', EntityType::class, [
                'class' => Exercice::class,
             'choice_label' => 'titre'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CompteRendue::class,
        ]);
    }
}
