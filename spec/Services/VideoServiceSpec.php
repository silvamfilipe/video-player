<?php

namespace spec\App\Services;

use App\Domain\Video;
use App\Domain\VideoPlayer;
use App\Domain\VideoProvider;
use App\Services\VideoService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VideoServiceSpec extends ObjectBehavior
{
    private $term;

    private $videos;

    private $html;

    function let(
        VideoProvider $provider,
        Video $video,
        VideoPlayer $player
    ) {
        $this->term = 'term';
        $this->videos = [$video];

        $provider->videoList($this->term)->willReturn($this->videos);
        $provider->first()->willReturn($video);
        $provider->player()->willReturn($player);

        $this->html = "Some fancy HTML to render this video!";
        $player->render($video)->willReturn($this->html);

        $this->beConstructedWith($provider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(VideoService::class);
    }

    function it_returns_a_list_of_videos(VideoProvider $provider)
    {
        $this->videoList($this->term)->shouldBe($this->videos);
        $provider->videoList($this->term)->shouldHaveBeenCalled();
    }

    function it_returns_the_first_video_of_the_last_search(Video $video)
    {
        $this->first()->shouldBe($video);
    }

    function it_returns_the_html_for_rendering_the_player(Video $video)
    {
        $this->render($video)->shouldBe($this->html);
    }
}
