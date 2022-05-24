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
     * @Route("/proj", name="adventure")
     */
    public function game(
        SessionInterface $session
    ): Response {
        $session->clear();
        return $this->render('adventure/adv.home.html.twig', [
        ]);
    }

    /**
     * @Route("/proj/about", name="about-proj")
     */
    public function about(): Response
    {
        return $this->render('adventure/adv.about.html.twig', [
        ]);
    }

    /**
     * @Route("/proj/setup", name="setup", methods={"GET","HEAD"})
     */
    public function setup(
        SessionInterface $session
    ): Response {
        return $this->render('adventure/adv.setup.html.twig', [
        ]);
    }
    /**
     * @Route("/proj/setup", name="setup-process", methods={"POST"})
     */
    public function setupProcess(
        Request $request,
        SessionInterface $session
    ): Response {
        $session->clear();
        $name = $request->request->get('name');
        $start = $request->request->get('start');
        $reset = $request->request->get('reset');
        $session->set('name', $name);

        if ($start) {
            return $this->redirectToRoute('entrance');
        }
        if ($reset) {
            $session->clear();
        }
        return $this->redirectToRoute('setup');
    }


    /**
     * @Route("/proj/entrance", name="entrance", methods={"GET","HEAD"})
     */
    public function entrance(
        SessionInterface $session
    ): Response {
        $game = $session->get('game') ?? new \App\Adventure\Manager();

        $pick = $session->get('pickaxe') ?? new \App\Adventure\Item("pickaxe", "../img/adventure/icon/pick_icon.png");
        $apple = $session->get('apple') ?? new \App\Adventure\Item("apple", "../img/adventure/icon/apple_icon.png");
        $diamond = $session->get('diamond3') ?? new \App\Adventure\Item("diamond", "../img/adventure/icon/diamond.png");
        $player = $session->get('advPlayer') ?? new \App\Adventure\Player();
        // $diamondCount = $session->get('diamondCount') ?? 0;

        $session->set('pickaxe', $pick);
        $session->set('apple', $apple);
        $session->set('advPlayer', $player);
        $session->set('game', $game);
        $session->set('diamond3', $diamond);

        //$player = $session->get('advPlayer');

        $data = [
            'title' => 'entrance',
            'player' => $player,
            'pick' => $pick,
            'apple' => $apple,
            'diamond' => $diamond,
            'bag' => $player->showBag(),
        ];

        return $this->render('adventure/firstroom.html.twig', $data);
    }

    /**
     * @Route("/proj/entrance", name="entrance-process", methods={"POST"})
     */
    public function entranceProcess(
        Request $request,
        SessionInterface $session
    ): Response {
        $addPick = $request->request->get('addPickaxe');
        $addApple = $request->request->get('addApple');
        $addDiamond = $request->request->get('addDiamond');
        $entrance = $request->request->get('enterCave');
        $goBack = $request->request->get('back');
        $reset = $request->request->get('reset');

        $player = $session->get('advPlayer');
        $pickaxe = $session->get('pickaxe');
        $apple = $session->get('apple');
        $diamond = $session->get('diamond3');
        $game = $session->get('game');


        if ($addDiamond) {
            $player->addToBag($diamond);
            $game->addOneDiamond();
            $this->addFlash("info", "Added to bag: " . $diamond->getItemName());
        }
        if ($addPick) {
            $player->addToBag($pickaxe);
            $this->addFlash("info", "Added to bag: " . $pickaxe->getItemName());
        }
        if ($addApple) {
            $player->addToBag($apple);
            $this->addFlash("info", "Added to bag: " . $apple->getItemName());
        }
        if ($entrance) {
            return $this->redirectToRoute('innercave');
        }
        if ($goBack) {
            return $this->redirectToRoute('jungle');
        }
        if ($reset) {
            $session->clear();
            return $this->redirectToRoute('adventure');
        }

        return $this->redirectToRoute('entrance');
    }

    /**
     * @Route("/proj/innercave", name="innercave", methods={"GET","HEAD"})
     */
    public function innercave(
        SessionInterface $session
    ): Response {
        $player = $session->get('advPlayer');
        $pickaxe = $session->get('pickaxe');

        $key = $session->get('key') ?? new \App\Adventure\Item("key", "../img/adventure/icon/nyckel.png");
        $diamond = $session->get('diamond') ?? new \App\Adventure\Item("diamond", "../img/adventure/icon/diamond.png");
        $diamond2 = $session->get('diamond2')
         ?? new \App\Adventure\Item("diamond", "../img/adventure/icon/diamond.png");
        $gold = $session->get('gold') ?? new \App\Adventure\Item("gold", "../img/adventure/icon/gold.png");

        $chest = $session->get('chest') ?? new \App\Adventure\Event($key, $diamond);
        $goblin = $session->get('goblin') ?? new \App\Adventure\Event($pickaxe, $gold);

        $session->set('chest', $chest);
        $session->set('diamond', $diamond);
        $session->set('diamond2', $diamond2);
        $session->set('gold', $gold);
        $session->set('key', $key);
        $session->set('goblin', $goblin);

        $data = [
            'title' => 'cave',
            'player' => $player,
            'diamond2' => $diamond2,
            'bag' => $player->showBag(),
        ];

        return $this->render('adventure/adv.innercave.html.twig', $data);
    }

    /**
     * @Route("/proj/innercave", name="innercave-process", methods={"POST"})
     */
    public function innercaveProcess(
        Request $request,
        SessionInterface $session
    ): Response {
        $goBack = $request->request->get('back');
        $openChest = $request->request->get('interactChest');
        $tradeGoblin = $request->request->get('interactGoblin');
        $addDiamond = $request->request->get('addDiamond');
        $enterDungeon = $request->request->get('enterDungeon');

        $player = $session->get('advPlayer');
        $chest = $session->get('chest');
        $goblin = $session->get('goblin');
        $diamond2 = $session->get('diamond2');
        $game = $session->get('game');

        if ($goBack) {
            return $this->redirectToRoute('entrance');
        }

        if ($enterDungeon) {
            return $this->redirectToRoute('dungeon');
        }

        if ($addDiamond) {
            $player->addToBag($diamond2);
            $game->addOneDiamond();
            $this->addFlash("info", "Added to bag: " . $diamond2->getItemName());
        }

        if ($tradeGoblin) {
            if ($goblin->checkEvent($player)) {
                $this->addFlash("info", "You trade your pickaxe for some gold ");
            } elseif ($goblin->eventStatus()) {
                $this->addFlash("info", "The Goblin is happy with his new pickaxe");
            } else {
                $this->addFlash("info", "The goblin wants something in return for his gold");
            }
        }

        if ($openChest) {
            if ($chest->checkEvent($player)) {
                $game->addOneDiamond();
                $this->addFlash("info", "You find a diamond in the chest ");
            } elseif ($chest->eventStatus()) {
                $this->addFlash("info", "The chest is empty");
            } else {
                $this->addFlash("info", "The chest is locked");
            }
        }

        return $this->redirectToRoute('innercave');
    }

    /**
     * @Route("/proj/jungle", name="jungle", methods={"GET","HEAD"})
     */
    public function jungle(
        SessionInterface $session
    ): Response {
        $apple = $session->get('apple');
        $gold = $session->get('gold') ?? new \App\Adventure\Item("gold", "../img/adventure/icon/gold.png");
        $key = $session->get('key') ?? new \App\Adventure\Item("key", "../img/adventure/icon/nyckel.png");
        $map = $session->get('map') ?? new \App\Adventure\Item("map", "../img/adventure/icon/map.png");
        $freedom = $session->get('freedom') ?? new \App\Adventure\Item("freedom", "../img/adventure/icon/map.png");
        $diamond = $session->get('diamond4') ?? new \App\Adventure\Item("diamond", "../img/adventure/icon/diamond.png");

        $parrot = $session->get('parrot') ?? new \App\Adventure\Event($apple, $key);
        $pirate = $session->get('pirate') ?? new \App\Adventure\Event($gold, $map);
        $jungle = $session->get('jungle') ?? new \App\Adventure\Event($map, $freedom);

        $player = $session->get('advPlayer');

        $session->set('parrot', $parrot);
        $session->set('pirate', $pirate);
        $session->set('key', $key);
        $session->set('gold', $gold);
        $session->set('jungle', $jungle);
        $session->set('diamond4', $diamond);

        $data = [
            'title' => 'jungle',
            'player' => $player,
            'diamond' => $diamond,
            'bag' => $player->showBag(),
        ];

        return $this->render('adventure/adv.jungle.html.twig', $data);
    }

    /**
     * @Route("/proj/jungle", name="jungle-process", methods={"POST"})
     */
    public function jungleProcess(
        Request $request,
        SessionInterface $session
    ): Response {
        $goBack = $request->request->get('back');
        $feedParrot = $request->request->get('interactBird');
        $interactPirate = $request->request->get('interactPirate');
        $escapeJungle = $request->request->get('escapeJungle');
        $addDiamond = $request->request->get('addDiamond');

        $player = $session->get('advPlayer');
        $parrot = $session->get('parrot');
        $pirate = $session->get('pirate');
        $jungle = $session->get('jungle');
        $game = $session->get('game');
        $diamond = $session->get('diamond4');

        if ($goBack) {
            return $this->redirectToRoute('entrance');
        }

        if ($addDiamond) {
            $player->addToBag($diamond);
            $game->addOneDiamond();
            $this->addFlash("info", "Added to bag: " . $diamond->getItemName());
        }

        if ($escapeJungle) {
            if ($jungle->checkEvent($player)) {
                $this->addFlash("info", "You navigate out of the jungle with your map! ");
                $gameTime = $game->endTimer();
                $session->set('gameTime', $gameTime);
                return $this->redirectToRoute('ending');
            } else {
                $this->addFlash("info", "You are too afraid to enter the jungle without a map!");
            }
        }

        if ($interactPirate) {
            if ($pirate->checkEvent($player)) {
                $this->addFlash("info", "You buy a map to escape the jungle with your gold! ");
            } elseif ($pirate->eventStatus()) {
                $this->addFlash("info", "The pirate bids you farewell");
            } else {
                $this->addFlash("info", "The pirate is selling a map for gold");
            }
        }

        if ($feedParrot) {
            if ($parrot->checkEvent($player)) {
                $this->addFlash("info", "The parrot ate the apple and gave you a key as thanks ");
            } elseif ($parrot->eventStatus()) {
                $this->addFlash("info", "The parrot is now full up");
            } else {
                $this->addFlash("info", "The parrot is hungry");
            }
        }

        return $this->redirectToRoute('jungle');
    }

    /**
     * @Route("/proj/dungeon", name="dungeon", methods={"GET","HEAD"})
     */
    public function dungeon(
        SessionInterface $session
    ): Response {
        $player = $session->get('advPlayer');
        $diamond = $session->get('diamond5') ?? new \App\Adventure\Item("diamond", "../img/adventure/icon/diamond.png");
        // $game = $session->get('game');

        $session->set('diamond5', $diamond);

        $data = [
            'title' => 'dungeon',
            'player' => $player,
            'diamond' => $diamond,
            'bag' => $player->showBag(),

        ];
        return $this->render('adventure/adv.dungeon.html.twig', $data);
    }

    /**
     * @Route("/proj/dungeon", name="dungeon-process", methods={"POST"})
     */
    public function dungeonProcess(
        SessionInterface $session,
        Request $request,
    ): Response {
        $addDiamond = $request->request->get('addDiamond');
        $back = $request->request->get('back');

        $game = $session->get('game');
        $diamond = $session->get('diamond5');
        $player = $session->get('advPlayer');

        if ($addDiamond) {
            $player->addToBag($diamond);
            $game->addOneDiamond();
            $this->addFlash("info", "Added to bag: " . $diamond->getItemName());
        }

        if ($back) {
            return $this->redirectToRoute('innercave');
        }

        return $this->redirectToRoute('dungeon');
    }

    /**
     * @Route("/proj/ending", name="ending", methods={"GET","HEAD"})
     */
    public function ending(
        SessionInterface $session
    ): Response {
        $game = $session->get('game');
        $name = $session->get('name');
        $gameTime = $session->get('gameTime');
        $diamonds = $game->getDiamondCount();
        $score = $game->getScore($gameTime);
        $data = [
            'title' => 'ending',
            'gametime' => $gameTime,
            'diamonds' => $diamonds,
            'name' => $name,
            'score' => $score,
        ];
        return $this->render('adventure/adv.end.html.twig', $data);
    }

    /**
     * @Route("/proj/ending", name="ending-process", methods={"POST"})
     */
    public function endingProcess(
        SessionInterface $session,
        Request $request,
    ): Response {
        $bts = $request->request->get('backToStart');
        $save = $request->request->get('save');

        if ($bts) {
            $session->clear();
            return $this->redirectToRoute('adventure');
        }
        if ($save) {
            return $this->redirectToRoute('save-score');
        }

        return $this->redirectToRoute('ending');
    }
}
