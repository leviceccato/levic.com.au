<?php

$root = __DIR__ . '/..';
$public = $root . '/public';
$data = $root . '/data';
$source = $root . '/source';

include $root . '/vendor/autoload.php';

echo (new Kirby([
    'roots' => [
        'index' => $public,
        'media' => $public . '/media',
        'site' => $source,
        'snippets' => $source . '/templates',
        'blueprints' => $source . '/blueprints',
        'content' => $data . '/content',
        'accounts' => $data . '/accounts',
        'sessions' => $data . '/sessions',
        'cache' => $data . '/cache'
    ]
]))->render();