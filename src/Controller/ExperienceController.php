<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/experience")
 */
class ExperienceController extends AbstractController
{
    /**
     * @Route("/", name="experience_index", methods={"GET"})
     */
    public function index(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('experience/index.html.twig', [
            'experiences' => $experienceRepository->findAll(),
        ]);
    }



    /**
     * @Route("/experienceUtilisateur", name="experience_indexV", methods={"GET"})
     */
    public function indexV(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('experience/indexUtilisateur.html.twig', [
            'experiences' => $experienceRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new/{idDirecteur}", name="experience_new", methods={"GET","POST"})
     */
    public function new(Request $request,$idDirecteur,UserRepository $DirecteurRepository): Response
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        $directeur=$DirecteurRepository->find($idDirecteur);
//        dd($directeur);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $experience->setUser($directeur);
            $entityManager->persist($experience);
            $entityManager->flush();
            $this->addFlash('success', 'Experience  bien été enregistré.');

            return $this->redirectToRoute('experience_index');
        }

        return $this->render('experience/new.html.twig', [
            'experience' => $experience,
            'idDirecteur'=>$idDirecteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="experience_show", methods={"GET"})
     */
    public function show(Experience $experience): Response
    {
        return $this->render('experience/show.html.twig', [
            'experience' => $experience,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="experience_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Experience $experience): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('experience_index');
        }

        return $this->render('experience/edit.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="experience_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Experience $experience): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experience->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($experience);
            $entityManager->flush();
        }

        return $this->redirectToRoute('experience_index');
    }
}
