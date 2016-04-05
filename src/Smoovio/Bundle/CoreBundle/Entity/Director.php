<?php

namespace Smoovio\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @Entity
 */
class Director extends Person
{
    /**
     * @ManyToMany(targetEntity="Movie", inversedBy="directors", fetch="EXTRA_LAZY")
     * @JoinTable(name="movie_director",
     *   joinColumns={@JoinColumn(name="director_id", referencedColumnName="id")},
     *   inverseJoinColumns={@JoinColumn(name="movie_id", referencedColumnName="id")}
     * )
     */
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    /**
     * @param Movie $m
     */
    public function addMovie(Movie $m)
    {
        if (!$this->movies->contains($m)) {
            $this->movies->add($m);
            $m->addDirector($this);
        }
    }

    /**
     * @return array
     */
    public function getMovies()
    {
        return $this->movies->toArray();
    }
}
