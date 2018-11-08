<?php

namespace spec\App\Infrastructure\Google;

use App\Domain\VideoProvider;
use App\Infrastructure\Google\GoogleVideoProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GoogleVideoProviderSpec extends ObjectBehavior
{
    function let(\Google_Service_YouTube $youtubeService)
    {
        $this->beConstructedWith($youtubeService);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GoogleVideoProvider::class);
    }

    function its_a_video_provider()
    {
        $this->shouldBeAnInstanceOf(VideoProvider::class);
    }

    function it_can_search_for_a_list_of_videos()
    {
        $this->videoList()->shouldBeArray();
    }
}
