<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;


class User2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', TextType::class,["label"=>'tapez votre nom ','required'=>true,'constraints'=>[
                new Length([
                    'min' => 3,
                    'max' => 15,
                    'exactMessage'=>'nom entre 3 et 15 caractères',
                ]),]])
            ->add('prenom', TextType::class,["label"=>'tapez votre prenom ','required'=>true,'constraints'=>[
                new Length([
                    'min' => 3,
                    'max' => 15,
                    'exactMessage'=>'prenom entre 3 et 15 caractères',
                ]),]])
            ->add('datenaissance', DateType::class)
            ->add('nationalite', ChoiceType::class,array('choices'=>array('Tunis'=>'Tunis',
                'Algerie'=>'Algerie',
                'Maroc'=>'Maroc',
                'France'=>'France',


            )))
            ->add('civil_status', ChoiceType::class,array('choices'=>array('Celibataire'=>'celibataire',
                'Marié(e)'=>'Marié',
                'Divorcé'=>'Divorcé(e)'

            )))

            ->add('numero_tel', TelType::class,["label"=>'tapez votre numéro de Téléphone : ','required'=>true, 'constraints'=>[
                new Length([
                    'min' => 8,
                    'max' => 8,
                    'exactMessage'=>'Le numéro de téléphone doit contenir exactement {{ limit }}  chiffres',
                ]),]])
            ->add('numero_whatsapp', TelType::class,["label"=>'tapez votre numéro de WhatsApp : ','required'=>true, 'constraints'=>[
                new Length([
                    'min' => 8,
                    'max' => 8,
                    'exactMessage'=>'Le numéro de téléphone doit contenir exactement {{ limit }}  chiffres',
                ]),]])
            ->add('lien_fbk', TextType::class)
            ->add('lien_youtube', TextType::class)
            ->add('lien_instagram', TextType::class)
            ->add('lien_twitter', TextType::class)
            ->add('lien_email', EmailType::class)
            ->add('bio', TextareaType::class)


            ->add('submit', SubmitType::class, ['label'=>'Envoyer', 'attr'=>['class'=>'btn-primary btn-block']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
