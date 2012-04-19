<?php

namespace Fabfoto\GalleryBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Fabfoto\GalleryBundle\Entity\Tag as Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;
use Doctrine\ORM\Mapping\JoinTable as JoinTable;
use Doctrine\ORM\Mapping\ManyToMany as ManyToMany;
use Fabfoto\UserBundle\Entity\User as User;

/**
 * Fabfoto\GalleryBundle\Entity\ArticleBlog
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fabfoto\GalleryBundle\Entity\ArticleBlogRepository")
 */
class ArticleBlog
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
     * @var datetime $createdAt
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    
    /**
     * @var string $subtitle
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Fabfoto\UserBundle\Entity\User")
     */
    private $author;

     /**
      *  
      * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles")
      * @JoinTable(name="ArticleBlog_tags")
     */
     private $tags;


    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slugblog", type="string", length=255)
     */
    private $slugblog;
    
     public function __toString()
     {
         return $this->getTitle();
     }
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
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add tags
     *
     * @param Fabfoto\GalleryBundle\Entity\Tag $tags
     */
    public function addTag(\Tag $tags)
    {
        $tags->addArticleBlog($this);
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    /**
     * Set slugblog
     *
     * @param string $slugblog
     */
    public function setSlugblog($slugblog)
    {
        $this->slugblog = $slugblog;
    }

    /**
     * Get slugblog
     *
     * @return string 
     */
    public function getSlugblog()
    {
        return $this->slugblog;
    }

    /**
     * Set author
     *
     * @param Fabfoto\UserBundle\Entity\User $author
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return Fabfoto\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}