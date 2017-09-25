<?php

namespace ProjectX\View;

abstract class View
{
    protected $current_tab = [];

    protected $table;

    public function __construct()
    {
        $this->setCurrentTab();
    }

    private function setCurrentTab()
    {
        $key = $_GET['tab'] ?? 'home';

        if ($key == 'home') {
            $value = ucfirst($this->current_menu);
        }

        if ($key != 'home') {
            $value = ucfirst($this->tabs[$key]);
        }

        $this->current_tab['key'] = $key;
        $this->current_tab['value'] = $value;
    }

    public function render()
    {
        ob_start();

        $this->setTable();

        include(PROJECTX_ROOT . '/views/admin/' . $this->current_menu . '-' . $this->current_tab['key'] . '.php');

        return ob_flush();
    }

    
}