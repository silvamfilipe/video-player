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
    private $videos;

    public function __construct(VideoService $videos)
    {
        $this->videos = $videos;
    }

    /**
     * @Route("/")
     */
    public function home()
    {
        $videos = $this->videos->videoList();
        $player = $this->videos->render($this->videos->first());
        return $this->render(
            'home.html.twig',
            compact('videos', 'player')
        );
    }
}