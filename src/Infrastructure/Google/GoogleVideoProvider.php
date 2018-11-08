<?php

namespace App\Infrastructure\Google;

use App\Domain\Video;
use App\Domain\VideoPlayer;
use App\Domain\VideoProvider;
use Google_Service_YouTube_SearchResult;

class GoogleVideoProvider implements VideoProvider
{
    /**
     * @var \Google_Service_YouTube
     */
    private $youTube;

    private $videos;

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
        $searchResult = $this->search($searchTerm);
        $videos = $this->loadVideos($searchResult);
        $this->videos = $videos;
        return $videos;
    }

    /**
     * It will return the first video of the last search
     *
     * @return Video
     */
    public function first(): Video
    {
        return reset($this->videos);
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

    /**
     * @param $item
     * @return Video
     */
    private function createVideoFrom(Google_Service_YouTube_SearchResult $item): Video
    {
        return (new Video(
            $item->getId()->getVideoId(),
            $item->getSnippet()->getTitle(),
            $item->getSnippet()->getDescription()
            ))
            ->createdBy($item->getSnippet()->getChannelTitle())
            ->withThumbnail(
                $item->getSnippet()->getThumbnails()->getMedium()->getUrl()
            );
    }

    /**
     * @param $searchResult
     * @return array
     */
    private function loadVideos(\Google_Service_YouTube_SearchListResponse$searchResult): array
    {
        $videos = [];

        /** @var Google_Service_YouTube_SearchResult $item */
        foreach ($searchResult->getItems() as $item) {
            $video = $this->createVideoFrom($item);
            $videos[] = $video;
        }
        return $videos;
    }

    /**
     * @param string $searchTerm
     * @return \Google_Service_YouTube_SearchListResponse
     */
    private function search(string $searchTerm = null): \Google_Service_YouTube_SearchListResponse
    {
        $searchResult = $this->youTube->search->listSearch(
            'id,snippet',
            [
                'q' => $searchTerm,
                'maxResults' => 10
            ]
        );
        return $searchResult;
    }
}
