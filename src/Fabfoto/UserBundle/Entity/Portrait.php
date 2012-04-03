<?php

namespace Fabfoto\UserBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use \Fabfoto\GalleryBundle\Entity\Picture as Picture;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var string $location
     * @Assert\File(maxSize="6000000")
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
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;
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


    /**
     * Set user
     *
     * @param Fabfoto\UserBundle\Entity\User $user
     */
    public function setUser(\Fabfoto\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Fabfoto\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
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
}