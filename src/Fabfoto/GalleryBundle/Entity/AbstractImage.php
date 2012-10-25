<?php
namespace Fabfoto\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 
use Fabfoto\GalleryBundle\Uploader\ImageInterface as ImageInterface;
/**
 * Test\TestBundle\Entity\AbstractGMapEntity
 *
 * @author garciaf
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class AbstractImage implements ImageInterface
{
    /**
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    protected $location;
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

    public function getWebPath()
    {
        return null === $this->getLocation() ? null : '/'.$this->getUploadDir() . '/' . $this->getLocation();
    }

    public function getThumbPath()
    {
        return null === $this->getLocation() ? null : $this->getUploadDir() . '/mini' . $this->getLocation();
    }

    public function getAbsoluteThumbPath()
    {
        return null === $this->getLocation() ? null : $this->getUploadRootDir() . '/mini' . $this->getLocation();
    }

    public function getAbsolutePath()
    {
        return null === $this->getLocation() ? null : $this->getUploadRootDir() . '/' . $this->getLocation();
    }

    public function getFilterPath()
    {
        return "/".$this->getWebPath();
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

    public function getFileExtension()
    {
        return pathinfo($this->getLocation(), PATHINFO_EXTENSION);
    }

}
