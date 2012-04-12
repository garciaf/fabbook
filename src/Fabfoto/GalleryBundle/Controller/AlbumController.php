<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\GalleryBundle\Entity\Album;
use Fabfoto\GalleryBundle\Form\Type\AlbumType;

/**
 * Album controller.
 *
 * @Route("/admin/old/albums")
 */
class AlbumController extends Controller
{
    /**
     * Lists all Album entities.
     *
     * @Route("/", name="adminAlbums")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FabfotoGalleryBundle:Album')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Album entity.
     *
     * @Route("/{id}/show", name="adminAlbums_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $album = $em->getRepository('FabfotoGalleryBundle:Album')->find($id);

        if (!$album) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'album'      => $album,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Album entity.
     *
     * @Route("/new", name="adminAlbums_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Album();
        $form   = $this->createForm(new AlbumType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Album entity.
     *
     * @Route("/create", name="adminAlbums_create")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:Album:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Album();
        $request = $this->getRequest();
        $form    = $this->createForm(new AlbumType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminAlbums_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Album entity.
     *
     * @Route("/{id}/edit", name="adminAlbums_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $editForm = $this->createForm(new AlbumType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Album entity.
     *
     * @Route("/{id}/update", name="adminAlbums_update")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:Album:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FabfotoGalleryBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $editForm   = $this->createForm(new AlbumType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminAlbums_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Album entity.
     *
     * @Route("/{id}/delete", name="adminAlbums_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $album = $em->getRepository('FabfotoGalleryBundle:Album')->find($id);
            $pictures = $em->getRepository('FabfotoGalleryBundle:Picture')->findByAlbum($id);
            if (!$album) {
                throw $this->createNotFoundException('Unable to find Album entity.');
            }
            foreach($pictures as $picture){
                $em->remove($picture);
            }

            $em->remove($album);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminAlbums'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
