<?php

namespace Smoovio\Bundle\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
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
     *
     * @QueryParam(
     *   name="q",
     *   requirements="[a-zA-Z0-9]+",
     *   nullable=true,
     *   description="The term to search."
     * )
     * 
     * @QueryParam(
     *   name="sort",
     *   requirements="asc|desc",
     *   default="asc",
     *   strict=true,
     *   description="The sort order (asc or desc)."
     * )
     *
     * @QueryParam(
     *   name="limit",
     *   requirements="[0-9]+",
     *   default="20",
     *   strict=true,
     *   description="The number of movies to fetch."
     * )
     *
     * @QueryParam(
     *   name="offset",
     *   requirements="[0-9]+",
     *   default="0",
     *   strict=true,
     *   description="The starting offset."
     * )
     *
     * @ApiDoc(
     *  section="Movies",
     *  resource=true,
     *  description="Get the list of all movies.",
     *  statusCodes={
     *    200="Returned if successful"
     *  }
     * )
     */
    public function listMoviesAction(ParamFetcherInterface $paramFetcher)
    {
        $movies = new Movies($this->get('smoovio_core.repository.movie')->search(
            $paramFetcher->get('q'),
            $paramFetcher->get('sort'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
        ));

        return $this->get('smoovio_api.movies_view_handler')->handleRepresentation($movies);
    }

    /**
     * @Get("/{id}", name="api_get_movie", requirements={"id"="\d+"})
     * @ParamConverter("movie", options={ "repository_method"="getMovie" })
     */
    public function getMovieAction(Movie $movie)
    {
        return $movie;
    }
}
