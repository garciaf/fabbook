<?php

namespace Fabfoto\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\UserBundle\Entity\Portrait;
use Fabfoto\UserBundle\Form\Type\PortraitType;

/**
 * Portrait controller.
 *
 * @Route("/user/portrait")
 */
class PortraitController extends Controller
{

    /**
     * Lists all Portrait entities.
     *
     * @Route("/", name="user_portrait")
     * @Template()
     */
    public function indexAction()
    {
        $currentUser = $this->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FabfotoUserBundle:Portrait')
                ->findBy(array(
                        'user' => $currentUser->getId()
                    ))
                ;

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Portrait entity.
     *
     * @Route("/{id}/show", name="user_portrait_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $entity = $em->getRepository('FabfotoUserBundle:Portrait')->find($id);
        
        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Portrait entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Portrait entity.
     *
     * @Route("/new", name="user_portrait_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Portrait();
        $form = $this->createForm(new PortraitType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Portrait entity.
     *
     * @Route("/create", name="user_portrait_create")
     * @Method("post")
     * @Template("FabfotoUserBundle:Portrait:new.html.twig")
     */
    public function createAction()
    {
        $entity = new Portrait();
        $request = $this->getRequest();
        $form = $this->createForm(new PortraitType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid())
        {
            $currentUser = $this->get('security.context')->getToken()->getUser();
            $entity->setUser($currentUser);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_portrait_show',
                                    array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Portrait entity.
     *
     * @Route("/{id}/edit", name="user_portrait_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoUserBundle:Portrait')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Portrait entity.');
        }

        $editForm = $this->createForm(new PortraitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Portrait entity.
     *
     * @Route("/{id}/update", name="user_portrait_update")
     * @Method("post")
     * @Template("FabfotoUserBundle:Portrait:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoUserBundle:Portrait')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Portrait entity.');
        }

        $editForm = $this->createForm(new PortraitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid())
        {
            $currentUser = $this->get('security.context')->getTocken()->getUser();
            $entity->setUser($currentUser);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_portrait_edit',
                                    array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Portrait entity.
     *
     * @Route("/{id}/delete", name="user_portrait_delete")
     * 
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('FabfotoUserBundle:Portrait')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Portrait entity.');
        }

        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('user_portrait'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}