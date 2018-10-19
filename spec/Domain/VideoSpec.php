<?php

namespace spec\App\Domain;

use App\Domain\Video;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VideoSpec extends ObjectBehavior
{

    private $videoId;

    private $title;

    function let()
    {
        $this->videoId = '09q809q8w.qwe';
        $this->title = 'Funny';
        $this->beConstructedWith($this->videoId, $this->title);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Video::class);
    }

    function it_has_a_video_id()
    {
        $this->videoId()->shouldBe($this->videoId);
    }

    function it_has_a_title()
    {
        $this->title()->shouldBe($this->title);
    }
}
