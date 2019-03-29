<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * city controller.
 *
 * @Route("/city")
 * @IsGranted('ROLE_ADMIN')
 */
class CityController extends AbstractController
{
    /**
     * Lists all city entities.
     *
     * @Route("/", methods={"GET"}, name="city")
     */
    public function indexAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('App:city')->findAll();

        return $this->render(
            'city/index.html.twig',
            [
                'entities' => $entities,
            ]
        );
    }

    /**
     * Creates a new city entity.
     *
     * @Route("/", methods={"POST"}, name="city_create")
     */
    public function createAction(Request $request)
    {
        $entity = new City();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('city_show', ['id' => $entity->getId()]));
        }

        return $this->render(
            'city/new.html.twig',
            [
                'entity' => $entity,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Creates a form to create a city entity.
     *
     * @param City $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(City $entity)
    {
        $form = $this->createForm(
            new CityType(),
            $entity,
            [
                'action' => $this->generateUrl('city_create'),
                'method' => 'POST',
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Добавить']);

        return $form;
    }

    /**
     * Displays a form to create a new city entity.
     *
     * @Route("/new",methods={"GET"}, name="city_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new City();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'city/new.html.twig',
            [
                'entity' => $entity,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Finds and displays a city entity.
     *
     * @Route("/{id}", methods={"GET"},name="city_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:city')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find city entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing city entity.
     *
     * @Route("/{id}/edit",methods={"GET"}, name="city_edit")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:city')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find city entity.');
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
     * Creates a form to edit a city entity.
     *
     * @param City $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(City $entity)
    {
        $form = $this->createForm(
            new CityType(),
            $entity,
            [
                'action' => $this->generateUrl('city_update', ['id' => $entity->getId()]),
                'method' => 'PUT',
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Обновить']);

        return $form;
    }

    /**
     * Edits an existing city entity.
     *
     * @Route("/{id}",methods={"PUT"}, name="city_update")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:city')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find city entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('city_edit', ['id' => $id]));
        }

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a city entity.
     *
     * @Route("/{id}",methods={"DELETE"}, name="city_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('App:city')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find city entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('city'));
    }

    /**
     * Creates a form to delete a city entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('city_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Удалить'])
            ->getForm();
    }
}
