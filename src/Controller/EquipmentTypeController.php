<?php

namespace App\Controller;

use App\Entity\EquipmentType;
use App\Form\EquipmentTypeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * EquipmentType controller.
 *
 * @Route("/equipmenttype")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class EquipmentTypeController extends AbstractController
{
    /**
     * Lists all EquipmentType entities.
     *
     * @Route("/", name="equipmenttype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('App:EquipmentType')->findAll();

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new EquipmentType entity.
     *
     * @Route("/", name="equipmenttype_create")
     * @Method("POST")
     * @Template("App:EquipmentType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new EquipmentType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('equipmenttype_show', ['id' => $entity->getId()]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a EquipmentType entity.
     *
     * @param EquipmentType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EquipmentType $entity)
    {
        $form = $this->createForm(
            new EquipmentTypeType(),
            $entity,
            [
                'action' => $this->generateUrl('equipmenttype_create'),
                'method' => 'POST',
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Добавить']);

        return $form;
    }

    /**
     * Displays a form to create a new EquipmentType entity.
     *
     * @Route("/new", name="equipmenttype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EquipmentType();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a EquipmentType entity.
     *
     * @Route("/{id}", name="equipmenttype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:EquipmentType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EquipmentType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing EquipmentType entity.
     *
     * @Route("/{id}/edit", name="equipmenttype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:EquipmentType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EquipmentType entity.');
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
     * Creates a form to edit a EquipmentType entity.
     *
     * @param EquipmentType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(EquipmentType $entity)
    {
        $form = $this->createForm(
            new EquipmentTypeType(),
            $entity,
            [
                'action' => $this->generateUrl('equipmenttype_update', ['id' => $entity->getId()]),
                'method' => 'PUT',
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Обновить']);

        return $form;
    }

    /**
     * Edits an existing EquipmentType entity.
     *
     * @Route("/{id}", name="equipmenttype_update")
     * @Method("PUT")
     * @Template("App:EquipmentType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:EquipmentType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EquipmentType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('equipmenttype_edit', ['id' => $id]));
        }

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a EquipmentType entity.
     *
     * @Route("/{id}", name="equipmenttype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('App:EquipmentType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EquipmentType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('equipmenttype'));
    }

    /**
     * Creates a form to delete a EquipmentType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipmenttype_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Удалить'])
            ->getForm();
    }
}
