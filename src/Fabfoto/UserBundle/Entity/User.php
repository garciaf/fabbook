<?php

namespace Fabfoto\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Fabfoto\UserBundle\Entity\Portrait as Portrait;
/**
 * Fabfoto\UserBundle\Entity\User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Fabfoto\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @Gedmo\Slug(fields={"firstname", "name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

     /**
     * @var string $firstname
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity = "Portrait",mappedBy="user")
     */
    private $portrait;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string $googleLink
     *
     * @ORM\Column(name="googleLink", type="string", length=255, nullable=true)
     */
    private $googleLink;

    /**
     * @var string $facebookLink
     *
     * @ORM\Column(name="facebookLink", type="string", length=255, nullable=true)
     */
    private $facebookLink;

    /**
     * @var string $gitHubLink
     *
     * @ORM\Column(name="gitHubLink", type="string", length=255, nullable=true)
     */
    private $gitHubLink;

    /**
     * @var string $linkedLink
     *
     * @ORM\Column(name="linkedLink", type="string", length=255, nullable=true)
     */
    private $linkedLink;

    /**
     * @var string $twitterLink
     *
     * @ORM\Column(name="twitterLink", type="string", length=255, nullable=true)
     */
    private $twitterLink;

    /**
     * @var string $viadeoLink
     *
     * @ORM\Column(name="viadeoLink", type="string", length=255, nullable=true)
     */
    private $viadeoLink;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=true)
     */
    private $mobile;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function __toString()
    {
        return $this->getFirstname().' '.$this->getName();
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
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

    /**
     * Set portrait
     *
     * @param Fabfoto\UserBundle\Entity\Portrait $portrait
     */
    public function setPortrait(\Fabfoto\UserBundle\Entity\Portrait $portrait)
    {
        $this->portrait = $portrait;
    }

    /**
     * Get portrait
     *
     * @return Fabfoto\UserBundle\Entity\Portrait
     */
    public function getPortrait()
    {
        return $this->portrait;
    }
    public function __construct()
    {
        parent::__construct();
        $this->portrait = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addRole('ROLE_USER');
    }

    /**
     * Add portrait
     *
     * @param Fabfoto\UserBundle\Entity\Portrait $portrait
     */
    public function addPortrait(\Fabfoto\UserBundle\Entity\Portrait $portrait)
    {
        $this->portrait[] = $portrait;
    }

    /**
     * Set viadeoLink
     *
     * @param string $viadeoLink
     */
    public function setViadeoLink($viadeoLink)
    {
        $this->viadeoLink = $viadeoLink;
    }

    /**
     * Get viadeoLink
     *
     * @return string
     */
    public function getViadeoLink()
    {
        return $this->viadeoLink;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
