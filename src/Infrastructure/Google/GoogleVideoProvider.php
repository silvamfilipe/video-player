<?php

namespace App\Infrastructure\Google;

use App\Domain\Video;
use App\Domain\VideoPlayer;
use App\Domain\VideoProvider;
use Google_Service_YouTube_SearchResult;

final class GoogleVideoProvider implements VideoProvider
{

    /**
     * @var array|Video[]
     */
    private $videoList;

    /**
     * @var \Google_Service_YouTube
     */
    private $youTube;

    public function __construct(\Google_Service_YouTube $youTube)
    {
        $this->youTube = $youTube;
    }


    /**
     * Returns a list of videos for a specific search term
     *
     * @param string $searchTerm
     * @return array|Video[]
     */
    public function videoList(string $searchTerm = null): array
    {
        $list = $this->youTube->search->listSearch('id,snippet', array(
            'q' => '',
            'maxResults' => 10,
        ));
        $videos = [];

        /** @var Google_Service_YouTube_SearchResult $item */
        foreach ($list->getItems() as $item) {
            $video = new Video(
                $item->getId()->getVideoId(),
                $item->getSnippet()->getTitle(),
                $item->getSnippet()->getDescription()
            );
            $videos[] = $video
                ->createdBy($item->getSnippet()->getChannelTitle())
                ->withThumbnail($item->getSnippet()->getThumbnails()->getMedium()->getUrl());
        }

        $this->videoList = $videos;
        return $videos;
    }

    /**
     * It will return the first video of the last search
     *
     * @return Video
     */
    public function first(): Video
    {
        return reset($this->videoList);
    }

    /**
     * Video player for this provider
     *
     * @return VideoPlayer
     */
    public function player(): VideoPlayer
    {
        return new GoogleVideoPlayer();
    }
}
