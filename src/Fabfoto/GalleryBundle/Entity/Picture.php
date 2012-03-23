<?php

namespace Fabfoto\GalleryBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use \Fabfoto\GalleryBundle\Entity\Picture as Picture;

/**
 * Fabfoto\GalleryBundle\Entity\Picture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fabfoto\GalleryBundle\Entity\PictureRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Picture
{

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
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var date $createdAt
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="date", nullable=true)
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
     * Set location
     *
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
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

    public function getAbsolutePath()
    {
        return null === $this->location ? null : $this->getUploadRootDir() . '/' . $this->location;
    }

    public function getWebPath()
    {
        return null === $this->location ? null : $this->getUploadDir() . '/' . $this->location;
    }

    public function getThumbPath()
    {
        return null === $this->location ? null : $this->getUploadDir() . '/mini' . $this->location;
    }

    public function getAbsoluteThumbPath()
    {
        return null === $this->location ? null : $this->getUploadRootDir() . '/mini' . $this->location;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../www/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads';
    }


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->getAbsolutePath()))
        {
            if ($file = $this->getAbsolutePath()) {

                unlink($file);
            }
            if ($fileThumb = $this->getAbsoluteThumbPath())
            {
                unlink($fileThumb);
            }
        }
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