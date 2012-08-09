<?php

namespace Fabfoto\UserBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use \Fabfoto\GalleryBundle\Entity\Picture as Picture;
use Fabfoto\GalleryBundle\Uploader\AbstractImage as AbstractImage;
use Fabfoto\UserBundle\Entity\User as User;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Fabfoto\GalleryBundle\Entity\Picture
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Portrait extends AbstractImage
{

    public function __toString()
    {
        return (string) $this->id;
    }
    /**
     * @var string $location
     * @Assert\File(
    maxSize="1M",
    mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
    )
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

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->getAbsolutePath())) {
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
    public function setUser(User $user)
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
