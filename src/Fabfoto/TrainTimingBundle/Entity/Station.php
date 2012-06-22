<?php

namespace Fabfoto\TrainTimingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\Accessor;

/**
 * Fabfoto\TrainTimingBundle\Entity\Station
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fabfoto\TrainTimingBundle\Entity\StationRepository")
 */
class Station
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
     * @var string $uid
     * @Type("string")
     * @ORM\Column(name="uid", type="string", length=255)
     */
    private $uid;

    /**
     * @var integer $stationType
     * @Type("integer")
     * @ORM\Column(name="stationType", type="integer")
     */
    private $stationType;

    /**
     * @var float $x
     * @Type("double")
     * @ORM\Column(name="x", type="float")
     */
    private $x;

    /**
     * @var float $y
     * @Type("double")
     * @ORM\Column(name="y", type="float")
     */
    private $y;

    /**
     * @var string $codeDDG
     * @Type("string")
     * @ORM\Column(name="codeDDG", type="string", length=255)
     */
    private $codeDdg;

    
    public function __construct(array $object)
    {
        $this->x = $object['x'];
        $this->y = $object['y'];
        $this->name =$object['name'];
        $this->codeDdg = $object['codeDDG'];
        $this->uid = $object['UID'];
        $this->stationType = $object['stationType'];
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
     * Set uid
     *
     * @param string $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * Get uid
     *
     * @return string 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set stationType
     *
     * @param integer $stationType
     */
    public function setStationType($stationType)
    {
        $this->stationType = $stationType;
    }

    /**
     * Get stationType
     *
     * @return integer 
     */
    public function getStationType()
    {
        return $this->stationType;
    }

    /**
     * Set x
     *
     * @param float $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * Get x
     *
     * @return float 
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param float $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * Get y
     *
     * @return float 
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set codeDdg
     *
     * @param string $codeDdg
     */
    public function setCodeDdg($codeDdg)
    {
        $this->codeDdg = $codeDdg;
    }

    /**
     * Get codeDdg
     *
     * @return string 
     */
    public function getCodeDdg()
    {
        return $this->codeDdg;
    }
}