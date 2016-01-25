<?php


require './vendor/autoload.php';

$rsc = new Fs\Socket('/tmp/foo.sock');
$client = $rsc->client();
$client->open();
var_dump($client->read());
