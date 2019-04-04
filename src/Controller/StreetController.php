<?php

namespace App\Controller;

use App\Entity\Street;
use App\Form\StreetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/street")
 */
class StreetController extends AbstractController
{
    /**
     * @Route("/", name="street", methods={"GET"})
     */
    public function index(): Response
    {
        $streets = $this->getDoctrine()
            ->getRepository(Street::class)
            ->findAll();

        return $this->render('street/index.html.twig', [
            'streets' => $streets,
        ]);
    }

    /**
     * @Route("/new", name="street_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $street = new Street();
        $form = $this->createForm(StreetType::class, $street);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($street);
            $entityManager->flush();

            return $this->redirectToRoute('street');
        }

        return $this->render('street/new.html.twig', [
            'street' => $street,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="street_show", methods={"GET"})
     */
    public function show(Street $street): Response
    {
        return $this->render('street/show.html.twig', [
            'street' => $street,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="street_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Street $street): Response
    {
        $form = $this->createForm(StreetType::class, $street);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('street', [
                'id' => $street->getId(),
            ]);
        }

        return $this->render('street/edit.html.twig', [
            'street' => $street,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="street_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Street $street): Response
    {
        if ($this->isCsrfTokenValid('delete'.$street->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($street);
            $entityManager->flush();
        }

        return $this->redirectToRoute('street');
    }
}
