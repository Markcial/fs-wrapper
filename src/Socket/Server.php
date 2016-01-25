<?php

namespace Fs\Socket;

use Fs\Resource;

class Server extends Resource
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
        $this->handle = \stream_socket_server(
            \sprintf('unix://%s', $this->fd),
            $this->errno,
            $this->errstr
        );

        return $this->isOpened();
    }

    /**
     * @return resource
     */
    protected function accept()
    {
        return new Connection(\stream_socket_accept($this->handle));
    }

    /**
     * @param \Closure $closure
     */
    public function serve(\Closure $closure)
    {
        while ($conn = $this->accept()) {
            $closure($conn);
        }
    }
}