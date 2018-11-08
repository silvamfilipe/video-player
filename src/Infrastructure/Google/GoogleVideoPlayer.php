<?php

namespace App\Infrastructure\Google;


use App\Domain\Video;
use App\Domain\VideoPlayer;

class GoogleVideoPlayer implements VideoPlayer
{

    private $template = <<<EOT
<object width="800" height="450"
data="https://www.youtube.com/embed/%s">
</object>
EOT;


    /**
     * Creates the necessary HTML to render the provided video
     *
     * @param Video $video
     * @return string
     */
    public function render(Video $video): string
    {
        return sprintf($this->template, $video->videoId());
    }
}