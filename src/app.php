<?php

use Symfony\Component\Routing;
require 'LeapYearController.php';

function is_leap_year($year = null)
{
    if (null === $year) {
        $year = date('Y');
    }

    return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
}

$routes = new Routing\RouteCollection();
$routes->add(
    'hello',
    new Routing\Route(
        '/hello/{name}', array(
            'name' => 'World',
            '_controller' => 'render_template',
        )
    )
);
$routes->add(
    'bye',
    new Routing\Route(
        '/bye', array(
            '_controller' => 'render_template'
        )
    )
);
$routes->add(
    'leap_year',
    new Routing\Route(
        '/is_leap_year/{year}', array(
            'year' => null,
            '_controller' => 'LeapYearController::indexAction',
        )
    )
);

return $routes;
