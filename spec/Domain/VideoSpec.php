<?php

namespace spec\App\Domain;

use App\Domain\Video;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VideoSpec extends ObjectBehavior
{

    private $videoId;

    private $title;

    private $description;

    function let()
    {
        $this->videoId = '09q809q8w.qwe';
        $this->title = 'Funny';
        $this->description = 'This is a description';
        $this->beConstructedWith($this->videoId, $this->title, $this->description);
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

    function it_can_have_a_description()
    {
        $this->description()->shouldBe($this->description);
    }

    function it_can_be_constructed_without_a_description()
    {
        $this->beConstructedWith($this->videoId, $this->title);
        $this->shouldHaveType(Video::class);
        $this->description()->shouldBeNull();
    }

    function it_can_have_an_author()
    {
        $this->author()->shouldBeNull();

        $author = "John Doe";
        $this->createdBy($author)->shouldBe($this->getWrappedObject());
        $this->author()->shouldBe($author);
    }

    function it_can_have_a_thumbnail()
    {
        $this->thumbnail()->shouldBeNull();

        $thumbnail = 'http://some.pt/thumb';
        $this->withThumbnail($thumbnail)->shouldBe($this->getWrappedObject());
        $this->thumbnail()->shouldBe($thumbnail);
    }
}
