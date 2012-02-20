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
     * @Route("/{slugblog}/blogarticle", defaults={"_format"="pdf"}, name="show_article_blog_pdf")
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
     /**
     * @Route("about", defaults={"_format"="pdf"}, name="show_about_pdf")
     * @Pdf()
     */
    public function showAboutAction()
    {
        
            $author = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Author')
                ->findOneBy(array());
 $vcard = sprintf(          
"BEGIN:VCARD
VERSION:3.0
N:%s;%s
FN:%s %s
ORG:
TITLE:%s
PHOTO;
TEL;TYPE=WORK,VOICE:(111) 555-1212
TEL;TYPE=HOME,VOICE:(404) 555-1212
ADR;TYPE=WORK:;;100 Waters Edge;Baytown;LA;30314;United States of America
LABEL;TYPE=WORK:100 Waters Edge\nBaytown, LA 30314\nUnited States of America
ADR;TYPE=HOME:;;42 Plantation St.;Baytown;LA;30314;United States of America
LABEL;TYPE=HOME:42 Plantation St.\nBaytown, LA 30314\nUnited States of America
EMAIL;TYPE=PREF,INTERNET:%s
REV:20080424T195243Z
END:VCARD", $author->getName(), $author->getFirstName(), 
         $author->getFirstName(), $author->getName(), 
         $author->getTitle(),
         $author->getMail());
        return $this->render('FabfotoGalleryBundle:PDF:ShowAbout.pdf.twig',
                        array(
                            'author' => $author,
                            'vcard'  => $vcard,
                ));
    }
 
}
