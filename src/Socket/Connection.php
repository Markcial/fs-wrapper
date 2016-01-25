<?php

namespace Fs\Socket;

use Fs\Resource;

class Connection extends Resource
{
    /**
     * Connection constructor.
     * @param string $resource
     */
    public function __construct($resource)
    {
        parent::__construct(null, 'rw');

        $this->handle = $resource;
    }
}