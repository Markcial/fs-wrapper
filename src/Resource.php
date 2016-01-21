<?php

namespace Fs;

class Resource
{
    /** @var string */
    private $fd;
    /** @var string */
    private $mode;
    /** @var resource */
    private $handle;

    /**
     * Resource constructor.
     * @param string $fd
     * @param string $mode
     */
    public function __construct($fd = 'php://memory', $mode = 'rw+')
    {
        $this->fd = $fd;
        $this->mode = $mode;
    }

    /**
     * @return bool
     */
    public function open()
    {
        $this->handle = \fopen($this->fd, $this->mode);

        return $this->isOpened();
    }

    /**
     * @param $text
     * @param null $length
     *
     * @return int
     */
    public function write($text, $length = null)
    {
        if (!is_null($length)) {
            return \fwrite($this->handle, $text, $length);
        }

        return \fwrite($this->handle, $text);
    }

    /**
     * @return bool
     */
    public function rewind()
    {
        return \rewind($this->handle);
    }

    /**
     * @return string
     */
    public function char()
    {
        return \fgetc($this->handle);
    }

    /**
     * @param int $pos
     * @param int $whence
     *
     * @return int
     */
    public function seek($pos, $whence = SEEK_SET)
    {
        return \fseek($this->handle, $pos, $whence);
    }

    /**
     * @return int
     */
    public function start()
    {
        return $this->seek(0, SEEK_SET);
    }

    /**
     * @return int
     */
    public function end()
    {
        return $this->seek(0, SEEK_END);
    }

    /**
     * @return bool
     */
    public function eof()
    {
        if ($this->char() === false) {
            return true;
        }
        $this->seek(-1, SEEK_CUR);

        return false;
    }

    /**
     * @return int
     */
    public function tell()
    {
        return \ftell($this->handle);
    }

    /**
     * @return bool
     */
    public function flush()
    {
        return \fflush($this->handle);
    }

    /**
     * @return array
     */
    public function stat()
    {
        return \fstat($this->handle);
    }

    /**
     * @param $length
     *
     * @return bool
     */
    public function truncate($length)
    {
        return \ftruncate($this->handle, $length);
    }

    /**
     * @return string
     */
    public function read()
    {
        $bfr = '';
        while (!$this->eof()) {
            $bfr .= \fgets($this->handle);
        }

        return $bfr;
    }

    /**
     * @return string
     */
    public function type()
    {
        if ($this->isOpened()) {
            return \get_resource_type($this->handle);
        }

        if ($this->exists()) {
            return \filetype($this->fd);
        }

        return 'unknown';
    }

    /**
     * @return int|bool
     */
    public function length()
    {
        $stats = $this->stat();

        return $stats['size'];
    }

    public function __wakeup()
    {
        $this->open();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->rewind();

        return $this->read();
    }

    /**
     * @return bool
     */
    public function isReadable()
    {
        switch ($this->type()) {
            case 'stream':
                $metadata = stream_get_meta_data($this->handle);

                return (bool) preg_match('#r|\+#', $metadata['mode']);
            case 'file':
                return \is_readable($this->fd);
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isWritable()
    {
        switch ($this->type()) {
            case 'stream':
                $metadata = stream_get_meta_data($this->handle);

                return (bool) preg_match('#[waxc]|\+#', $metadata['mode']);
            case 'file':
                return \is_writable($this->fd);
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isExecutable()
    {
        if ($this->type() == 'file') {
            return \is_executable($this->fd);
        }

        return false;
    }

    public function isClosed()
    {
        return !$this->isOpened();
    }

    /**
     * @return bool
     */
    public function isOpened()
    {
        return \is_resource($this->handle);
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return \file_exists($this->fd);
    }

    /**
     * @return bool
     */
    public function close()
    {
        return \fclose($this->handle);
    }
}
