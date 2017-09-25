<?php

namespace ProjectX\View;

use ProjectX\Wp;

class ViewGuides extends View
{
    protected $current_menu = 'guides';

    protected function setTable()
    {
        $this->table = new Wp\Table\Guides;
        $this->table->raw_data = new \WP_Query(['post_type' => 'projectx_guide']);
        $this->table->prepare_items();
    }
}