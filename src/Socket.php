<?php

namespace Fs;

use Fs\Socket\Client;
use Fs\Socket\Server;

class Socket extends File
{
    /** @var Server|Client|null */
    protected $socket;

    /**
     * @return Client|null
     */
    public function client()
    {
        $this->socket = new Client($this->path);

        return $this->socket;
    }

    /**
     * @return Server|null
     */
    public function server()
    {
        $this->socket = new Server($this->path);

        return $this->socket;
    }
}