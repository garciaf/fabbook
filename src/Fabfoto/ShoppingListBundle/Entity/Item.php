<?php

namespace Fabfoto\ShoppingListBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fabfoto\ShoppingListBundle\Entity\Item
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fabfoto\ShoppingListBundle\Entity\ItemRepository")
 */
class Item
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
     * @var datetime $_lastChange
     *
     * @ORM\Column(name="_lastChange", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $_lastChange;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean $checked
     *
     * @ORM\Column(name="checked", type="boolean")
     */
    private $checked;

    /**
     * @var boolean $favorite
     *
     * @ORM\Column(name="favorite", type="boolean")
     */
    private $favorite;

    /**
     * @var boolean $onlist
     *
     * @ORM\Column(name="onlist", type="boolean")
     */
    private $onlist;

    /**
     * @var integer $quantity
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

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
     * Set _lastChange
     *
     * @param datetime $lastChange
     */
    public function setLastChange($lastChange)
    {
        $this->_lastChange = $lastChange;
    }

    /**
     * Get _lastChange
     *
     * @return datetime 
     */
    public function getLastChange()
    {
        return $this->_lastChange;
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
     * Set checked
     *
     * @param boolean $checked
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
    }

    /**
     * Get checked
     *
     * @return boolean 
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set favorite
     *
     * @param boolean $favorite
     */
    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;
    }

    /**
     * Get favorite
     *
     * @return boolean 
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * Set onlist
     *
     * @param boolean $onlist
     */
    public function setOnlist($onlist)
    {
        $this->onlist = $onlist;
    }

    /**
     * Get onlist
     *
     * @return boolean 
     */
    public function getOnlist()
    {
        return $this->onlist;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    
    public function get_lastChange(){
        return $this->_lastChange;
    }
}