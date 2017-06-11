<?php

namespace LovePortugalLikeUs\Wp;

class Taxonomies
{
    protected $region;

    protected $resource;

    protected $tier;

    public function __construct()
    {
        $this->region = new Taxo\Region;
        $this->resource = new Taxo\Resource;
        $this->tier = new Taxo\Tier;
    }

    public function start()
    {
        $this->region->start();
        $this->resource->start();
        $this->tier->start();
    }
}