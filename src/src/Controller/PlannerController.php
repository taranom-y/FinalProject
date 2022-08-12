<?php

namespace App\Controller;

use App\Entity\Planner;
use App\Form\PlannerType;
use App\Repository\PlannerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/planner')]
class PlannerController extends AbstractController
{
    #[Route('/', name: 'app_planner_index', methods: ['GET'])]
    public function index(PlannerRepository $plannerRepository): Response
    {
        return $this->render('planner/index.html.twig', [
            'planners' => $plannerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_planner_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlannerRepository $plannerRepository): Response
    {
        $planner = new Planner();
        $form = $this->createForm(PlannerType::class, $planner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plannerRepository->add($planner, true);

            return $this->redirectToRoute('app_planner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planner/new.html.twig', [
            'planner' => $planner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planner_show', methods: ['GET'])]
    public function show(Planner $planner): Response
    {
        return $this->render('planner/show.html.twig', [
            'planner' => $planner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_planner_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Planner $planner, PlannerRepository $plannerRepository): Response
    {
        $form = $this->createForm(PlannerType::class, $planner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plannerRepository->add($planner, true);

            return $this->redirectToRoute('app_planner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planner/edit.html.twig', [
            'planner' => $planner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planner_delete', methods: ['POST'])]
    public function delete(Request $request, Planner $planner, PlannerRepository $plannerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planner->getId(), $request->request->get('_token'))) {
            $plannerRepository->remove($planner, true);
        }

        return $this->redirectToRoute('app_planner_index', [], Response::HTTP_SEE_OTHER);
    }
}
