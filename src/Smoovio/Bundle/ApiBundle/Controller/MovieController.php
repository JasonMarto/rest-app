<?php

namespace Smoovio\Bundle\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Smoovio\Bundle\ApiBundle\Representation\Movies;
use Smoovio\Bundle\CoreBundle\Entity\Movie;

/**
 * @Route("/movies")
 */
class MovieController extends FOSRestController
{
    /**
     * @Get("", name="api_list_movies")
     */
    public function listMoviesAction()
    {
        return new Movies($this->get('smoovio_core.repository.movie')->getMovies());
    }

    /**
     * @Get("/{id}", name="api_get_movies", requirements={"id"="\d+"})
     * @ParamConverter("movie", options={ "repository_method"="getMovie" })
     */
    public function getMovieAction(Movie $movie)
    {
        return $movie;
    }
}
