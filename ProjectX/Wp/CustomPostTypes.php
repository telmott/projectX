<?php

namespace ProjectX\Wp;

class CustomPostTypes
{
    protected $cpt_order;

    protected $cpt_guide;

    protected $cpt_resource;

    protected $cpt_day;    

    public function __construct()
    {
        $this->cpt_order    = new Cpt\Order;
        $this->cpt_guide    = new Cpt\Guide;
        $this->cpt_resource = new Cpt\Resource;
        $this->cpt_day      = new Cpt\Day;
    }
    public function start()
    {
        $this->cpt_order->start();
        $this->cpt_guide->start();
        $this->cpt_resource->start();
        $this->cpt_day->start();
    }
}