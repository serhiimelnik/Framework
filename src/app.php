<?php

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;

function is_leap_year($year = null)
{
    if (null === $year) {
        $year = date('Y');
    }

    return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
}

function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
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
            '_controller' => function ($request) {
                if (is_leap_year($request->attributes->get('year'))) {
                    return new Response('Yes, this is leap year!');
                }

                return new Response('Nope, this is not a leap year.');
            }
        )
    )
);

return $routes;
