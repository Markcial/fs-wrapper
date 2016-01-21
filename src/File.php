<?php

namespace Fs;

class File extends Inode
{
    public function open($mode)
    {
        return new Resource($this->path, $mode);
    }
}