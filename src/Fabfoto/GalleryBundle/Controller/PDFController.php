<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Fabfoto\GalleryBundle\Entity\ArticleBlog  as ArticleBlog;
use Fabfoto\UserBundle\Entity\User as User;

/**
 * Article controller.
 *
 * @Route("/pdf")
 */
class PDFController extends BaseController
{
    /**
     * @Cache(expires="tomorrow")
     * @Route("/{slugblog}/blogarticle", defaults={"_format"="pdf"}, name="show_article_blog_pdf")
     * @ParamConverter("article", class="FabfotoGalleryBundle:ArticleBlog")
     */
    public function showBlogArticleAction(ArticleBlog $article)
    {
        $format = $this->get('request')->get('_format');
        $pdfObj = $this->get("white_october.tcpdf")->create();

        $html = $this->renderView('FabfotoGalleryBundle:PDF:ShowArticleBlog.pdf.twig', array(
            'article' => $article
                ));
        $pdfObj->AddPage();
        $pdfObj->writeHTML($html, true, false, true, false, '');
        $pdfObj->lastPage();

        return $pdfObj->Output($article->getSlugblog() . '.pdf');
    }

    /**
     * @Cache(expires="tomorrow")
     * @Route("/{slug}/pdfcard", name="show_about_pdf_from")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showPDFCardAction(User $user)
    {
        $pdfObj = $this->get("white_october.tcpdf")->create();
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

        return $pdfObj->Output($user->getSlug().'carte.pdf');
    }

}
