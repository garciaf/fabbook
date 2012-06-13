<?php

namespace Fabfoto\TrainTimingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fabfoto\TrainTimingBundle\Entity\Gare
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Gare
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $UID
     *
     * @ORM\Column(name="UID", type="integer")
     */
    private $UID;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $codeDDG
     *
     * @ORM\Column(name="codeDDG", type="string", length=30)
     */
    private $codeDDG;

    /**
     * @var string $codeQLT
     *
     * @ORM\Column(name="codeQLT", type="string", length=30)
     */
    private $codeQLT;

    /**
     * @var string $codeUIC
     *
     * @ORM\Column(name="codeUIC", type="string", length=30)
     */
    private $codeUIC;

    /**
     * @var float $x
     *
     * @ORM\Column(name="x", type="float")
     */
    private $x;

    /**
     * @var float $y
     *
     * @ORM\Column(name="y", type="float")
     */
    private $y;

    /**
     * @var integer $stationType
     *
     * @ORM\Column(name="stationType", type="integer")
     */
    private $stationType;

    /**
     * @var string $stationCat
     *
     * @ORM\Column(name="stationCat", type="string", length=255)
     */
    private $stationCat;


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
     * Set UID
     *
     * @param integer $uID
     */
    public function setUID($uID)
    {
        $this->UID = $uID;
    }

    /**
     * Get UID
     *
     * @return integer 
     */
    public function getUID()
    {
        return $this->UID;
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
     * Set codeDDG
     *
     * @param string $codeDDG
     */
    public function setCodeDDG($codeDDG)
    {
        $this->codeDDG = $codeDDG;
    }

    /**
     * Get codeDDG
     *
     * @return string 
     */
    public function getCodeDDG()
    {
        return $this->codeDDG;
    }

    /**
     * Set codeQLT
     *
     * @param string $codeQLT
     */
    public function setCodeQLT($codeQLT)
    {
        $this->codeQLT = $codeQLT;
    }

    /**
     * Get codeQLT
     *
     * @return string 
     */
    public function getCodeQLT()
    {
        return $this->codeQLT;
    }

    /**
     * Set codeUIC
     *
     * @param string $codeUIC
     */
    public function setCodeUIC($codeUIC)
    {
        $this->codeUIC = $codeUIC;
    }

    /**
     * Get codeUIC
     *
     * @return string 
     */
    public function getCodeUIC()
    {
        return $this->codeUIC;
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
     * Set stationCat
     *
     * @param string $stationCat
     */
    public function setStationCat($stationCat)
    {
        $this->stationCat = $stationCat;
    }

    /**
     * Get stationCat
     *
     * @return string 
     */
    public function getStationCat()
    {
        return $this->stationCat;
    }
}