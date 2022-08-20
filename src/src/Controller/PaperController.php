<?php

namespace App\Controller;

use App\Entity\Paper;
use App\Form\PaperType;
use App\Repository\PaperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/paper')]
class PaperController extends AbstractController
{
    #[Route('/', name: 'app_paper_index', methods: ['GET'])]
    public function index(PaperRepository $paperRepository): Response
    {
        return $this->render('paper/index.html.twig', [
            'papers' => $paperRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_paper_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PaperRepository $paperRepository): Response
    {
        $paper = new Paper();
        $form = $this->createForm(PaperType::class, $paper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paperRepository->add($paper, true);

            return $this->redirectToRoute('app_paper_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paper/new.html.twig', [
            'paper' => $paper,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paper_show', methods: ['GET'])]
    public function show(Paper $paper): Response
    {
        return $this->render('paper/show.html.twig', [
            'paper' => $paper,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_paper_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paper $paper, PaperRepository $paperRepository): Response
    {
        $form = $this->createForm(PaperType::class, $paper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paperRepository->add($paper, true);

            return $this->redirectToRoute('app_paper_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paper/edit.html.twig', [
            'paper' => $paper,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paper_delete', methods: ['POST'])]
    public function delete(Request $request, Paper $paper, PaperRepository $paperRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paper->getId(), $request->request->get('_token'))) {
            $paperRepository->remove($paper, true);
        }

        return $this->redirectToRoute('app_paper_index', [], Response::HTTP_SEE_OTHER);
    }
}
