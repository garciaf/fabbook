<?php

namespace Fabfoto\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Vote as BaseVote;
use Fabfoto\GalleryBundle\Entity\Comment as Comment;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\CommentBundle\Model\SignedVoteInterface;
use FOS\CommentBundle\Model\VotableCommentInterface;
/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Vote extends BaseVote implements SignedVoteInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Comment of this vote
     *
     * @var Comment
     * @ORM\ManyToOne(targetEntity="Fabfoto\GalleryBundle\Entity\Comment")
     */
    protected $comment;

    /**
     * Author of the vote
     *
     * @ORM\ManyToOne(targetEntity="Fabfoto\UserBundle\Entity\User")
     * @var User
     */
    protected $voter;

    /**
     * Sets the owner of the vote
     *
     * @param string $user
     */
    public function setVoter(UserInterface $voter)
    {
        $this->voter = $voter;
    }

    /**
     * Gets the owner of the vote
     *
     * @return UserInterface
     */
    public function getVoter()
    {
        return $this->voter;
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
     * Set comment
     *
     * @param  Fabfoto\GalleryBundle\Entity\Comment $comment
     * @return Vote
     */
    public function setComment(VotableCommentInterface $comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return Fabfoto\GalleryBundle\Entity\Comment
     */
    public function getComment()
    {
        return $this->comment;
    }
}
