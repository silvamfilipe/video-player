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

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $author;

    /**
     * @var string
     */
    private $thumbnail;

    public function __construct(string $videoId, string $title, string $description = null)
    {
        $this->videoId = $videoId;
        $this->title = $title;
        $this->description = $description;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function createdBy(string $author): Video
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return null|string
     */
    public function author(): ?string
    {
        return $this->author;
    }

    public function thumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     * @return Video
     */
    public function withThumbnail(string $thumbnail): Video
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }


}
