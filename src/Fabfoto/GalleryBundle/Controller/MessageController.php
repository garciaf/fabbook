<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\GalleryBundle\Entity\Message;
use Fabfoto\GalleryBundle\Form\Type\MessageType;
use Bundle\CaptchaBundle\Image as Captcha;

/**
 * Message controller.
 *
 * @Route("/")
 */
class MessageController extends Controller
{

    /**
     * Lists all Message entities.
     *
     * @Route("/admin/messages", name="contact")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FabfotoGalleryBundle:Message')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Message entity.
     *
     * @Route("admin/{id}/showmessage", name="contact_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:Message')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Message entity.
     *
     * @Route("contact", name="contact_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Message();
        $form = $this->createForm(new MessageType(), $entity);
        //$captcha = new Captcha();
        //$captcha->setSession($this['session']);
        return $this->render('FabfotoGalleryBundle:Default:contact.html.twig',array(
            'entity' => $entity,
            'form' => $form->createView(),
            //'captcha' => $captcha,
        ));
    }

    /**
     * Creates a new Message entity.
     *
     * @Route("/create", name="contact_create")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:Message:new.html.twig")
     */
    public function createAction()
    {
        $entity = new Message();
        $request = $this->getRequest();
        $form = $this->createForm(new MessageType(), $entity);
        $form->bindRequest($request);
        //if ($this['session']->get['word'] === $this['request']->request->get('riddle'))
        //{
            //$this->get('session')->setFlash(
             //       'error', 'The capcha was wrong sorry'
            //);
         //   return $this->redirect($this->generateUrl('contact_new'));
       // }
        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('show_articles'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Message entity.
     *
     * @Route("/{id}/edit", name="contact_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:Message')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $editForm = $this->createForm(new MessageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Message entity.
     *
     * @Route("admin/{id}/update", name="contact_update")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:Message:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:Message')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $editForm = $this->createForm(new MessageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid())
        {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_edit',
                                    array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Message entity.
     *
     * @Route("admin/{id}/delete", name="contact_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FabfotoGalleryBundle:Message')->find($id);

            if (!$entity)
            {
                throw $this->createNotFoundException('Unable to find Message entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contact'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
