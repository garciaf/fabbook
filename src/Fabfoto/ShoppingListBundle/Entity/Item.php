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
     * @var integer $id
     *
     * @ORM\Column(name="remote_id", type="string", length=26)
     */
    private $remoteId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    
    public function __construct(){
        $this->setRemoteId(uniqid("",true));
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
     * Set remoteId
     *
     * @param string $remoteId
     */
    public function setRemoteId($remoteId)
    {
        $this->remoteId = $remoteId;
    }

    /**
     * Get remoteId
     *
     * @return string 
     */
    public function getRemoteId()
    {
        return $this->remoteId;
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