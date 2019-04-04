<?php

namespace App\Controller;

use App\Entity\Line;
use App\Form\LineType;
use App\Repository\LineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/line")
 */
class LineController extends AbstractController
{
    /**
     * @Route("/", name="line_index", defaults={"page": "1"}, methods={"GET"})
     * @Route("/page/{page<[1-9]\d*>}", methods={"GET"}, name="line_index_paginated")
     *
     * @param int            $page
     * @param LineRepository $lineRepository
     *
     * @return Response
     */
    public function index(int $page, LineRepository $lineRepository): Response
    {
        return $this->render('line/index.html.twig', [
            'lines' => $lineRepository->selectAll($page),
        ]);
    }

    /**
     * @Route("/new", name="line_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $line = new Line();
        $form = $this->createForm(LineType::class, $line);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($line);
            $entityManager->flush();

            return $this->redirectToRoute('line_index');
        }

        return $this->render('line/new.html.twig', [
            'line' => $line,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{extId}", name="line_show", methods={"GET"})
     */
    public function show(Line $line): Response
    {
        return $this->render('line/show.html.twig', [
            'line' => $line,
        ]);
    }

    /**
     * @Route("/{extId}/edit", name="line_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Line $line): Response
    {
        $form = $this->createForm(LineType::class, $line);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('line_index', [
                'extId' => $line->getExtId(),
            ]);
        }

        return $this->render('line/edit.html.twig', [
            'line' => $line,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{extId}", name="line_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Line $line): Response
    {
        if ($this->isCsrfTokenValid('delete'.$line->getExtId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($line);
            $entityManager->flush();
        }

        return $this->redirectToRoute('line_index');
    }
}
