<?php

namespace App\Controller;

use App\Entity\Exams;
use App\Form\ExamsType;
use App\Repository\ExamsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exams')]
class ExamsController extends AbstractController
{
    #[Route('/', name: 'app_exams_index', methods: ['GET'])]
    public function index(ExamsRepository $examsRepository): Response
    {
        return $this->render('exams/index.html.twig', [
            'exams' => $examsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_exams_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exam = new Exams();
        $form = $this->createForm(ExamsType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($exam);
            $entityManager->flush();

            return $this->redirectToRoute('app_exams_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exams/new.html.twig', [
            'exam' => $exam,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exams_show', methods: ['GET'])]
    public function show(Exams $exam): Response
    {
        return $this->render('exams/show.html.twig', [
            'exam' => $exam,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_exams_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exams $exam, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExamsType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_exams_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exams/edit.html.twig', [
            'exam' => $exam,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exams_delete', methods: ['POST'])]
    public function delete(Request $request, Exams $exam, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exam->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exam);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_exams_index', [], Response::HTTP_SEE_OTHER);
    }
}
