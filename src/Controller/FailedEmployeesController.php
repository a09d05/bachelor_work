<?php

namespace App\Controller;

use App\Entity\FailedEmployees;
use App\Form\FailedEmployeesType;
use App\Repository\FailedEmployeesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/failed_employees')]
class FailedEmployeesController extends AbstractController
{
    #[Route('/', name: 'app_failed_employees_index', methods: ['GET'])]
    public function index(FailedEmployeesRepository $failedEmployeesRepository): Response
    {
        return $this->render('failed_employees/index.html.twig', [
            'failed_employees' => $failedEmployeesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_failed_employees_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $failedEmployee = new FailedEmployees();
        $form = $this->createForm(FailedEmployeesType::class, $failedEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($failedEmployee);
            $entityManager->flush();

            return $this->redirectToRoute('app_failed_employees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('failed_employees/new.html.twig', [
            'failed_employee' => $failedEmployee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_failed_employees_show', methods: ['GET'])]
    public function show(FailedEmployees $failedEmployee): Response
    {
        return $this->render('failed_employees/show.html.twig', [
            'failed_employee' => $failedEmployee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_failed_employees_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FailedEmployees $failedEmployee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FailedEmployeesType::class, $failedEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_failed_employees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('failed_employees/edit.html.twig', [
            'failed_employee' => $failedEmployee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_failed_employees_delete', methods: ['POST'])]
    public function delete(Request $request, FailedEmployees $failedEmployee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$failedEmployee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($failedEmployee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_failed_employees_index', [], Response::HTTP_SEE_OTHER);
    }
}
