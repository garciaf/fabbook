<?php

namespace Fabfoto\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\GalleryBundle\Entity\ArticleBlog;
use Fabfoto\UserBundle\Form\Type\ArticleBlogType;

/**
 * ArticleBlog controller.
 *
 * @Route("/writer/blog")
 */
class ArticleBlogController extends Controller {

    /**
     * Lists all ArticleBlog entities.
     *
     * @Route("/", name="writter_blog")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $curentUser = $this->get('security.context')->getToken()->getUser();
        $entities = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findByAuthorSlug($curentUser->getSlug());

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a ArticleBlog entity.
     *
     * @Route("/{id}/show", name="writter_blog_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleBlog entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to create a new ArticleBlog entity.
     *
     * @Route("/new", name="writter_blog_new")
     * @Template()
     */
    public function newAction() {
        $entity = new ArticleBlog();
        $form = $this->createForm(new ArticleBlogType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new ArticleBlog entity.
     *
     * @Route("/create", name="writter_blog_create")
     * @Method("post")
     */
    public function createAction() {
        $entity = new ArticleBlog();

        $request = $this->getRequest();
        $form = $this->createForm(new ArticleBlogType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            try {
                $curentUser = $this->get('security.context')->getToken()->getUser();
                $entity->setAuthor((string) $curentUser);
                $entity->setAuthorSlug($curentUser->getSlug());
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('writter_blog_show', array('id' => $entity->getId())));
            } catch (\Exception $e) {
                $this->get('session')->setFlash('error', $this->get('translator')->trans("object.saved.error", array(), 'Admingenerator'));
            }
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing ArticleBlog entity.
     *
     * @Route("/{id}/edit", name="writter_blog_edit")
     * @Template()
     */
    public function editAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $curentUser = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findOneBy(array('id' => $id, 'authorSlug' => $curentUser->getSlug()));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleBlog entity.');
        }

        $editForm = $this->createForm(new ArticleBlogType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing ArticleBlog entity.
     *
     * @Route("/{id}/update", name="writter_blog_update")
     * @Method("post")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleBlog entity.');
        }

        $editForm = $this->createForm(new ArticleBlogType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            try {
                $curentUser = $this->get('security.context')->getToken()->getUser();
                $entity->setAuthor((string) $curentUser);
                $entity->setAuthorSlug($curentUser->getSlug());
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('writter_blog_edit', array('id' => $id)));
            } catch (\Exception $e) {
                $this->get('session')->setFlash('error', $this->get('translator')->trans("object.saved.error", array(), 'Admingenerator'));
            }
        }
        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a ArticleBlog entity.
     *
     * @Route("/{id}/delete", name="writter_blog_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleBlog entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('writter_blog'));
    }

}
