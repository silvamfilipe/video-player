<?php

namespace App\Domain;

class Video
{
    /**
     * @var string
     */
    private $videoId;

    /**
     * @var string
     */
    private $title;

    public function __construct(string $videoId, string $title)
    {
        $this->videoId = $videoId;
        $this->title = $title;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function title(): string
    {
        return $this->title;
    }
}
