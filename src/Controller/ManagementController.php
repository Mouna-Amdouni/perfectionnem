<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;

use App\Form\StaffManagementType;

class ManagementController extends AbstractController
{
    /**
     * @Route("/management", name="management")
     */
    public function management()
    {
        if($this->getUser() && $this->isGranted('ROLE_DIRECTEUR')) {
            return $this->render('management/index.html.twig');
        }   
        else {
            return $this->redirectToRoute('acc');
        }
    }

    /**
     * @Route("/management/staff", name="staff_management")
     * @param Request $request
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function staffManagement(Request $request, UserRepository $userRepository, EntityManagerInterface $manager)
    {
        $form = $this->createForm(StaffManagementType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
         
            if ($form->get('moins')->isClicked()){
                if($form->get('user')->getData()->getRoles() == ["ROLE_VISITEUR","ROLE_DIRECTEUR","ROLE_ADMIN"]) {
                    $callback = 'ERREUR: ADMIN ne peut pas modifier sa  positiondans le site';
                }
                else if($form->get('user')->getData()->getRoles() == ["ROLE_VISITEUR"]) {
                    $callback = 'ERROR : '.$form->get('user')->getData()->getNom().' est déjà un visiteur';
                }
                else {
                    $form->get('user')->getData()->setRoles(['ROLE_VISITEUR']);
                    $manager->flush();
                    $callback = $form->get('user')->getData()->getNom(). ' is demoted';
                }
            }
            

            else if($form->get('plus')->isClicked()) {
                if($form->get('user')->getData()->getRoles() == ["ROLE_VISITEUR","ROLE_DIRECTEUR","ROLE_ADMIN"]) {
                    $callback = 'ERREUR: ADMIN ne peut pas modifier sa  position dans le site';
                }
                else if($form->get('user')->getData()->getRoles() == ["ROLE_DIRECTEUR","ROLE_VISITEUR"]) {
                    $callback = 'ERREUR : '.$form->get('user')->getData()->getNom().' est déjà un directeur ';
                }
                else {
                    $form->get('user')->getData()->setRoles(['ROLE_DIRECTEUR','ROLE_VISITEUR']);
                    $manager->flush();
                    $callback = $form->get('user')->getData()->getNom(). ' est devenu directeur';
                }
            }
           

            
            
            $users = $userRepository->getFullUserByRole('"ROLE_VISITEUR"');

            
            return $this->render('management/staffManagement.html.twig', [
                
                'users' => $users,
                'form'  => $form->createView(),
                'results' => $callback
            ]);
        }
        else {
            
            $staff = $userRepository->getFullUserByRole('"ROLE_DIRECTEUR"');
            $users = $userRepository->getFullUserByRole('"ROLE_VISITEUR"');

            return $this->render('management/staffManagement.html.twig', [
                'staff' => $staff,
                'users' => $users,
                'form'  => $form->createView()
            ]);
        }
    }
}
