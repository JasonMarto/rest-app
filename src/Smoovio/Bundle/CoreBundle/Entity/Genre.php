<?php

namespace Smoovio\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * @Entity(repositoryClass="Smoovio\Bundle\CoreBundle\Repository\GenreRepository")
 */
class Genre
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column
     */
    private $title;

    /**
     * @Column
     */
    private $slug;

    /**
     * @param string $title
     * @param string $slug
     */
    public function __construct($title, $slug)
    {
        $this->title = $title;
        $this->slug = $slug;
    }

    public function update(Genre $genre)
    {
        $this->slug = $genre->slug;
        $this->title = $genre->title;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
