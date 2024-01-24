<?php

namespace App\Controller;

use App\Entity\PlannedTrainings;
use App\Form\PlannedTrainingsType;
use App\Repository\PlannedTrainingsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/planned_trainings')]
class PlannedTrainingsController extends AbstractController
{
    #[Route('/', name: 'app_planned_trainings_index', methods: ['GET'])]
    public function index(PlannedTrainingsRepository $plannedTrainingsRepository): Response
    {
        return $this->render('planned_trainings/index.html.twig', [
            'planned_trainings' => $plannedTrainingsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_planned_trainings_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plannedTraining = new PlannedTrainings();
        $form = $this->createForm(PlannedTrainingsType::class, $plannedTraining);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plannedTraining);
            $entityManager->flush();

            return $this->redirectToRoute('app_planned_trainings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planned_trainings/new.html.twig', [
            'planned_training' => $plannedTraining,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planned_trainings_show', methods: ['GET'])]
    public function show(PlannedTrainings $plannedTraining): Response
    {
        return $this->render('planned_trainings/show.html.twig', [
            'planned_training' => $plannedTraining,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_planned_trainings_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlannedTrainings $plannedTraining, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlannedTrainingsType::class, $plannedTraining);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_planned_trainings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planned_trainings/edit.html.twig', [
            'planned_training' => $plannedTraining,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planned_trainings_delete', methods: ['POST'])]
    public function delete(Request $request, PlannedTrainings $plannedTraining, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plannedTraining->getId(), $request->request->get('_token'))) {
            $entityManager->remove($plannedTraining);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_planned_trainings_index', [], Response::HTTP_SEE_OTHER);
    }
}
