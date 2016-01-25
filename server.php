<?php

require './vendor/autoload.php';

use Fs\Socket\Connection;

$rsc = new Fs\Socket('/tmp/foo.sock');
$server = $rsc->server();
$server->open();
$server->serve(function (Connection $c) { $c->write('bohoh'); });