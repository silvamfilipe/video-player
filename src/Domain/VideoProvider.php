<?php

namespace App\Domain;

interface VideoProvider
{

    /**
     * Returns a list of videos for a specific search term
     *
     * @param string $searchTerm
     * @return array|Video[]
     */
    public function videoList(string $searchTerm = null): array;

    /**
     * It will return the first video of the last search
     *
     * @return Video
     */
    public function first(): Video;

    /**
     * Video player for this provider
     *
     * @return VideoPlayer
     */
    public function player(): VideoPlayer;
}
