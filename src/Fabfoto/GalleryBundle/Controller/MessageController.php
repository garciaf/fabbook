<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\GalleryBundle\Entity\Message;
use Fabfoto\GalleryBundle\Form\Type\MessageType;

/**
 * Message controller.
 *
 * @Route("/")
 */
class MessageController extends Controller
{

    /**
     * Displays a form to create a new Message entity.
     * @Cache(expires="+1 week", public=true )
     * @Route("contact/", name="contact_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Message();
        $form = $this->createForm(new MessageType(), $entity);

        return $this->render('FabfotoGalleryBundle:Default:contact.html.twig',array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Message entity.
     *
     * @Route("create/", name="contact_create")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:Default:contact.html.twig")
     */
    public function createAction()
    {
        $entity = new Message();
        $request = $this->getRequest();
        $form = $this->createForm(new MessageType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            $this->sendMail($entity);
        $this->get('session')->setFlash('success', $this->get('translator')->trans("message.send.success") );

            return $this->redirect($this->generateUrl('show_articles'));
        } else {
        $this->get('session')->setFlash('error', $this->get('translator')->trans("message.send.fail") );
    }

        return $this->render('FabfotoGalleryBundle:Default:contact.html.twig',array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    /**
     *
     * @param \Fabfoto\GalleryBundle\Entity\Message $message
     */
    protected function sendMail(Message $message)
    {
        $messageToSend = \Swift_Message::newInstance()
        ->setSubject('[fabbook] from: '.$message->getSender().' : '.$message->getSubject())
        ->setFrom($this->container->getParameter('mailsender'))
        ->setReplyTo($message->getSender())
        ->setTo('fab0670312047@gmail.com')
        ->setBody($message->getContent())
    ;
    $this->get('mailer')->send($messageToSend);
    }
}
