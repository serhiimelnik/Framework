<?php

use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    public function indexAction($year)
    {
        if (is_leap_year($year)) {
            return new Response('Yes, this is leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
}
