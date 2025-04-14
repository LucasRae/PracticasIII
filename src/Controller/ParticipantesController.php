<?php

namespace App\Controller;

use App\Entity\Participantes;
use App\Form\ParticipantesType;
use App\Repository\ParticipantesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participantes')]
class ParticipantesController extends AbstractController
{
    #[Route('/', name: 'app_participantes_index', methods: ['GET'])]
    public function index(ParticipantesRepository $participantesRepository): Response
    {
        return $this->render('participantes/index.html.twig', [
            'participantes' => $participantesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_participantes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $participante = new Participantes();
        $form = $this->createForm(ParticipantesType::class, $participante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($participante);
            $entityManager->flush();

            return $this->redirectToRoute('app_participantes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participantes/new.html.twig', [
            'participante' => $participante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participantes_show', methods: ['GET'])]
    public function show(Participantes $participante): Response
    {
        return $this->render('participantes/show.html.twig', [
            'participante' => $participante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_participantes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participantes $participante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipantesType::class, $participante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participantes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participantes/edit.html.twig', [
            'participante' => $participante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participantes_delete', methods: ['POST'])]
    public function delete(Request $request, Participantes $participante, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participante->getId(), $request->request->get('_token'))) {
            $entityManager->remove($participante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_participantes_index', [], Response::HTTP_SEE_OTHER);
    }
}
