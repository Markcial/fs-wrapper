<?php

namespace Fs\Wrapper;

abstract class Stream
{
    /** @var string */
    protected $prefix;

    /**
     * Stream constructor.
     * @param $prefix
     */
    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    abstract public function dir_closedir();
    abstract public function dir_opendir($path, $options);
    abstract public function dir_readdir();
    abstract public function dir_rewinddir();
    abstract public function mkdir($path, $mode, $options);
    abstract public function rename($path_from, $path_to);
    abstract public function rmdir($path, $options);
    abstract public function unlink($path);
    abstract public function url_stat($path, $flags);

    abstract public function stream_cast($cast_as);
    abstract public function stream_close();
    abstract public function stream_open($path, $mode, $options, &$opened_path);
    abstract public function stream_read($count);
    abstract public function stream_write($data);
    abstract public function stream_tell();
    abstract public function stream_flush();
    abstract public function stream_lock($operation);
    abstract public function stream_eof();
    abstract public function stream_stat();
    abstract public function stream_seek($offset, $whence = SEEK_SET);
    abstract public function stream_set_option($option, $arg1, $arg2);
    abstract public function stream_metadata($path, $option, $var);

    public function register() {
        \stream_wrapper_register($this->prefix, get_called_class());
    }

    public function unregister()
    {
        \stream_wrapper_unregister($this->prefix);
    }

    public function restore()
    {
        \stream_wrapper_restore($this->prefix);
    }
}