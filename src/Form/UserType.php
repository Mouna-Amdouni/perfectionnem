<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', TextType::class,["label"=>'tapez votre nom ','required'=>true,'constraints'=>[
                new Length([
                    'min' => 3,
                    'max' => 15,
                    'exactMessage'=>'votre nom doit etre  entre 3 et 15 caractères',
                ]),]])
            ->add('prenom', TextType::class,["label"=>'tapez votre prenom ','required'=>true,'constraints'=>[
                new Length([
                    'min' => 3,
                    'max' => 15,
                    'exactMessage'=>'prenom entre 3 et 15 caractères',
                ]),]])
            ->add('datenaissance', DateType::class,["label"=>'tapez la date de naissance'])
            ->add('nationalite', ChoiceType::class,array('choices'=>array('Tunis'=>'Tunis',
                'Algerie'=>'Algerie',
                'Maroc'=>'Maroc',
                'France'=>'France',


            )))
            ->add('civil_status', ChoiceType::class,array('choices'=>array('Celibataire'=>'celibataire',
                'Marié(e)'=>'Marié',
                'Divorcé'=>'Divorcé(e)'

                )))
            ->add('email', EmailType::class,["label"=>"tapez votre adresse e-mail",'required'=>true,'constraints'=>[
                new Email(['mode' => 'strict']),
            ]])
//            ->add('plainPassword', RepeatedType::class, array(
//                'type' => PasswordType::class,
//                'first_options' => array('label' => 'Mot de passe'),
//                'second_options' => array('label' => 'Confirmation du mot de passe'),
//            ))
                        ->add('plainPassword', RepeatedType::class,[
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation du mot de passe'),
                'constraints' => [
                    new NotBlank([
                        'message' => 's\'il vous plait tapez un mot de passe' ,
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ]
            ])
//            ->add('plainPassword', RepeatedType::class, [
//                'type' => PasswordType::class,
//                'invalid_message' => 'Les champs de mot de passe doivent correspondre',
//                'options' => ['attr' => ['class' => 'password-field','style'=> 'padding :20px']],
//                'required' => true,
//                'first_options' => ['label' => 'tapez votre mot de passe : '],
//                'second_options' => ['label' => 'Confirmer votre mot de passe : '],
//                // instead of being set onto the object directly,
//                // this is read and encoded in the controller
//                'mapped' => false,
//                'constraints' => [
//                    new NotBlank([
//                        'message' => 's\'il vous plait tapez un mot de passe' ,
//                    ]),
//                    new Length([
//                        'min' => 6,
//                        'minMessage' => 'Your password should be at least {{ limit }} characters',
//                        // max length allowed by Symfony for security reasons
//                        'max' => 4096,
//                    ]),
//                ],
//            ])

//            ->add('numero_tel', TelType::class)
//            ->add('numero_whatsapp', TelType::class)
//            ->add('lien_fbk', TextType::class)
//            ->add('lien_youtube', TextType::class)
//            ->add('lien_instagram', TextType::class)
//            ->add('lien_twitter', TextType::class)
//            ->add('lien_email', EmailType::class)



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
