<?php

namespace App\Services;

use App\Domain\Video;
use App\Domain\VideoProvider;

class VideoService
{
    /**
     * @var VideoProvider
     */
    private $provider;

    public function __construct(VideoProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param string $searchTerm
     * @return array
     */
    public function videoList(string $searchTerm = null): array
    {
        return $this->provider->videoList($searchTerm);
    }

    public function first(): Video
    {
        return $this->provider->first();
    }

    public function render(Video $video): string
    {
        $player = $this->provider->player();
        return $player->render($video);
    }
}
