<?php

namespace Fs;

class Directory extends Inode
{
    /**
     * @return float
     */
    public function freeSpace()
    {
        return \disk_free_space($this->path);
    }

    /**
     * @return float
     */
    public function totalSpace()
    {
        return \disk_total_space($this->path);
    }

    /**
     * @return \Generator
     */
    public function files()
    {
        foreach (glob($this->path . DIRECTORY_SEPARATOR . '*') as $file) {
            yield $file;
        }
    }
}