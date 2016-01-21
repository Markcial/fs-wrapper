<?php

namespace Specs\Fs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('/tmp/dummy');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fs\File');
    }

    function it_should_return_resource_on_open()
    {
        $this->open('r')->shouldReturnAnInstanceOf('Fs\Resource');
    }
}
