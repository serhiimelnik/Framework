<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$routes = include __DIR__.'/../src/app.php';
$cs = include __DIR__.'/../src/container.php';

$request = Request::createFromGlobals();

$response = $cs->get('framework')->handle($request);

$response ->send();
