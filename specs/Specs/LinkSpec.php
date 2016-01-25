<?php

namespace Specs\Fs;

use Fs\File;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LinkSpec extends ObjectBehavior
{
    public function let()
    {
        $rsc = new File('/tmp/dummy');
        $rsc->touch();
        $rsc->symlink('/tmp/dummy-link');
        $this->beConstructedWith('/tmp/dummy-link');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fs\Link');
    }

    function it_should_resolve_the_link()
    {
        $this->resolve()->shouldBe('/tmp/dummy');
    }

    function it_should_return_the_linked_file()
    {
        $this->file()->shouldReturnAnInstanceOf('Fs\File');
    }

    function letGo()
    {
        $rsc = new File('/tmp/dummy-link');
        $rsc->delete();
        $rsc = new File('/tmp/dummy');
        $rsc->delete();
    }
}
