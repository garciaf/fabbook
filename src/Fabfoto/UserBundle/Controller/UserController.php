<?php

namespace Fabfoto\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\UserBundle\Entity\User;
use Fabfoto\UserBundle\Form\Type\UserType;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Finds and displays a User entity.
     *
     * @Route("/", name="user_show")
     * @Template()
     */
    public function showAction()
    {
        $currentUser = $this->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoUserBundle:User')->find($currentUser->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        return array(
            'entity'      => $entity,
            );
    }


    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/edit", name="user_edit")
     * @Template()
     */
    public function editAction()
    {
        $currentUser = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoUserBundle:User')->find($currentUser->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);

        return array(
            'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing User entity.
     *
     * @Route("/update", name="user_update")
     * @Method("post")
     * @Template("FabfotoUserBundle:User:edit.html.twig")
     */
    public function updateAction()
    {
        $currentUser = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoUserBundle:User')->find($currentUser->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm   = $this->createForm(new UserType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

 
}
