<?php

namespace Smoovio\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @Entity(repositoryClass="Smoovio\Bundle\CoreBundle\Repository\GenreRepository")
 * @ExclusionPolicy("ALL")
 * @XmlRoot("genre")
 * 
 * @UniqueEntity("slug")
 */
class Genre
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Expose
     * @XmlAttribute
     */
    private $id;

    /**
     * @Column
     * @Expose
     *
     * @NotBlank
     * @Length(min=5, max=100)
     */
    private $title;

    /**
     * @Column
     * @Expose
     *
     * @NotBlank
     * @Length(min=5, max=100)
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
