<?php

namespace Specs\Fs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SocketSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('/tmp/dummy');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fs\Socket');
    }
}
