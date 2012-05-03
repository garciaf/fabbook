<?php

namespace Fabfoto\GalleryBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fabfoto\GalleryBundle\Entity\Cover
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Cover extends AbstractImage 
{

    public function __toString()
    {
        return $this->getName();
    }
    /**
     * @var string $location
     * @Assert\File(maxSize="1M")
     */
    
    private $path;
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
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


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->path) {
            // do whatever you want to generate a unique name
            $this->location = uniqid().'.'.$this->path->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->path) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->path->move($this->getUploadRootDir(), $this->location);
        unset($this->path);
    }
    
        /**
     * Set location
     *
     * @param string $location
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
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
}