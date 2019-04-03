<?php

namespace App\Controller;

use App\Entity\EquipmentType;
use App\Form\EquipmentTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipment_type")
 */
class EquipmentTypeController extends AbstractController
{
    /**
     * @Route("/", name="equipment_type_index", methods={"GET"})
     */
    public function index(): Response
    {
        $equipmentTypes = $this->getDoctrine()
            ->getRepository(EquipmentType::class)
            ->findAll();

        return $this->render('equipment_type/index.html.twig', [
            'equipment_types' => $equipmentTypes,
        ]);
    }

    /**
     * @Route("/new", name="equipment_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $equipmentType = new EquipmentType();
        $form = $this->createForm(EquipmentTypeType::class, $equipmentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipmentType);
            $entityManager->flush();

            return $this->redirectToRoute('equipment_type_index');
        }

        return $this->render('equipment_type/new.html.twig', [
            'equipment_type' => $equipmentType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_type_show", methods={"GET"})
     */
    public function show(EquipmentType $equipmentType): Response
    {
        return $this->render('equipment_type/show.html.twig', [
            'equipment_type' => $equipmentType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="equipment_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EquipmentType $equipmentType): Response
    {
        $form = $this->createForm(EquipmentTypeType::class, $equipmentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipment_type_index', [
                'id' => $equipmentType->getId(),
            ]);
        }

        return $this->render('equipment_type/edit.html.twig', [
            'equipment_type' => $equipmentType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EquipmentType $equipmentType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipmentType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($equipmentType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('equipment_type_index');
    }
}
