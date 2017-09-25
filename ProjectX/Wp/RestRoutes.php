<?php

namespace ProjectX\Wp;

class RestRoutes
{
    protected $days_route;

    protected $transport_route;

    protected $accommodation_route;

    public function __construct()
    {
        $this->days_route = new Rest\DaysRoute;
        $this->transport_route = new Rest\TransportRoute;
        $this->accommodation_route = new Rest\AccommodationRoute;
    }

    public function start()
    {
        $this->days_route->start();
        $this->transport_route->start();
        $this->accommodation_route->start();
    }
}
