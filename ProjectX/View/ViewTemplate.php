<?php

namespace ProjectX\View;

class ViewTemplate
{
    public $template_folder = PROJECTX_ROOT . '/views/templates/';
    public function __construct()
    {
        $teste = '';
    }

    public function start()
    {
        add_filter( 'template_include', [$this, 'getTemplate'] );
    }

    public function getTemplate($template)
    {
        if (is_singular('projectx_tour')) {
            $template = $this->template_folder . 'single-tour.php';
        }
        return $template;
    }
}