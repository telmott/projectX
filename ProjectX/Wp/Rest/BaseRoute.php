<?php

namespace ProjectX\Wp\Rest;

use WP_REST_Controller;

class BaseRoute extends WP_REST_Controller
{
    protected $version = '1';

    public $namespace = 'projectx/v1';
}