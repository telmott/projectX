<?php

namespace LovePortugalLikeUs\Wp;

class CustomPostTypes
{
    protected $cpt_order;

    protected $cpt_tour;

    protected $cpt_resource;

    protected $cpt_day;    

    public function __construct()
    {
        $this->cpt_order    = new Cpt\Order;
        $this->cpt_tour     = new Cpt\Tour;
        $this->cpt_resource = new Cpt\Resource;
        $this->cpt_day      = new Cpt\Day;
    }
    public function start()
    {
        $this->cpt_order->start();
        $this->cpt_tour->start();
        $this->cpt_resource->start();
        $this->cpt_day->start();
    }
}