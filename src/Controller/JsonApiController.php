<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonApiController extends AbstractController
{
    /**
     * @Route("card/api/deck", name="deck-api", methods={"GET"}))
     */
    public function apiDeck(): Response
    {
        $deck = new \App\Card\Deck();


        $data = [
            'title' => 'Deck',
            'deck' => $deck->showCards(),
        ];

        $response = new JsonResponse([ $data ]);

        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return $response;
    }
}
