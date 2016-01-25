<?php

namespace Fs;

// replace for any convenience date converter that supports timestamps if needed
use \DateTime as Date;

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

    /**
     * @return int
     */
    public function group()
    {
        return \filegroup($this->path);
    }

    /**
     * @return int
     */
    public function owner()
    {
        return \fileowner($this->path);
    }

    /**
     * @return int
     */
    public function perms()
    {
        return \fileperms($this->path);
    }

    /**
     * @return int
     */
    public function size()
    {
        return \filesize($this->path);
    }

    /**
     * @return int
     */
    public function accessedOn()
    {
        return new Date('@' . \fileatime($this->path));
    }

    /**
     * @return int
     */
    public function modifiedOn()
    {
        return new Date('@' . \filemtime($this->path));
    }

    /**
     * @return int
     */
    public function changedOn()
    {
        return new Date('@' . \filectime($this->path));
    }

    /**
     * @return int
     */
    public function inode()
    {
        return \fileinode($this->path);
    }

    /**
     * @param $dest
     *
     * @return Link|bool
     */
    public function link($dest)
    {
        if (\link($this->path, $dest)) {
            return new Link($dest);
        }

        return false;
    }

    /**
     * @param $dest
     *
     * @return Link|bool
     */
    public function symlink($dest)
    {
        if (\symlink($this->path, $dest)) {
            return new Link($dest);
        }

        return false;
    }

    /**
     * @param $mode
     *
     * @return bool
     */
    public function chmod($mode)
    {
        return \chmod($this->path, $mode);
    }

    /**
     * @param null $suffix
     *
     * @return string
     */
    public function basename($suffix = null)
    {
        return \basename($this->path, $suffix);
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * @param $dest
     *
     * @return bool
     */
    public function copy($dest)
    {
        return \copy($this->path, $dest);
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return \file_exists($this->path);
    }

    /**
     * @return string
     */
    public function type()
    {
        return \filetype($this->path);
    }

    /**
     * @param null $time
     * @param null $atime
     *
     * @return bool
     */
    public function touch($time = null, $atime = null)
    {
        return \touch($this->path, $time, $atime);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return \unlink($this->path);
    }
}
