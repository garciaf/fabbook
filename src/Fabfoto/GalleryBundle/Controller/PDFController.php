<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Fabfoto\UserBundle\Entity\User as User;
use Fabfoto\GalleryBundle\Entity\ArticleBlog  as ArticleBlog;
use Ps\PdfBundle\Annotation\Pdf;
/**
 * Article controller.
 *
 * @Route("/pdf")
 */
class PDFController extends BaseController
{
    /**
     * @Cache(expires="+1 week", public=true)
     * @Route("/{slugblog}/blog", defaults={"_format"="pdf"}, name="show_article_blog_pdf")
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
     * @Route("/{slug}/card", name="show_about_pdf_from", defaults={"_format"="pdf"})
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showPDFCardAction(User $user)
    {
        $pdfObj = $this->get("white_october.tcpdf")->create();
        $vcard= $this->getVcardOfUser($user);
        $html = $this->renderView('FabfotoGalleryBundle:PDF:ShowAbout.pdf.twig', array(
            'user' => $user,
            'vcard' =>$vcard
                ));
        $pdfObj->SetFont('dejavusans', '', 6);
        $pdfObj->setPrintHeader(false);
        $pdfObj->setPrintFooter(false);
        $pdfObj->AddPage('P', 'BUSINESS_CARD_FR');
        $pdfObj->writeHTML($html, true, false, true, false, '');
        $pdfObj->lastPage();

        return $pdfObj->Output($user->getSlug().'carte.pdf');
    }

}
