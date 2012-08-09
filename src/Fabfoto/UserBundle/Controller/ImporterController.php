<?php

namespace Fabfoto\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Fabfoto\GalleryBundle\Entity\Album as Album;
use Fabfoto\UserBundle\Form\Type\AlbumType as AlbumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fabfoto\UserBundle\Entity\Portrait;

/**
 * Portrait controller.
 *
 * @Route("/admin/import")
 */
class ImporterController extends Controller
{
    /**
     * Lists all Portrait entities.
     *
     * @Route("/", name="import_index")
     * @Template()
     */
    public function indexAction()
    {
        $files = $this->get('fabfoto_gallery.picture_importer')->getFileToImport();
        $album = new Album();
        $form = $this->createImportForm($album);

        return $this->render('FabfotoUserBundle:Import:index.html.twig', array(
                    'files' => $files,
                    'form' => $form->createView())
                );
    }

    /**
     * import pictures.
     *
     * @Route("/create", name="import_action")
     * @Method("post")
     */
    public function createAction()
    {

        $request = $this->getRequest();
        $album = new Album();
        $form    = $this->createImportForm($album);
        $form->bindRequest($request);

        if ($form->isValid()) {
            try {
            $this->get('fabfoto_gallery.picture_importer')->import($album);

            return $this->redirect($this->generateUrl('import_index'));
            } catch (\Exception $e) {
                $this->get('session')->setFlash('error',  $e->getMessage() );
            }
        }
        $files = $this->get('fabfoto_gallery.picture_importer')->getFileToImport();

        return $this->render('FabfotoUserBundle:Import:index.html.twig', array(
                    'files' => $files,
                    'form' => $form->createView())
                );
    }

    protected function createImportForm($album)
    {
        return $this->createForm(new AlbumType(), $album);

    }

}
