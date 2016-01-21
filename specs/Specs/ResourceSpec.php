<?php

namespace Specs\Fs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResourceSpec extends ObjectBehavior
{
    function let($object)
    {
        $this->beConstructedWith('php://memory', 'rw+');
        $this->open();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fs\Resource');
    }

    function it_should_be_writable()
    {
        $this->write('foo')->shouldReturn(3);
    }

    function it_should_be_rewindable()
    {
        $this->write('some text')->shouldReturn(9);
        $this->rewind()->shouldReturn(true);
    }

    function it_should_be_seekable()
    {
        $this->write('123456')->shouldReturn(6);
        $this->seek(4)->shouldReturn(0);
    }

    function it_should_tell_if_file_has_ended()
    {
        $this->eof()->shouldReturn(true);
        $this->write('text')->shouldReturn(4);
        $this->eof()->shouldReturn(true);
        $this->rewind()->shouldReturn(true);
        $this->eof()->shouldReturn(false);
    }

    function it_should_rewind()
    {
        $this->write('text')->shouldReturn(4);
        $this->rewind()->shouldReturn(true);
        $this->read()->shouldReturn('text');
    }

    function it_should_return_single_shars()
    {
        $this->write('abc')->shouldReturn(3);
        $this->rewind()->shouldReturn(true);
        $this->char()->shouldReturn('a');
        $this->char()->shouldReturn('b');
        $this->char()->shouldReturn('c');
        $this->char()->shouldReturn(false);
    }

    function it_should_move_cursor_to_end()
    {
        $this->write('123456789')->shouldReturn(9);
        $this->rewind()->shouldReturn(true);
        $this->end()->shouldReturn(0);
        $this->seek(-1, SEEK_CUR)->shouldReturn(0);
        $this->char()->shouldReturn('9');
    }

    function it_should_move_cursor_to_start()
    {
        $this->write('123456789')->shouldReturn(9);
        $this->start()->shouldReturn(0);
        $this->char()->shouldReturn('1');
    }

    function it_should_tell_cursor_position()
    {
        $this->write('123456789')->shouldReturn(9);
        $this->tell()->shouldBe(9);
        $this->rewind()->shouldBe(true);
        $this->tell()->shouldBe(0);
        $this->char()->shouldBe('1');
        $this->tell()->shouldBe(1);
        $this->end()->shouldReturn(0);
        $this->tell()->shouldBe(9);
    }

    function it_should_flush_contents()
    {

    }

    function it_should_truncate()
    {
        $this->write('some text')->shouldBe(9);
        $this->truncate(5)->shouldBe(true);
        $this->rewind()->shouldBe(true);
        $this->read()->shouldBe('some ');
        $this->truncate(0)->shouldBe(true);
        $this->rewind()->shouldBe(true);
        $this->read()->shouldBe('');
    }

    function it_should_return_type()
    {
        $this->type()->shouldBe('stream');
    }

    function it_can_be_closed()
    {
        $this->close()->shouldBe(true);
        $this->isClosed()->shouldBe(true);
    }

    function it_can_be_reopened()
    {
        $this->close()->shouldBe(true);
        $this->open()->shouldBe(true);
        $this->write('text')->shouldBe(4);
        $this->rewind()->shouldBe(true);
        $this->read()->shouldBe('text');
    }

    function it_can_be_converted_to_string()
    {
        $this->write('text')->shouldBe(4);
        $this->__toString()->shouldBe('text');
    }
}
