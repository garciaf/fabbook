<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Article controller.
 *
 * @Route("/pdf")
 */
class PDFController extends BaseController
{
    /**
     *
     * @Route("/{slugblog}/blogarticle", defaults={"_format"="pdf"}, name="show_article_blog_pdf")
     *
     */
    public function showBlogArticleAction($slugblog)
    {
        $format = $this->get('request')->get('_format');
        $pdfObj = $this->get("white_october.tcpdf")->create();
        $article = $this->getBlog($slugblog);
        if (!$article) {
            throw $this->createNotFoundException("No article");
        }

        $html = $this->renderView('FabfotoGalleryBundle:PDF:ShowArticleBlog.pdf.twig', array(
            'article' => $article
                ));
        $pdfObj->AddPage();
        $pdfObj->writeHTML($html, true, false, true, false, '');
        $pdfObj->lastPage();

        return $pdfObj->Output($article->getSlugblog() . '.pdf');
    }

    /**
     * @Route("/{slug}/pdfcard", name="show_about_pdf_from")
     *
     */
    public function showPDFCardAction($slug)
    {
        $pdfObj = $this->get("white_october.tcpdf")->create();
        $user = $this->getUserBySlug($slug);

        if (!$user) {
            throw $this->createNotFoundException("No user");
        }
        $vcard= $this->getVcardOfUser($user);
        $html = $this->renderView('FabfotoGalleryBundle:User:ShowAbout.pdf.twig', array(
            'user' => $user,
            'vcard' =>$vcard
                ));
        $pdfObj->SetFont('dejavusans', '', 6);
        $pdfObj->setPrintHeader(false);
        $pdfObj->setPrintFooter(false);
        //$BackgroundUrl = $this->get('templating.helper.assets')->getUrl('bundles/fabfotogallery/image/about_me.jpg');
        $pdfObj->AddPage('P', 'BUSINESS_CARD_FR');
        $pdfObj->writeHTML($html, true, false, true, false, '');
        $pdfObj->lastPage();

        return $pdfObj->Output($slug.'carte.pdf');
    }

}
