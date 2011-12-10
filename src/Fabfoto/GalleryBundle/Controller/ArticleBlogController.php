<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\GalleryBundle\Entity\ArticleBlog;
use Fabfoto\GalleryBundle\Form\Type\ArticleBlogType;

/**
 * ArticleBlog controller.
 *
 * @Route("/admin/blog")
 */
class ArticleBlogController extends Controller
{
    /**
     * Lists all ArticleBlog entities.
     *
     * @Route("/", name="admin_blog")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a ArticleBlog entity.
     *
     * @Route("/{id}/show", name="admin_blog_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleBlog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new ArticleBlog entity.
     *
     * @Route("/new", name="admin_blog_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ArticleBlog();
        $form   = $this->createForm(new ArticleBlogType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new ArticleBlog entity.
     *
     * @Route("/create", name="admin_blog_create")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:ArticleBlog:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new ArticleBlog();
        $request = $this->getRequest();
        $form    = $this->createForm(new ArticleBlogType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_blog_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing ArticleBlog entity.
     *
     * @Route("/{id}/edit", name="admin_blog_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleBlog entity.');
        }

        $editForm = $this->createForm(new ArticleBlogType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ArticleBlog entity.
     *
     * @Route("/{id}/update", name="admin_blog_update")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:ArticleBlog:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleBlog entity.');
        }

        $editForm   = $this->createForm(new ArticleBlogType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_blog_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ArticleBlog entity.
     *
     * @Route("/{id}/delete", name="admin_blog_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FabfotoGalleryBundle:ArticleBlog')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ArticleBlog entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_blog'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
