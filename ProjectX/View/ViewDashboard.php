<?php

namespace ProjectX\View;

use ProjectX\Wp;

class ViewDashboard extends View
{
    protected $current_menu = 'dashboard';

    protected function setTable()
    {
        // $this->table = new Wp\Table\Resources;
    }
}