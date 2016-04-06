<?php

namespace Smoovio\Bundle\ApiBundle\Representation;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlKeyValuePairs;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;
use Pagerfanta\Pagerfanta;

/**
 * @XmlRoot("movies")
 * @ExclusionPolicy("ALL")
 */
class Movies implements RepresentationInterface
{
    /**
     * @XmlKeyValuePairs
     * @Expose
     */
    private $meta;

    /**
     * @Type("array<Smoovio\Bundle\CoreBundle\Entity\Movie>")
     * @XmlList(inline=true, entry="movie")
     * @Expose
     */
    private $movies;

    private $data;

    public function __construct(Pagerfanta $data)
    {
        $this->data = $data;
        $this->movies = iterator_to_array($data);

        $this->addMeta('limit', $data->getMaxPerPage());
        $this->addMeta('current_items', count($this->data));
        $this->addMeta('total_items', $data->getNbResults());
        $this->addMeta('offset', $data->getCurrentPageOffsetStart());
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
