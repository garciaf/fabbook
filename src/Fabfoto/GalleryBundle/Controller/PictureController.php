<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\GalleryBundle\Entity\Picture;
use Fabfoto\GalleryBundle\Form\Type\PictureType;
use Symfony\Component\Finder\Finder;

/**
 * Picture controller.
 *
 * @Route("/admin/picture")
 */
class PictureController extends Controller
{

    /**
     * Lists all Picture entities.
     *
     * @Route("/", name="adminPicture")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $pictures = $em->getRepository('FabfotoGalleryBundle:Picture')->
                findBy(array(), array('name' => 'ASC'));

        return array('pictures' => $pictures);
    }

    /**
     * Finds and displays a Picture entity.
     *
     * @Route("/{id}/show", name="adminPicture_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $picture = $em->getRepository('FabfotoGalleryBundle:Picture')->find($id);

        if (!$picture)
        {
            throw $this->createNotFoundException('Unable to find Picture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $picture,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Picture entity.
     *
     * @Route("/new", name="adminPicture_new")
     * @Template()
     */
    public function newAction()
    {
        $picture = new Picture();
        $form = $this->createForm(new PictureType(), $picture);

        return array(
            'entity' => $picture,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Picture entity.
     *
     * @Route("/create", name="adminPicture_create")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:Picture:new.html.twig")
     */
    public function createAction()
    {
        $picture = new Picture();
        $request = $this->getRequest();
        $form = $this->createForm(new PictureType(), $picture);
        $form->bindRequest($request);

        if ($form->isValid())
        {
            $this->get('fabfoto_gallery.picture_uploader')->upload($picture);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($picture);
            $em->flush();

            return $this->redirect($this->generateUrl('adminPicture_show',
                                    array('id' => $picture->getId())));
        }

        return array(
            'entity' => $picture,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Picture entity.
     *
     * @Route("/{id}/edit", name="adminPicture_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $picture = $em->getRepository('FabfotoGalleryBundle:Picture')->find($id);

        if (!$picture)
        {
            throw $this->createNotFoundException('Unable to find Picture entity.');
        }

        $editForm = $this->createForm(new PictureType(), $picture);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $picture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Picture entity.
     *
     * @Route("/{id}/update", name="adminPicture_update")
     * @Method("post")
     * @Template("FabfotoGalleryBundle:Picture:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $picture = $em->getRepository('FabfotoGalleryBundle:Picture')->find($id);
        if (!$picture)
        {
            throw $this->createNotFoundException('Unable to find Picture entity.');
        }
        $location = $picture->getLocation();
        $editForm = $this->createForm(new PictureType(), $picture);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        
        if ($editForm->isValid())
        {   
            $picture->setLocation($location);
            $em->persist($picture);
            $em->flush();

            return $this->redirect($this->generateUrl('adminPicture_edit',
                                    array('id' => $id)));
        }

        return array(
            'entity' => $picture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Picture entity.
     *
     * @Route("/{id}/delete", name="adminPicture_delete")
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
            $picture = $em->getRepository('FabfotoGalleryBundle:Picture')->find($id);
            if (!$picture)
            {
                throw $this->createNotFoundException('Unable to find Picture entity.');
            }

            $em->remove($picture);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminPicture'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
