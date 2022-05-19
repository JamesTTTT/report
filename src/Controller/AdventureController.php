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
    public function entrance(
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
        $goBack = $request->request->get('back');
        $reset = $request->request->get('reset');

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
        if($goBack){
            return $this->redirectToRoute('jungle');
        }
        if($reset){
            $session->clear();;
        }

        return $this->redirectToRoute('entrance');
    }

    /**
     * @Route("/adventure/innercave", name="innercave", methods={"GET","HEAD"})
     */
    public function innercave(
        SessionInterface $session
    ): Response
    {   
        $player = $session->get('advPlayer');
        $pickaxe = $session->get('pickaxe');

        $key = $session->get('key') ?? new \App\Adventure\Item("key","../img/adventure/icon/nyckel.png");
        $diamond = $session->get('diamond') ?? new \App\Adventure\Item("diamond","../img/adventure/icon/diamond.png");
        $gold = $session->get('gold') ?? new \App\Adventure\Item("gold","../img/adventure/icon/gold.png");
        $chest = $session->get('chest') ?? new \App\Adventure\Event($key, $diamond);
        $goblin = $session->get('goblin') ?? new \App\Adventure\Event($pickaxe, $gold);

        $session->set('chest', $chest);
        $session->set('diamond', $diamond);
        $session->set('gold', $gold);
        $session->set('key', $key);
        $session->set('goblin', $goblin);

        $data = [
            'title' => 'cave',
            'player' => $player,
            'bag' => $player->showBag(),
        ];

        return $this->render('adventure/adv.innercave.html.twig', $data);
    }

    /**
     * @Route("/adventure/innercave", name="innercave-process", methods={"POST"})
     */
    public function innercaveProcess(
        Request $request,
        SessionInterface $session
    ): Response
    {   
        $goBack = $request->request->get('back');
        $openChest = $request->request->get('interactChest');
        $tradeGoblin = $request->request->get('interactGoblin');

        $player = $session->get('advPlayer');
        $chest = $session->get('chest');
        $goblin = $session->get('goblin');

        if($goBack){
            return $this->redirectToRoute('entrance');
        }

        if($tradeGoblin) {
            if($goblin->checkEvent($player)) {
                $this->addFlash("info", "You trade your pickaxe for some gold ");
            }
            elseif($goblin->eventStatus()){
                $this->addFlash("info", "The Goblin is happy with his new pickaxe");
            }
            else {
                $this->addFlash("info", "The goblin wants something in return for his gold");
            }
        }

        if($openChest) {
            if($chest->checkEvent($player)) {
                $this->addFlash("info", "You find a diamond in the chest ");
            }
            elseif($chest->eventStatus()){
                $this->addFlash("info", "The chest is empty");
            }
            else {
                $this->addFlash("info", "The chest is locked");
            }
        }

        return $this->redirectToRoute('innercave');
    }

    /**
     * @Route("/adventure/jungle", name="jungle", methods={"GET","HEAD"})
     */
    public function jungle(
        SessionInterface $session
    ): Response
    {      
        $apple = $session->get('apple');
        $diamond = $session->get('diamond');
        $gold = $session->get('gold') ?? new \App\Adventure\Item("gold","../img/adventure/icon/gold.png");
        $key = $session->get('key') ?? new \App\Adventure\Item("key","../img/adventure/icon/nyckel.png");
        $map = $session->get('map') ?? new \App\Adventure\Item("map","../img/adventure/icon/map.png");
        $parrot = $session->get('parrot') ?? new \App\Adventure\Event($apple, $key);
        $pirate = $session->get('pirate') ?? new \App\Adventure\Event($gold, $map);
        $jungle = $session->get('jungle') ?? new \App\Adventure\Event($map, $diamond);
        $player = $session->get('advPlayer');

        $session->set('parrot', $parrot);
        $session->set('pirate', $pirate);
        $session->set('key', $key);
        $session->set('jungle', $jungle);

        $data = [
            'title' => 'jungle',
            'player' => $player,
            'bag' => $player->showBag(),
        ];

        return $this->render('adventure/adv.jungle.html.twig', $data);
    }

    /**
     * @Route("/adventure/jungle", name="jungle-process", methods={"POST"})
     */
    public function jungleProcess(
        Request $request,
        SessionInterface $session
    ): Response
    {   
        $goBack = $request->request->get('back');
        $feedParrot = $request->request->get('interactBird');
        $interactPirate = $request->request->get('interactPirate');
        $escapeJungle = $request->request->get('escapeJungle');

        $player = $session->get('advPlayer');
        $parrot = $session->get('parrot');
        $pirate = $session->get('pirate');
        $jungle = $session->get('jungle');

        if($goBack){
            return $this->redirectToRoute('entrance');
        }

        if($escapeJungle) {
            if($jungle->checkEvent($player)) {
                $this->addFlash("info", "You navigate out of the jungle with your map! ");
                return $this->redirectToRoute('ending');
            }
            else {
                $this->addFlash("info", "You are too afraid to enter the jungle without a map!");
            }

        }

        if($interactPirate) {
            if($pirate->checkEvent($player)) {
                $this->addFlash("info", "You buy a map to escape the jungle with your gold! ");
            }
            elseif($pirate->eventStatus()){
                $this->addFlash("info", "The pirate bids you farewell");
            }
            else {
                $this->addFlash("info", "The pirate is selling a map for gold");
            }
        }

        if($feedParrot) {
            if($parrot->checkEvent($player)) {
                $this->addFlash("info", "The parrot ate the apple and gave you a key as thanks ");
            }
            elseif($parrot->eventStatus()){
                $this->addFlash("info", "The parrot is now full up");
            }
            else {
                $this->addFlash("info", "The parrot is hungry");
            }
        }
        return $this->redirectToRoute('jungle');
    }

    /**
     * @Route("/adventure/ending", name="ending")
     */
    public function ending(): Response
    {
        return $this->render('adventure/adv.end.html.twig', [
        ]);
    }

}