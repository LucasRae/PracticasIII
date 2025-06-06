<?php

namespace App\Controller;

use App\Entity\Obra;
use App\Form\ObraType;
use App\Repository\ObraRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/obra')]
class ObraController extends AbstractController
{
    #[Route('/', name: 'app_obra_index', methods: ['GET'])]
    public function index(ObraRepository $obraRepository): Response
    {
        return $this->render('obra/index.html.twig', [
            'obras' => $obraRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_obra_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $obra = new Obra();
        $form = $this->createForm(ObraType::class, $obra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($obra);
            $entityManager->flush();

            return $this->redirectToRoute('app_obra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('obra/new.html.twig', [
            'obra' => $obra,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_obra_show', methods: ['GET'])]
    public function show(Obra $obra): Response
    {
        return $this->render('obra/show.html.twig', [
            'obra' => $obra,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_obra_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Obra $obra, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ObraType::class, $obra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_obra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('obra/edit.html.twig', [
            'obra' => $obra,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_obra_delete', methods: ['POST'])]
    public function delete(Request $request, Obra $obra, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$obra->getId(), $request->request->get('_token'))) {
            $entityManager->remove($obra);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_obra_index', [], Response::HTTP_SEE_OTHER);
    }
}
