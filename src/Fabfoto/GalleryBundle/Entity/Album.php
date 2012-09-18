<?php

namespace Fabfoto\GalleryBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use \Fabfoto\GalleryBundle\Entity\Picture as Picture;
use \Fabfoto\GalleryBundle\Entity\Category as Category;
use Doctrine\Common\Collections\Collection;

/**
 * Fabfoto\GalleryBundle\Entity\Album
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fabfoto\GalleryBundle\Entity\AlbumRepository")
 */
class Album
{
    protected $container;
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @var date $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
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
     *
     * @ORM\OneToMany(targetEntity = "Picture",mappedBy="album", cascade={"remove"})
     */
    private $pictures;

    /**
     * @var string $name
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     */
    private $category;
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

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set comment
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAt
     *
     * @param date $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add pictures
     *
     * @param Fabfoto\GalleryBundle\Entity\Picture $picture
     */
    public function addPicture(Picture $picture)
    {
        $this->pictures[] = $picture;
    }

    /**
     * Get pictures
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    public function __toString()
    {
        return (string) $this->name;
    }
    /**
     * @return Picture
     */
    public function getPictureCover()
    {
        if ($this->pictures[0]) {
            return $this->pictures[0];
        } else {
            $defaultPicture = new Picture();
            $defaultPicture->setLocation(Picture::defaultLocation);

            return $defaultPicture;

        }
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

    /**
     * Set category
     *
     * @param Fabfoto\GalleryBundle\Entity\Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function isCategorySlug($slugName)
    {
        $category = $this->getCategory();
        if ($category) {
            if ($category->getSlug() == $slugName) {
                return true;
            }
        }

        return false;

    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return Album
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Remove pictures
     *
     * @param Fabfoto\GalleryBundle\Entity\Picture $pictures
     */
    public function removePicture(Picture $pictures)
    {
        $this->pictures->removeElement($pictures);
    }
}
