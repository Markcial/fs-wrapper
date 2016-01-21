<?php

namespace Fs\Wrapper;

abstract class Filter extends \php_user_filter
{
    abstract public function filter($in, $out, &$consumed, $closing);
}