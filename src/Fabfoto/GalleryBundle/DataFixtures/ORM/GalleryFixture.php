<?php

namespace TestFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fabfoto\GalleryBundle\Entity\Album;
use Fabfoto\GalleryBundle\Entity\Article;
use Fabfoto\GalleryBundle\Entity\ArticleBlog;
class GalleryFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $album = new Album();
        $album->setName("Album");
        $album->setComment("Comment");
        
        $manager->persist($album);
        
        $new = new Article();
        $new->setTitle("Une news");
        $new->setSubtitle("sous - titre ");
        $new->setContent("Le contenu de la nouvelle");
        $new->setAuthor("Fabien");
        $new->setAuthorSlug("fabien");
        $manager->persist($new);
        
        $blog = new ArticleBlog();
        $blog->setTitle("Un article");
        $blog->setSubtitle("sous titre");
        $blog->setIsPublished(true);
        $blog->setContent("Le contenu !!");
        $blog->setAuthor("Fabien");
        $blog->setAuthorSlug("fabien");
        $manager->persist($blog);
        
        $manager->flush();
        
    }
}

