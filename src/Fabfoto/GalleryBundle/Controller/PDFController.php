<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Ps\PdfBundle\Annotation\Pdf;

/**
 * Article controller.
 *
 * @Route("/pdf")
 */
class PDFController extends Controller
{
    /**
     * 
     * @Route("/{slugblog}/blogarticle", name="show_article_blog_pdf")
     * @Pdf()
     */
    public function showBlogArticleAction($slugblog)
    {
        $format = $this->get('request')->get('_format');
        $article = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findOneBySlugblog($slugblog);
        if (!$article)
        {
            throw $this->createNotFoundException("Pas d'article");
        }
        return $this->render('FabfotoGalleryBundle:PDF:ShowArticleBlog.pdf.twig',
                        array(
                    'article' => $article
                ));
    }
 
}
