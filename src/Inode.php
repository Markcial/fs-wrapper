<?php

namespace Fs;

abstract class Inode
{
    /** @var string */
    protected $path;

    /**
     * Inode constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function chgrp($group)
    {
        return \chgrp($this->path, $group);
    }

    public function chmod($mode)
    {
        return \chmod($this->path, $mode);
    }

    public function basename($suffix = null)
    {
        return \basename($this->path, $suffix);
    }

    public function path()
    {
        return $this->path;
    }

    public function copy($dest)
    {
        return \copy($this->path, $dest);
    }

    public function exists()
    {
        return \file_exists($this->path);
    }

    public function type()
    {
        return \filetype($this->path);
    }

    public function touch($time = null, $atime = null)
    {
        return \touch($this->path, $time, $atime);
    }
}
