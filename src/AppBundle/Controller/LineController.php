<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Line;
use AppBundle\Form\LineType;

/**
 * Line controller.
 *
 * @Route("/line")
 */
class LineController extends Controller
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

        $entities = $em->getRepository('AppBundle:Line')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Line entity.
     *
     * @Route("/", name="line_create")
     * @Method("POST")
     * @Template("AppBundle:Line:new.html.twig")
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

            return $this->redirect($this->generateUrl('line_show', array('id' => $entity->getExtId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
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
        $form = $this->createForm(new LineType(), $entity, array(
            'action' => $this->generateUrl('line_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Добавить'));

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
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
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

        $entity = $em->getRepository('AppBundle:Line')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Line entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
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

        $entity = $em->getRepository('AppBundle:Line')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Line entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
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
        $form = $this->createForm(new LineType(), $entity, array(
            'action' => $this->generateUrl('line_update', array('id' => $entity->getExtId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Обновить'));

        return $form;
    }
    /**
     * Edits an existing Line entity.
     *
     * @Route("/{id}", name="line_update")
     * @Method("PUT")
     * @Template("AppBundle:Line:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Line')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Line entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('line_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
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
            $entity = $em->getRepository('AppBundle:Line')->find($id);

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
            ->setAction($this->generateUrl('line_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}
