<?php

namespace App\Controller;

use App\Services\VideoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(Request $request)
    {
        $pattern = $request->query->get('pattern', '');
        $results = $request->query->get('results', '10');
        $videos = $this->videos->videoList($pattern);
        $player = $this->videos->render($this->videos->first());
        return $this->render(
            'home.html.twig',
            compact('videos', 'player', 'pattern', 'results')
        );
    }
}