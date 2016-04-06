<?php

namespace Smoovio\Bundle\ApiBundle\Representation;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @XmlRoot("movies")
 */
class Movies implements RepresentationInterface
{
    private $meta;

    /**
     * @Type("array<Smoovio\Bundle\CoreBundle\Entity\Movie>")
     * @XmlList(inline=true, entry="movie")
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function addMeta($key, $value)
    {
        $this->meta[$key] = $value;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMeta($key)
    {
        return $this->meta[$key];
    }
}
