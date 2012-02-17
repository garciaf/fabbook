<?php

namespace Fabfoto\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fabfoto\GalleryBundle\Entity\Author
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Author
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;
    
    /**
     * @var string $firstname
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $googleLink
     *
     * @ORM\Column(name="googleLink", type="string", length=255)
     */
    private $googleLink;

    /**
     * @var string $facebookLink
     *
     * @ORM\Column(name="facebookLink", type="string", length=255)
     */
    private $facebookLink;

    /**
     * @var string $gitHubLink
     *
     * @ORM\Column(name="gitHubLink", type="string", length=255)
     */
    private $gitHubLink;

    /**
     * @var string $linkedLink
     *
     * @ORM\Column(name="linkedLink", type="string", length=255)
     */
    private $linkedLink;

    /**
     * @var string $twitterLink
     *
     * @ORM\Column(name="twitterLink", type="string", length=255)
     */
    private $twitterLink;

    /**
     * @var string $mail
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;


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
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set googleLink
     *
     * @param string $googleLink
     */
    public function setGoogleLink($googleLink)
    {
        $this->googleLink = $googleLink;
    }

    /**
     * Get googleLink
     *
     * @return string 
     */
    public function getGoogleLink()
    {
        return $this->googleLink;
    }

    /**
     * Set facebookLink
     *
     * @param string $facebookLink
     */
    public function setFacebookLink($facebookLink)
    {
        $this->facebookLink = $facebookLink;
    }

    /**
     * Get facebookLink
     *
     * @return string 
     */
    public function getFacebookLink()
    {
        return $this->facebookLink;
    }

    /**
     * Set gitHubLink
     *
     * @param string $gitHubLink
     */
    public function setGitHubLink($gitHubLink)
    {
        $this->gitHubLink = $gitHubLink;
    }

    /**
     * Get gitHubLink
     *
     * @return string 
     */
    public function getGitHubLink()
    {
        return $this->gitHubLink;
    }

    /**
     * Set linkedLink
     *
     * @param string $linkedLink
     */
    public function setLinkedLink($linkedLink)
    {
        $this->linkedLink = $linkedLink;
    }

    /**
     * Get linkedLink
     *
     * @return string 
     */
    public function getLinkedLink()
    {
        return $this->linkedLink;
    }

    /**
     * Set twitterLink
     *
     * @param string $twitterLink
     */
    public function setTwitterLink($twitterLink)
    {
        $this->twitterLink = $twitterLink;
    }

    /**
     * Get twitterLink
     *
     * @return string 
     */
    public function getTwitterLink()
    {
        return $this->twitterLink;
    }

    /**
     * Set mail
     *
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}