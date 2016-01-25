<?php

namespace Fs\Socket;

use Fs\Resource;

class Client extends Resource
{
    /** @var int */
    private $errno;
    /** @var string */
    private $errstr;

    /**
     * Client constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        parent::__construct($path, 'rw');
    }

    /**
     * @return bool
     */
    public function open()
    {
        $this->handle = \stream_socket_client(
            \sprintf('unix://%s', $this->fd),
            $this->errno,
            $this->errstr
        );

        return $this->isOpened();
    }
}