<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ScoreboardRepository;
use App\Entity\Scoreboard;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class ScoreboardController extends AbstractController
{
    /**
     * @Route("/adventure/scoreboard", name="scoreboard")
     */
    public function scoreboard(
        ScoreboardRepository $scoreBoardRepository
    ): Response
    {
        $scoreboards = $scoreBoardRepository->findAll();
        $data = [
            'title' => 'view_score',
            'scoreboard' => $scoreboards,
        ];
        return $this->render('adventure/scoreboard.html.twig', $data);
    }

    /**
     * @Route("/adventure/savescore", name="save-score", methods={"GET","HEAD"})
     */
    public function saveScore(
        ManagerRegistry $doctrine,
        SessionInterface $session,
    ): Response
    {
        $entityManager = $doctrine->getManager();
        $scoreboard = new Scoreboard;
        $game = $session->get('game');
        $name = $session->get('name');
        $gameTime = $session->get('gameTime');
        $diamonds = $game->getDiamondCount();
        $score = $game->getScore($gameTime);


        $scoreboard->setName($name);
        $scoreboard->setScore($score);
        $scoreboard->setTime($gameTime);
        $scoreboard->setDiamonds($diamonds);

        $entityManager->persist($scoreboard);
        $entityManager->flush();
        return $this->render('adventure/save_score.html.twig', [
        ]);
    }
}
