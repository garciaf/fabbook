<?php

namespace Fabfoto\GalleryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fabfoto\GalleryBundle\Entity\Album;
use Fabfoto\GalleryBundle\Entity\Article;
use Fabfoto\GalleryBundle\Entity\ArticleBlog;
use Fabfoto\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GalleryFixture implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername("toto");
        $user->setName("toto");
        $user->setEmail("toto@mail.com");
        $user->setFirstname("toto");
        $user->setPlainPassword("test");
        $user->setEnabled(true);

        $userManager->updateUser($user, true);
        $album = new Album();
        $album->setName("Album");
        $album->setComment("Comment");

        $manager->persist($album);

        $new = new Article();
        $new->setTitle("Une news");
        $new->setSubtitle("sous - titre ");
        $new->setContent("Le contenu de la nouvelle");
        $new->setAuthor( $user);
        $manager->persist($new);

        $blog = new ArticleBlog();
        $blog->setTitle("Un article");
        $blog->setSubtitle("sous titre");
        $blog->setIsPublished(true);
        $blog->setContent("Le contenu !!");
        $blog->setAuthorUser($user);
        $manager->persist($blog);

        $manager->flush();
    }

}
