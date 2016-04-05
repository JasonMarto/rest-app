<?php

namespace Smoovio\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @Entity
 */
class Role
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @Column(nullable=true) */
    private $character;

    /**
     * @ManyToOne(targetEntity="Movie", inversedBy="roles", fetch="EAGER")
     */
    private $movie;

    /**
     * @ManyToOne(targetEntity="Actor", fetch="EAGER")
     */
    private $actor;

    /**
     * @param Movie $movie
     * @param Actor $actor
     * @param string $character
     */
    public function __construct(Movie $movie, Actor $actor, $character)
    {
        $this->movie = $movie;
        $this->actor = $actor;
        $this->character = $character;
    }

    /**
     * @return Actor
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * @return string
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->movie;
    }
}
