<?php

namespace Smoovio\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="movielist")
 */
class MovieList
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * The list's title
     *
     * @Column
     */
    private $title;

    /**
     * A normalized version of the list's title. Could be used in URIs.
     *
     * @Column
     */
    private $slug;

    /**
     * @ManyToMany(targetEntity="Movie")
     * @JoinTable(name="movielist_movie",
     *   joinColumns={@JoinColumn(name="movielist_id", referencedColumnName="id")},
     *   inverseJoinColumns={@JoinColumn(name="movie_id", referencedColumnName="id")}
     * )
     */
    private $movies;

    /**
     * @param string $title
     * @param string $slug
     */
    public function __construct($title, $slug)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->movies = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Movie $movie
     */
    public function addMovie(Movie $movie)
    {
        $this->movies[$movie->getId()] = $movie;
    }

    /**
     * @return Movie[]
     */
    public function getMovies()
    {
        return $this->movies->toArray();
    }
}
