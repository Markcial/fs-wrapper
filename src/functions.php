<?php

namespace Fs;

function glob()
{
    foreach(call_user_func_array('\glob', func_get_args()) as $file) {
        $type = filetype($file);
        //fifo, char, dir, block, link, file, socket
        switch ($type) {
            case 'fifo':
                yield new Fifo($file);
                break;
            case 'char':
                yield new Char($file);
                break;
            case 'dir':
                yield new Directory($file);
                break;
            case 'block':
                yield new Block($file);
                break;
            case 'link':
                yield new Link($file);
                break;
            case 'file':
                yield new File($file);
                break;
            case 'socket':
                yield new Socket($file);
                break;
            case 'unknown':
                // wtf?
                throw new \RuntimeException(sprintf('Unrecognzed file type "%d"', $type));
                break;
        }
    }
}

function open($path, $mode) {
    $rsc = new Resource($path, $mode);
    $rsc->open();

    return $rsc;
}
