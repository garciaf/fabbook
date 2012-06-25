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
class PDFController extends Controller
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
        $article = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findOneBySlugblog($slugblog);
        if (!$article) {
            throw $this->createNotFoundException("Pas d'article");
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
        $author = $this
                ->getDoctrine()
                ->getRepository('FabfotoUserBundle:User')
                ->findOneBy(array(
            'slug' => $slug
                ));
        if (!$author) {
            throw $this->createNotFoundException("No user");
        }
        $html = $this->renderView('FabfotoGalleryBundle:User:ShowAbout.pdf.twig', array(
            'author' => $author,
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
