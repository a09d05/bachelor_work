<?php

namespace App\Controller;

use App\Entity\CheckRequirementsWork;
use App\Form\CheckRequirementsWorkType;
use App\Repository\CheckRequirementsWorkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/check_requirements_work')]
class CheckRequirementsWorkController extends AbstractController
{
    #[Route('/', name: 'app_check_requirements_work_index', methods: ['GET'])]
    public function index(CheckRequirementsWorkRepository $checkRequirementsWorkRepository): Response
    {
        return $this->render('check_requirements_work/index.html.twig', [
            'check_requirements_works' => $checkRequirementsWorkRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_check_requirements_work_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $checkRequirementsWork = new CheckRequirementsWork();
        $form = $this->createForm(CheckRequirementsWorkType::class, $checkRequirementsWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($checkRequirementsWork);
            $entityManager->flush();

            return $this->redirectToRoute('app_check_requirements_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('check_requirements_work/new.html.twig', [
            'check_requirements_work' => $checkRequirementsWork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_check_requirements_work_show', methods: ['GET'])]
    public function show(CheckRequirementsWork $checkRequirementsWork): Response
    {
        return $this->render('check_requirements_work/show.html.twig', [
            'check_requirements_work' => $checkRequirementsWork,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_check_requirements_work_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CheckRequirementsWork $checkRequirementsWork, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CheckRequirementsWorkType::class, $checkRequirementsWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_check_requirements_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('check_requirements_work/edit.html.twig', [
            'check_requirements_work' => $checkRequirementsWork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_check_requirements_work_delete', methods: ['POST'])]
    public function delete(Request $request, CheckRequirementsWork $checkRequirementsWork, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$checkRequirementsWork->getId(), $request->request->get('_token'))) {
            $entityManager->remove($checkRequirementsWork);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_check_requirements_work_index', [], Response::HTTP_SEE_OTHER);
    }
}
