<?php

namespace App\Controller;

use App\Entity\Destinations;
use App\Form\DestinationsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Destinations controller.
 *
 * @Route("/destinations")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class DestinationsController extends AbstractController
{
    /**
     * Lists all Destinations entities.
     *
     * @Route("/", name="destinations")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('App:Destinations')->findAll();

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Destinations entity.
     *
     * @Route("/", methods={"POST"} name="destinations_create")
     * @Template("App:Destinations:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Destinations();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('destinations_show', ['id' => $entity->getId()]));
        }

        return $this->render(
            ':Destinations/notneed:new.html.twig',
            [
                'entity' => $entity,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Destinations $entity
     *
     * @return FormInterface
     */
    private function createCreateForm(Destinations $entity)
    {
        $form = $this->createForm(
            new DestinationsType(),
            $entity,
            [
                'action' => $this->generateUrl('destinations_create'),
                'method' => 'POST',
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Create']);

        return $form;
    }

    /**
     * Displays a form to create a new Destinations entity.
     *
     * @Route("/new", name="destinations_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Destinations();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Destinations entity.
     *
     * @Route("/{id}", name="destinations_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Destinations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Destinations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Destinations entity.
     *
     * @Route("/{id}/edit", name="destinations_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Destinations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Destinations entity.');
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
     * Creates a form to edit a Destinations entity.
     *
     * @param Destinations $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Destinations $entity)
    {
        $form = $this->createForm(
            new DestinationsType(),
            $entity,
            [
                'action' => $this->generateUrl('destinations_update', ['id' => $entity->getId()]),
                'method' => 'PUT',
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }

    /**
     * Edits an existing Destinations entity.
     *
     * @Route("/{id}", name="destinations_update")
     * @Method("PUT")
     * @Template("App:Destinations:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Destinations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Destinations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('destinations_edit', ['id' => $id]));
        }

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Destinations entity.
     *
     * @Route("/{id}", name="destinations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('App:Destinations')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Destinations entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('destinations'));
    }

    /**
     * Creates a form to delete a Destinations entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('destinations_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Delete'])
            ->getForm();
    }
}
