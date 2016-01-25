<?php

namespace Fs;

class Link extends File
{
    /**
     * @return string
     */
    public function resolve()
    {
        return \readlink($this->path);
    }

    /**
     * @return File
     */
    public function file()
    {
        return new File($this->resolve());
    }
}