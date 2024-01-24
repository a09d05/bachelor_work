<?php

namespace App\Controller;

use App\Entity\ExamResults;
use App\Form\ExamResultsType;
use App\Repository\ExamResultsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exam_results')]
class ExamResultsController extends AbstractController
{
    #[Route('/', name: 'app_exam_results_index', methods: ['GET'])]
    public function index(ExamResultsRepository $examResultsRepository): Response
    {
        return $this->render('exam_results/index.html.twig', [
            'exam_results' => $examResultsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_exam_results_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $examResult = new ExamResults();
        $form = $this->createForm(ExamResultsType::class, $examResult);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($examResult);
            $entityManager->flush();

            return $this->redirectToRoute('app_exam_results_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exam_results/new.html.twig', [
            'exam_result' => $examResult,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exam_results_show', methods: ['GET'])]
    public function show(ExamResults $examResult): Response
    {
        return $this->render('exam_results/show.html.twig', [
            'exam_result' => $examResult,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_exam_results_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ExamResults $examResult, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExamResultsType::class, $examResult);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_exam_results_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exam_results/edit.html.twig', [
            'exam_result' => $examResult,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exam_results_delete', methods: ['POST'])]
    public function delete(Request $request, ExamResults $examResult, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$examResult->getId(), $request->request->get('_token'))) {
            $entityManager->remove($examResult);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_exam_results_index', [], Response::HTTP_SEE_OTHER);
    }
}
