<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdventureController extends AbstractController
{
    /**
     * @Route("/adventure", name="adventure")
     */
    public function game(): Response
    {
        // session_destroy();
        return $this->render('adventure/adv.home.html.twig', [
        ]);
    }

    /**
     * @Route("/adventure/entrance", name="entrance", methods={"GET","POST"})
     */
    public function firstRoom(
        Request $request,
        SessionInterface $session
    ): Response
    {
        
        return $this->render('adventure/firstroom.html.twig', [
        ]);
    }
}
