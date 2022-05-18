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
        return $this->render('adventure/adv.home.html.twig', [
        ]);
    }

    /**
     * @Route("/adventure/entrance", name="entrance", methods={"GET","HEAD"})
     */
    public function firstRoom(
        SessionInterface $session
    ): Response
    {
        $pick = $session->get('pickaxe') ?? new \App\Adventure\Item("pickaxe","../img/adventure/icon/pick_icon.png");
        $apple = $session->get('apple') ?? new \App\Adventure\Item("apple","../img/adventure/icon/apple_icon.png");
        $player = $session->get('advPlayer') ?? new \App\Adventure\Player();

        $session->set('pickaxe', $pick);
        $session->set('apple', $apple);
        $session->set('advPlayer', $player);

        //$player = $session->get('advPlayer');

        $data = [
            'title' => 'entrance',
            'player' => $player,
            'bag' => $player->showBag(),
        ];

        return $this->render('adventure/firstroom.html.twig', $data);
    }

    /**
     * @Route("/adventure/entrance", name="entrance-process", methods={"POST"})
     */
    public function entranceProcess(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $addPick = $request->request->get('addPickaxe');
        $addApple = $request->request->get('addApple');
        $entrance = $request->request->get('enterCave');

        $player = $session->get('advPlayer');
        $pickaxe = $session->get('pickaxe');
        $apple = $session->get('apple');

        if($addPick) {
            $player->addToBag($pickaxe);
            $this->addFlash("info", "Added to bag: " . $pickaxe->getItemName());
        }
        if($addApple){
            $player->addToBag($apple);
            $this->addFlash("info", "Added to bag: " . $apple->getItemName());
        }
        if($entrance){
            return $this->redirectToRoute('innercave');
        }

        return $this->redirectToRoute('entrance');
    }

    /**
     * @Route("/adventure/innercave", name="innercave")
     */
    public function secondRoom(
        SessionInterface $session
    ): Response
    {   
        $player = $session->get('advPlayer');

        $data = [
            'title' => 'entrance',
            'player' => $player,
            'bag' => $player->showBag(),
        ];

        return $this->render('adventure/adv.innercave.html.twig', $data);
    }
}
