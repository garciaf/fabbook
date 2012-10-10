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

        return $this->render('FabfotoUserBundle:Portrait:index.html.twig', array(
		'entities' => $entities
		));
    }

    /**
     * Finds and displays a Portrait entity.
     *
     * @Route("/{id}/show", name="user_portrait_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoUserBundle:Portrait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Portrait entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FabfotoUserBundle:Portrait:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView()
		));
    }

    /**
     * Displays a form to create a new Portrait entity.
     *
     * @Route("/new", name="user_portrait_new")
     */
    public function newAction()
    {
        $entity = new Portrait();
        $form = $this->createForm(new PortraitType(), $entity);

        return $this->render('FabfotoUserBundle:Portrait:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
	));
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
        $form->bind($request);

        if ($form->isValid()) {
            try {
            $currentUser = $this->get('security.context')->getToken()->getUser();
            $entity->setUser($currentUser);
            $em = $this->getDoctrine()->getEntityManager();
            $this->get('fabfoto_gallery.picture_uploader')->upload($entity);
            $em->persist($entity);
            $em->flush();
	    $this->get('session')->setFlash('success', $this->get('translator')->trans("object.saved.success", array(), 'Ad    mingenerator') );

            return $this->redirect($this->generateUrl('user_portrait_show',
                                    array('id' => $entity->getId())));
            } catch (Exception $e) {
                $this->get('session')->setFlash('error',  $this->get('translator')->trans("object.saved.error", array(), 'Admingenerator') );
            }
        }

        return $this->render('FabfotoUserBundle:Portrait:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
	));
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

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Portrait entity.');
        }

        $em->remove($entity);
        $em->flush();
        $this->get('session')->setFlash('success', $this->get('translator')->trans("object.delete.success", array(), 'Ad    mingenerator') );

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
