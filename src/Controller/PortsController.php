<?php

namespace App\Controller;

use App\Entity\Ports;
use App\Form\PortsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ports controller.
 *
 * @Route("/ports")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class PortsController extends AbstractController
{
    /**
     * Lists all Ports entities.
     *
     * @Route("/", name="ports")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('App:Ports')->findAll();

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Ports entity.
     *
     * @Route("/", name="ports_create")
     * @Method("POST")
     * @Template("App:Ports:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Ports();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ports_show', ['id' => $entity->getId()]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Ports entity.
     *
     * @param Ports $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ports $entity)
    {
        $form = $this->createForm(new PortsType(), $entity, [
            'action' => $this->generateUrl('ports_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Create']);

        return $form;
    }

    /**
     * Displays a form to create a new Ports entity.
     *
     * @Route("/new", name="ports_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Ports();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Ports entity.
     *
     * @Route("/{id}", name="ports_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Ports')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ports entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Ports entity.
     *
     * @Route("/{id}/edit", name="ports_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Ports')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ports entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Ports entity.
     *
     * @param Ports $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Ports $entity)
    {
        $form = $this->createForm(new PortsType(), $entity, [
            'action' => $this->generateUrl('ports_update', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }

    /**
     * Edits an existing Ports entity.
     *
     * @Route("/{id}", name="ports_update")
     * @Method("PUT")
     * @Template("App:Ports:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Ports')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ports entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ports_edit', ['id' => $id]));
        }

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Ports entity.
     *
     * @Route("/{id}", name="ports_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('App:Ports')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ports entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ports'));
    }

    /**
     * Creates a form to delete a Ports entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ports_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Delete'])
            ->getForm()
        ;
    }
}
