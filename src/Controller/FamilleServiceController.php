<?php

namespace App\Controller;

use App\Entity\FamilleService;
use App\Form\FamilleServiceType;
use App\Repository\FamilleServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/famille/service")
 */
class FamilleServiceController extends AbstractController
{
    /**
     * @Route("/", name="famille_service_index", methods={"GET"})
     */
    public function index(FamilleServiceRepository $familleServiceRepository): Response
    {
        return $this->render('famille_service/index.html.twig', [
            'famille_services' => $familleServiceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="famille_service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $familleService = new FamilleService();
        $form = $this->createForm(FamilleServiceType::class, $familleService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($familleService);
            $entityManager->flush();

            return $this->redirectToRoute('famille_service_index');
        }

        return $this->render('famille_service/new.html.twig', [
            'famille_service' => $familleService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="famille_service_show", methods={"GET"})
     */
    public function show(FamilleService $familleService): Response
    {
        return $this->render('famille_service/show.html.twig', [
            'famille_service' => $familleService,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="famille_service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FamilleService $familleService): Response
    {
        $form = $this->createForm(FamilleServiceType::class, $familleService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('famille_service_index');
        }

        return $this->render('famille_service/edit.html.twig', [
            'famille_service' => $familleService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="famille_service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FamilleService $familleService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$familleService->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($familleService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('famille_service_index');
    }
}
