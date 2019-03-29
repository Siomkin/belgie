<?php

namespace App\Controller;

use App\Entity\Line;
use App\Form\LineType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Line controller.
 *
 * @Route("/line")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class LineController extends AbstractController
{
    /**
     * Lists all Line entities.
     *
     * @Route("/", name="line")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('App:Line')->findAll();

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Line entity.
     *
     * @Route("/", name="line_create")
     * @Method("POST")
     * @Template("App:Line:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Line();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('line_show', ['id' => $entity->getExtId()]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Line entity.
     *
     * @param Line $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Line $entity)
    {
        $form = $this->createForm(new LineType(), $entity, [
            'action' => $this->generateUrl('line_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Добавить']);

        return $form;
    }

    /**
     * Displays a form to create a new Line entity.
     *
     * @Route("/new", name="line_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Line();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Line entity.
     *
     * @Route("/{id}", name="line_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Line')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Line entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Line entity.
     *
     * @Route("/{id}/edit", name="line_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Line')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Line entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity' => $entity,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Line entity.
     *
     * @param Line $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Line $entity)
    {
        $form = $this->createForm(new LineType(), $entity, [
            'action' => $this->generateUrl('line_update', ['id' => $entity->getExtId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Обновить']);

        return $form;
    }

    /**
     * Edits an existing Line entity.
     *
     * @Route("/{id}", name="line_update")
     * @Method("PUT")
     * @Template("App:Line:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:Line')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Line entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('line_edit', ['id' => $id]));
        }

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Line entity.
     *
     * @Route("/{id}", name="line_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('App:Line')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Line entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('line'));
    }

    /**
     * Creates a form to delete a Line entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('line_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Удалить'])
            ->getForm()
        ;
    }
}
