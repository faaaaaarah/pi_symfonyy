<?php

namespace App\Controller;

use App\Entity\Bornes;
use App\Form\BornesType;
use App\Repository\BornesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bornes')]
class BornesController extends AbstractController
{
    #[Route('/', name: 'app_bornes_index', methods: ['GET'])]
    public function index(BornesRepository $borneRepository): Response
    {
        return $this->render('bornes/index.html.twig', [
            'bornes' => $borneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bornes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $borne = new Bornes();
        $form = $this->createForm(BornesType::class, $borne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $file = $form['filePath']->getData();
            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('uploads_directory'), // Get the path to the uploads directory
                    $fileName
                );
                $borne->setFilePath($fileName);
            }

            $entityManager->persist($borne);
            $entityManager->flush();

            return $this->redirectToRoute('app_bornes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bornes/new.html.twig', [
            'borne' => $borne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bornes_show', methods: ['GET'])]
    public function show(Bornes $borne): Response
    {
        return $this->render('bornes/show.html.twig', [
            'borne' => $borne,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bornes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bornes $borne, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BornesType::class, $borne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $file = $form['filePath']->getData();
            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('uploads_directory'), // Get the path to the uploads directory
                    $fileName
                );
                $borne->setFilePath($fileName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_bornes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bornes/edit.html.twig', [
            'borne' => $borne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bornes_delete', methods: ['POST'])]
    public function delete(Request $request, Bornes $borne, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$borne->getId(), $request->request->get('_token'))) {
            $entityManager->remove($borne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bornes_index', [], Response::HTTP_SEE_OTHER);
    }
}
