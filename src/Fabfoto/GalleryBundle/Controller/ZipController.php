<?php

namespace Fabfoto\GalleryBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Request;
use Fabfoto\GalleryBundle\Entity\Album as Album;

class ZipController extends BaseController {

    /**
     * @var $album Album
     * @Route("{slug}/zip/album",defaults={"_format"="zip"}, name="zip_album")
     * @ParamConverter("album", class="FabfotoGalleryBundle:Album")
     */
    public function showAlbumAction(Album $album) {

        $zip = $this->get('fbk.zip');
	$zipName = $album->getSlug().'.zip';
        $pictures = $this->getAlbumPicture($album, false, true);
        try {
            $zip->create($zipName);
            foreach ($pictures as $picture) {
                    $zip->addFile($picture->getAbsolutePath(), $picture->getLocation());
            }
            
            $zip->close();
        } catch (\Exception $e) {
            $this->get('session')->setFlash('error', $e->getMessage());
        }
	return $zip->getResponse();
    }

}
