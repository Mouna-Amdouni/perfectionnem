<?php

namespace App\Controller;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\Actualite;

use App\Repository\ActualiteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;

use App\Form\StaffManagementType;
class ActualiteController extends AbstractController
{
    /**
     * @Route("/actualite", name="actualite")
     */
    public function index()
    {
        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
        ]);
    }


     /**
     * @Route("/act/{idDirecteur}",name="creer_act")
     */
    public function creerAct (SluggerInterface $slugger,$idDirecteur,Request $requete,UserRepository $DirecteurRepository, EntityManagerInterface $manager){
           $act=new Actualite();
            $act->setCreatedAt(new \DateTime('now'))  ;
        $directeur=$DirecteurRepository->find($idDirecteur);
//        dd($directeur);
         $form=$this->createFormBuilder($act)
              
                  ->add('nom', 
                    TextType::class, [
                    'required' => true,
                    'label' => "Entrez le titre d'actualité",
                    'attr' => ['class' => 'form-control']
                ])
             ->add('image',FileType::class,['label'=>'Charger votre image' ])
             ->add('sujet', TextareaType::class, [
                 'attr' => [
                     'class' => 'form-control',
                     'rows' => "2",
                     'cols' => "45"
                 ],
                 'label' => "Entrez votre sujet"
             ])
                  ->add('description', TextareaType::class, [
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => "9", 
                        'cols' => "45"
                    ],
                    'label' => "Decrivez votre sujet"
                ])


                ->add('Valider', SubmitType::class, [
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ]
                ])
                
            ->getForm();
        $form->handleRequest($requete);
        if($form->isSubmitted() && $form->isValid()) {
            $file=$act->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
                $act->setUser($directeur);
            $act->setImage($fileName);
                $manager->persist($act);
                $manager->flush();
                $this->addFlash('success', 'Actualité  bien été enregistrée.');
                return $this->redirectToRoute('acts');



        }
        
        return $this->render("actualite/index.html.twig", ['formAct'=>$form->createView(),

            'idDirecteur'=>$idDirecteur,
            ]);
        
        
    }
    /**
   * @Route("/acts",name="acts")
     */
public function actualites(){
    $rep=$this->getDoctrine()->getRepository(Actualite::class);
    $acts=$rep->findAll();
    return $this->render('actualite/actualites.html.twig',['acts'=>$acts]);
    
    
    }


    /**
 * @Route("/delete/{id}",name="delete")

 */
public function deleteact($id){
    $entityManager=$this->getDoctrine()->getManager();
    $act=$entityManager->getRepository(Actualite::class)->find($id);
    $entityManager->remove($act);
    $entityManager->flush();
    return $this->redirectToRoute('acts');

}
 /**
 * @Route("/detailact/{id}",name="detailact")

 */
public function detailact($id){
    $rep=$this->getDoctrine()->getRepository(Actualite::class);
    $act=$rep->find($id);
    return $this->render('actualite/detailact.html.twig',['act'=>$act]);
    
    
  

}
/**
 * @Route("/editer/{id}",name="editer")
 */
public function editer(Actualite $act=null,Request $requete,EntityManagerInterface $manager){
    if(!$act){
        $act =new Actualite();
    }
        $form=$this->createFormBuilder($act)
        ->add('nom', 
        TextType::class, [
        'required' => true,
        'label' => "entrer le sujet d'actualité",
        'attr' => ['class' => 'form-control']
    ])

      ->add('description', TextareaType::class, [
        'attr' => [
            'class' => 'form-control',
            'rows' => "9", 
            'cols' => "45"
        ],
        'label' => "Decrivez votre sujet"
    ])
            ->add('Enregistrer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        $form->handleRequest($requete);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($act);
            $manager->flush();

            $this->addFlash('success', 'Actualité  bien été modifiée.');
            return $this->redirectToRoute('acts');
        }
//        return $this->redirectToRoute("acts", ['formAct'=>$form->createView()]);
    return $this->render("actualite/index.html.twig", ['formAct'=>$form->createView()
    ]);
    }


    /**
     * @Route("/actsUser", name="actsUser", methods={"GET"})
     */
    public function indexV(ActualiteRepository $actualiteRepository): Response
    {
        return $this->render('actualite/actualitesUsers.html.twig', [
            'acts' =>$actualiteRepository->findAll(),
        ]);
    }
  } 


  