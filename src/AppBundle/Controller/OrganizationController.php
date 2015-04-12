<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Organization;
use AppBundle\Form\OrganizationCanalType;
use AppBundle\Form\OrganizationEquipmentType;
use AppBundle\Form\OrganizationLineType;
use AppBundle\Form\OrganizationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Organization controller.
 *
 * @Route("/organization")
 */
class OrganizationController extends Controller
{

    /**
     * Lists all Organization entities.
     *
     * @Route("/", name="organization")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Organization')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Organization entity.
     *
     * @Route("/", name="organization_create")
     * @Method("POST")
     * @Template("AppBundle:Organization:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Organization();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organization_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a form to create a Organization entity.
     *
     * @param Organization $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Organization $entity)
    {
        $form = $this->createForm(
            new OrganizationType(),
            $entity,
            array(
                'action' => $this->generateUrl('organization_create'),
                'method' => 'POST'
            )
        );

        $form->add('submit', 'submit', array('label' => 'Добавить'));

        return $form;
    }

    /**
     * Displays a form to create a new Organization entity.
     *
     * @Route("/new", name="organization_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Organization();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Finds and displays a Organization entity.
     *
     * @Route("/{id}", name="organization_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Displays a form to edit an existing Organization entity.
     *
     * @Route("/{id}/edit", name="organization_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Creates a form to edit a Organization entity.
     *
     * @param Organization $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Organization $entity)
    {
        $form = $this->createForm(
            new OrganizationType(),
            $entity,
            array(
                'action' => $this->generateUrl('organization_update', array('id' => $entity->getId())),
                'method' => 'PUT'
            )
        );

        $form->add('submit', 'submit', array('label' => 'Обновить'));

        return $form;
    }

    /**
     * Creates a form to edit a Organization entity.
     *
     * @param Organization $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEqipmentsForm(Organization $entity, $equipments = array())
    {
        $form = $this->createForm(
            new OrganizationEquipmentType(),
            $entity,
            array(
                'action' => $this->generateUrl('organization_equipments', array('id' => $entity->getId())),
                'method' => 'PUT',
                'data' => $equipments
            )
        );

        $form->add('submit', 'submit', array('label' => 'Сохранить'));

        return $form;
    }

    /**
     * Creates a form to edit a Organization entity.
     *
     * @param Organization $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createLinesForm(Organization $entity, $lines = array())
    {
        $form = $this->createForm(
            new OrganizationLineType(),
            $entity,
            array(
                'action' => $this->generateUrl('organization_lines', array('id' => $entity->getId())),
                'method' => 'PUT',
                'data' => $lines
            )
        );

        $form->add('submit', 'submit', array('label' => 'Сохранить'));

        return $form;
    }

    /**
     * Creates a form to edit a Organization entity.
     *
     * @param Organization $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCanalsForm(Organization $entity, $canals = array())
    {
        $form = $this->createForm(
            new OrganizationCanalType(),
            $entity,
            array(
                'action' => $this->generateUrl('organization_canals', array('id' => $entity->getId())),
                'method' => 'PUT',
                'data' => $canals
            )
        );

        $form->add('submit', 'submit', array('label' => 'Сохранить'));

        return $form;
    }


    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}", name="organization_update")
     * @Method("PUT")
     * @Template("AppBundle:Organization:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('organization_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Deletes a Organization entity.
     *
     * @Route("/{id}", name="organization_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Organization')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Organization entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('organization'));
    }

    /**
     * Creates a form to delete a Organization entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organization_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm();
    }


    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}/equipments", name="organization_equipments")
     *
     * @Template("AppBundle:Organization:equipments.html.twig")
     */
    public function equipmentsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Organization')->find($id);
        $equipmentsCol = $em->getRepository('AppBundle:Equipment')->findAll();
        foreach ($equipmentsCol as $equipment) {
            $equipments[$equipment->getExtId()] = $equipment->getCode();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createEqipmentsForm($entity, $equipments);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setEquipments(json_encode($editForm->get('equipments')->getData()));
            $em->flush();

            return $this->redirect($this->generateUrl('organization_equipments', array('id' => $id)));
        } else {
            $editForm->get('equipments')->submit(json_decode($entity->getEquipments()));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}/lines", name="organization_lines")
     *
     * @Template("AppBundle:Organization:lines.html.twig")
     */
    public function linesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Organization')->find($id);
        $linesCol = $em->getRepository('AppBundle:Line')->findAll();
        foreach ($linesCol as $line) {
            $lines[$line->getExtId()] = $line->getName();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createLinesForm($entity, $lines);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setLines(json_encode($editForm->get('lines')->getData()));
            $em->flush();

            return $this->redirect($this->generateUrl('organization_lines', array('id' => $id)));
        } else {
            $editForm->get('lines')->submit(json_decode($entity->getLines()));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}/canals", name="organization_canals")
     *
     * @Template("AppBundle:Organization:canals.html.twig")
     */
    public function canalsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Organization')->find($id);
        $canalsCol = $em->getRepository('AppBundle:Canal')->findAll();
        foreach ($canalsCol as $canal) {
            $canals[$canal->getExtId()] = $canal->getName();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createCanalsForm($entity, $canals);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setCanals(json_encode($editForm->get('canals')->getData()));
            $em->flush();

            return $this->redirect($this->generateUrl('organization_canals', array('id' => $id)));
        } else {
            $editForm->get('canals')->submit(json_decode($entity->getCanals()));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}/download", name="organization_download")
     *
     * @Template("AppBundle:Organization:download.xml.twig")
     */
    public function downloadAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $equipments = $em->getRepository('AppBundle:Equipment')->findByExtId(
            json_decode($entity->getEquipments())
        );
        $lines = $em->getRepository('AppBundle:Line')->findByExtId(json_decode($entity->getLines()));
        $canals = $em->getRepository('AppBundle:Canal')->findByExtId(json_decode($entity->getCanals()));

        $response = new Response();
        $response->headers->set('Content-Type', 'xml');

        return $this->render(
            'AppBundle:Organization:download.xml.twig',
            array(
                'entity' => $entity,
                'equipments' => $equipments,
                'lines' => $lines,
                'canals' => $canals
            ),
            $response
        );

    }
}
