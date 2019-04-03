<?php

namespace App\Controller;

use App\Entity\Canal;
use App\Form\CanalType;
use App\Repository\CanalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/canal")
 */
class CanalController extends AbstractController
{
    /**
     * @Route("/", name="canal", defaults={"page": "1"}, methods={"GET"})
     * @Route("/page/{page<[1-9]\d*>}", methods={"GET"}, name="canal_index_paginated")
     *
     * @param int             $page
     * @param CanalRepository $canalRepository
     *
     * @return Response
     */
    public function index(int $page, CanalRepository $canalRepository): Response
    {
        return $this->render(
            'canal/index.html.twig',
            [
                'canals' => $canalRepository->selectAll($page),
            ]
        );
    }

    /**
     * @Route("/new", name="canal_new", methods={"GET","POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $canal = new Canal();
        $form = $this->createForm(CanalType::class, $canal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($canal);
            $entityManager->flush();

            return $this->redirectToRoute('canal');
        }

        return $this->render(
            'canal/new.html.twig',
            [
                'canal' => $canal,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{extId}", name="canal_show", methods={"GET"})
     *
     * @param Canal $canal
     *
     * @return Response
     */
    public function show(Canal $canal): Response
    {
        return $this->render(
            'canal/show.html.twig',
            [
                'canal' => $canal,
            ]
        );
    }

    /**
     * @Route("/{extId}/edit", name="canal_edit", methods={"GET","POST"})
     *
     * @param Request $request
     * @param Canal   $canal
     *
     * @return Response
     */
    public function edit(Request $request, Canal $canal): Response
    {
        $form = $this->createForm(CanalType::class, $canal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(
                'canal',
                [
                    'extId' => $canal->getExtId(),
                ]
            );
        }

        return $this->render(
            'canal/edit.html.twig',
            [
                'canal' => $canal,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{extId}", name="canal_delete", methods={"DELETE"})
     *
     * @param Request $request
     * @param Canal   $canal
     *
     * @return Response
     */
    public function delete(Request $request, Canal $canal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$canal->getExtId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($canal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('canal');
    }
}
