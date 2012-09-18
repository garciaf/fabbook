<?php

namespace Fabfoto\GalleryBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use \Fabfoto\GalleryBundle\Entity\ArticleBlog as ArticleBlog;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany as ManyToMany;
/**
 * Fabfoto\GalleryBundle\Entity\Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fabfoto\GalleryBundle\Entity\TagRepository")
 */
class Tag
{

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

     /**
     * @ManyToMany(targetEntity="ArticleBlog", mappedBy="tags")
     */
    private $articles;

    /**
     * @gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255 )
     */
    protected $slug;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articles
     *
     * @param Fabfoto\GalleryBundle\Entity\ArticleBlog $articles
     */
    public function addArticleBlog(ArticleBlog $articles)
    {
        $this->articles[] = $articles;
    }

    /**
     * Get articles
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

}
