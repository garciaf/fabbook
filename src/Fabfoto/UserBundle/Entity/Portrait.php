<?php

namespace Fabfoto\UserBundle\Entity;

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
class Portrait
{

    public function __toString()
    {
        return (string) $this->id;
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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


    public function getAbsolutePath()
    {
        return null === $this->location ? null : $this->getUploadRootDir() . '/' . $this->location;
    }

    public function getWebPath()
    {
        return null === $this->location ? null : $this->getUploadDir() . '/' . $this->location;
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
        }
    }

}