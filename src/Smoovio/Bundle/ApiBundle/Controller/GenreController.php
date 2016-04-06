<?php

namespace Smoovio\Bundle\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Smoovio\Bundle\CoreBundle\Entity\Genre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * @Route("/genres")
 */
class GenreController extends FOSRestController
{
    /**
     * @Get("", name="api_list_genres")
     */
    public function listGenresAction()
    {
        return $this->get('smoovio_core.repository.genre')->getGenres();
    }

    /**
     * @Get("/{id}", name="api_get_genre", requirements={"id"="\d+"})
     */
    public function getGenreAction(Genre $genre)
    {
        return $genre;
    }

    /**
     * @Post("", name="api_create_genre")
     * @ParamConverter("genre", converter="fos_rest.request_body")
     */
    public function createGenreAction(Genre $genre, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($genre);
        $em->flush();

        return $this->view(null, Response::HTTP_CREATED, [
            'Location' => $this->generateUrl('api_get_genre', ['id' => $genre->getId()], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
    }
}
