<?php

namespace Fs;

class File extends Inode
{
    public function open($mode)
    {
        return new Resource($this->path, $mode);
    }

    public function isExecutable()
    {
        return \is_executable($this->path);
    }

    public function exec($args = [])
    {
        if (!$this->isExecutable()) {
            throw new \RuntimeException('File is not executable.');
        }

        $bfr = '';
        $handle = \popen($this->path, 'r');
        while (!\feof($handle)) {
            $bfr .= \fgets($handle);
        }
        \pclose($handle);

        return $bfr;
    }
}