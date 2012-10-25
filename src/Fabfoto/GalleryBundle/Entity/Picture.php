<?php

namespace Fabfoto\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fabfoto\GalleryBundle\Entity\AbstractImage;
use Gedmo\Mapping\Annotation as Gedmo;
use Fabfoto\GalleryBundle\Entity\PictureRepository;
/**
 * Fabfoto\GalleryBundle\Entity\Picture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fabfoto\GalleryBundle\Entity\PictureRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Picture extends AbstractImage
{
    const defaultLocation = "defaultPicture.jpg";
    public function __toString()
    {
        return (string) $this->name;
    }

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
     * @var date $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Album")
     */
    private $album;

    /**
     * @ORM\Column(name="is_background", type="boolean")
     */
    private $isBackground;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
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
     * Set name
     *
     * @param string $name
     */
    public function setName($PictureRepositoryname)
    {
        $this->name = $PictureRepositoryname;
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
     * @return date
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set album
     *
     * @param Fabfoto\GalleryBundle\Entity\Picture $album
     */
    public function setAlbum(Album $album)
    {
        $this->album = $album;
    }

    /**
     * Get album
     *
     * @return Fabfoto\GalleryBundle\Entity\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set isBackground
     *
     * @param boolean $isBackground
     */
    public function setIsBackground($isBackground)
    {
        $this->isBackground = $isBackground;
    }

    /**
     * Get isBackground
     *
     * @return boolean
     */
    public function getIsBackground()
    {
        return $this->isBackground;
    }

}
