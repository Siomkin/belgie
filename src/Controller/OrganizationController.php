<?php

namespace App\Controller;

use App\Entity\Canal;
use App\Entity\Equipment;
use App\Entity\Line;
use App\Entity\Organization;
use App\Form\OrganizationCanalType;
use App\Form\OrganizationEquipmentType;
use App\Form\OrganizationLineType;
use App\Form\OrganizationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/organization")
 */
class OrganizationController extends AbstractController
{
    /**
     * @Route("/", name="organization_index", methods={"GET"})
     */
    public function index(): Response
    {
        $organizations = $this->getDoctrine()
            ->getRepository(Organization::class)
            ->findAll();

        return $this->render(
            'organization/index.html.twig',
            [
                'organizations' => $organizations,
            ]
        );
    }

    /**
     * @Route("/new", name="organization_new", methods={"GET","POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $organization = new Organization();
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($organization);
            $entityManager->flush();

            return $this->redirectToRoute('organization_index');
        }

        return $this->render(
            'organization/new.html.twig',
            [
                'organization' => $organization,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="organization_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Organization $organization): Response
    {
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(
                'organization_index',
                [
                    'id' => $organization->getId(),
                ]
            );
        }

        return $this->render(
            'organization/edit.html.twig',
            [
                'organization' => $organization,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="organization_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Organization $organization): Response
    {
        if ($this->isCsrfTokenValid('delete'.$organization->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($organization);
            $entityManager->flush();
        }

        return $this->redirectToRoute('organization_index');
    }

    /**
     * Creates a form to edit a Organization entity.
     *
     * @param Organization $entity
     * @param array        $equipments
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createEqipmentsForm(Organization $entity, $equipments = [])
    {
        $form = $this->createForm(
            OrganizationEquipmentType::class,
            $entity,
            [
                'action' => $this->generateUrl('organization_equipments', ['id' => $entity->getId()]),
                'method' => 'PUT',
                'data' => $equipments,
            ]
        );

        // $form->add('submit', 'submit', array('label' => 'Сохранить'));

        return $form;
    }

    /**
     * Creates a form to edit a Organization entity.
     *
     * @param Organization $entity The entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createLinesForm(Organization $entity, $lines = [])
    {
        $form = $this->createForm(
            OrganizationLineType::class,
            $entity,
            [
                'action' => $this->generateUrl('organization_lines', ['id' => $entity->getId()]),
                'method' => 'PUT',
                'data' => $lines,
            ]
        );

        // $form->add('submit', 'submit', array('label' => 'Сохранить'));

        return $form;
    }

    /**
     * @param Organization $entity
     * @param array        $canals
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createCanalsForm(Organization $entity, $canals = [])
    {
        $form = $this->createForm(
            OrganizationCanalType::class,
            $entity,
            [
                'action' => $this->generateUrl('organization_canals', ['id' => $entity->getId()]),
                'method' => 'PUT',
                'data' => $canals,
            ]
        );

        // $form->add('submit', 'submit', array('label' => 'Сохранить'));

        return $form;
    }

    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}/equipments", name="organization_equipments")
     */
    public function equipmentsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Organization::class)->find($id);
        $equipmentsCol = $em->getRepository(Equipment::class)->findAll();
        foreach ($equipmentsCol as $equipment) {
            $equipments[$equipment->getCode()] = $equipment->getExtId();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createEqipmentsForm($entity, $equipments);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $entity->setEquipments(json_encode($editForm->get('equipments')->getData()));
            $em->flush();

            return $this->redirect($this->generateUrl('organization_equipments', ['id' => $id]));
        }
        $editForm->get('equipments')->submit(json_decode($entity->getEquipments()));

        return $this->render(
            'organization/lines.html.twig',
            [
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
            ]
        );
    }

    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}/lines", name="organization_lines")
     */
    public function linesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Organization::class)->find($id);
        $linesCol = $em->getRepository(Line::class)->findAll();
        foreach ($linesCol as $line) {
            $lines[$line->getName()] = $line->getExtId();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createLinesForm($entity, $lines);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $entity->setLines(json_encode($editForm->get('lines')->getData()));
            $em->flush();

            return $this->redirect($this->generateUrl('organization_lines', ['id' => $id]));
        }
        $editForm->get('lines')->submit(json_decode($entity->getLines()));

        return $this->render(
            'organization/lines.html.twig',
            [
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
            ]
        );
    }

    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}/canals", name="organization_canals")
     */
    public function canalsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Organization::class)->find($id);
        $canalsCol = $em->getRepository(Canal::class)->findAll();
        foreach ($canalsCol as $canal) {
            $canals[$canal->getName()] = $canal->getExtId();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createCanalsForm($entity, $canals);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $entity->setCanals(json_encode($editForm->get('canals')->getData()));
            $em->flush();

            return $this->redirect($this->generateUrl('organization_canals', ['id' => $id]));
        }
        $editForm->get('canals')->submit(json_decode($entity->getCanals()));

        return $this->render(
            'organization/canals.html.twig',
            [
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
            ]
        );
    }

    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}/download", name="organization_download")
     */
    public function downloadAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Organization $organization */
        $organization = $em->getRepository(Organization::class)->find($id);

        if (!$organization) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $equipments = $em->getRepository(Equipment::class)->selectForDownloads(json_decode($organization->getEquipments()));
        $lines = $em->getRepository(Line::class)->selectForDownloads(json_decode($organization->getLines()));
        $canals = $em->getRepository(Canal::class)->selectForDownloads(json_decode($organization->getCanals()));

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$organization->getName().'.xml"');

        $outXML = $this->renderView(
            'organization/download.xml.twig',
            [
                'organization' => $organization,
                'equipments' => $equipments,
                'lines' => $lines,
                'canals' => $canals,
            ]
        );

        //clean up xml
        $xml = new \DOMDocument();
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml->loadXML($outXML);
        $content = $xml->saveXML();

        $response->setContent($content);

        return $response;
    }
}
