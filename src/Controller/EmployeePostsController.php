<?php

namespace App\Controller;

use App\Entity\EmployeePosts;
use App\Form\EmployeePostsType;
use App\Repository\EmployeePostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employee_posts')]
class EmployeePostsController extends AbstractController
{
    #[Route('/', name: 'app_employee_posts_index', methods: ['GET'])]
    public function index(EmployeePostsRepository $employeePostsRepository): Response
    {
        return $this->render('employee_posts/index.html.twig', [
            'employee_posts' => $employeePostsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employee_posts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employeePost = new EmployeePosts();
        $form = $this->createForm(EmployeePostsType::class, $employeePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employeePost);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee_posts/new.html.twig', [
            'employee_post' => $employeePost,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_posts_show', methods: ['GET'])]
    public function show(EmployeePosts $employeePost): Response
    {
        return $this->render('employee_posts/show.html.twig', [
            'employee_post' => $employeePost,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_posts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EmployeePosts $employeePost, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmployeePostsType::class, $employeePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee_posts/edit.html.twig', [
            'employee_post' => $employeePost,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_posts_delete', methods: ['POST'])]
    public function delete(Request $request, EmployeePosts $employeePost, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employeePost->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employeePost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_posts_index', [], Response::HTTP_SEE_OTHER);
    }
}
