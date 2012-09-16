<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Fabfoto\GalleryBundle\Entity\ArticleBlog  as ArticleBlog;
use Fabfoto\UserBundle\Entity\User as User;
use Ps\PdfBundle\Annotation\Pdf;
/**
 * Article controller.
 *
 * @Route("/pdf")
 */
class PDFController extends BaseController
{

    /**
     * @Pdf()
     * @Route("/{slug}/pdfcard", name="show_about_pdf_from")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showPDFCardAction(User $user)
    {
        $vcard= $this->getVcardOfUser($user);
        return $this->render('FabfotoGalleryBundle:PDF:ShowAbout.pdf.twig', array(
            'user' => $user,
            'vcard' =>$vcard
                ));
        
//        return $this->render($html);
//        return $pdfObj->Output($user->getSlug().'carte.pdf');
    }

}
