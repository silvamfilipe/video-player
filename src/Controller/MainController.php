<?php

namespace App\Controller;

use App\Services\VideoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @var VideoService
     */
    private $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    /**
     * @Route("/")
     */
    public function home()
    {
        return $this->render('home.html.twig', [
            'videoList' => $this->videoService->videoList(),
            'player' => $this->videoService->render($this->videoService->first())
        ]);
    }
}