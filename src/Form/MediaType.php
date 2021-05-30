<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,['label'=>'Entrez le titre de votre video'])
            ->add('description',TextType::class,['label'=>'Decrire votre video' ])
            ->add('lien',TextType::class,['label'=>'Entrez le lien de votre video sur YouTube' ])
            ->add('image',FileType::class,['label'=>'Charger votre video' ])

//            ->add('directeur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
