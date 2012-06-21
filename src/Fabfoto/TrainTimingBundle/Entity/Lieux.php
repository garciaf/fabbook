<?php

namespace Fabfoto\TrainTimingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\Accessor;

/**
 * Fabfoto\TrainTimingBundle\Entity\Gare
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Lieux
{
    /**
     * @var integer $id
     * @Type("integer")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     * @Type("string")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float $long
     * @Type("double")
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var float $lat
     * @Type("double")
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var integer $stationType
     * @Type("Category")
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

    /**
     * Set longitude
     *
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set category
     *
     * @param Fabfoto\TrainTimingBundle\Entity\Category $category
     */
    public function setCategory(\Fabfoto\TrainTimingBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Fabfoto\TrainTimingBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}