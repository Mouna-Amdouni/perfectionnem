<?php

namespace App\Form;

use App\Entity\Service;

use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Date;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',\Symfony\Component\Form\Extension\Core\Type\TextType::class,['label'=>'Entrez le libelle du service'])
            ->add('description',TextareaType::class,['label'=>'Decrire votre service'])
            ->add('datedeb',DateType::class,['label'=>'Entrez la date de debut de votre experience de ce service '])
            ->add('datefin',DateType::class,['label'=>'Entrez la date de fin de votre experience de ce service '])
            ->add('technologie',\Symfony\Component\Form\Extension\Core\Type\TextType::class,['label'=>'Tapez la technologie utilisé pour ce service  '])
            ->add('familleService')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
