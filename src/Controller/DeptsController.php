<?php

namespace App\Controller;

use App\Entity\Depts;
use App\Form\DeptsType;
use App\Repository\DeptsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/depts')]
class DeptsController extends AbstractController
{
    #[Route('/', name: 'app_depts_index', methods: ['GET'])]
    public function index(DeptsRepository $deptsRepository): Response
    {
        return $this->render('depts/index.html.twig', [
            'depts' => $deptsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_depts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dept = new Depts();
        $form = $this->createForm(DeptsType::class, $dept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dept);
            $entityManager->flush();

            return $this->redirectToRoute('app_depts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depts/new.html.twig', [
            'dept' => $dept,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depts_show', methods: ['GET'])]
    public function show(Depts $dept): Response
    {
        return $this->render('depts/show.html.twig', [
            'dept' => $dept,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_depts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Depts $dept, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeptsType::class, $dept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_depts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depts/edit.html.twig', [
            'dept' => $dept,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depts_delete', methods: ['POST'])]
    public function delete(Request $request, Depts $dept, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dept->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dept);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_depts_index', [], Response::HTTP_SEE_OTHER);
    }
}
