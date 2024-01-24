<?php

namespace App\Controller;

use App\Entity\ViolationsRulesSafe;
use App\Form\ViolationsRulesSafeType;
use App\Repository\ViolationsRulesSafeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/violations_rules_safe')]
class ViolationsRulesSafeController extends AbstractController
{
    #[Route('/', name: 'app_violations_rules_safe_index', methods: ['GET'])]
    public function index(ViolationsRulesSafeRepository $violationsRulesSafeRepository): Response
    {
        return $this->render('violations_rules_safe/index.html.twig', [
            'violations_rules_saves' => $violationsRulesSafeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_violations_rules_safe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $violationsRulesSafe = new ViolationsRulesSafe();
        $form = $this->createForm(ViolationsRulesSafeType::class, $violationsRulesSafe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($violationsRulesSafe);
            $entityManager->flush();

            return $this->redirectToRoute('app_violations_rules_safe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('violations_rules_safe/new.html.twig', [
            'violations_rules_safe' => $violationsRulesSafe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_violations_rules_safe_show', methods: ['GET'])]
    public function show(ViolationsRulesSafe $violationsRulesSafe): Response
    {
        return $this->render('violations_rules_safe/show.html.twig', [
            'violations_rules_safe' => $violationsRulesSafe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_violations_rules_safe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ViolationsRulesSafe $violationsRulesSafe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ViolationsRulesSafeType::class, $violationsRulesSafe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_violations_rules_safe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('violations_rules_safe/edit.html.twig', [
            'violations_rules_safe' => $violationsRulesSafe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_violations_rules_safe_delete', methods: ['POST'])]
    public function delete(Request $request, ViolationsRulesSafe $violationsRulesSafe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$violationsRulesSafe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($violationsRulesSafe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_violations_rules_safe_index', [], Response::HTTP_SEE_OTHER);
    }
}
