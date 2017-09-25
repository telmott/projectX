<?php

namespace ProjectX\View;

use ProjectX\Wp;

class ViewResources extends View
{
    protected $current_menu = 'resources';

    protected function setTable()
    {
        global $wpdb;

        $this->table = new Wp\Table\Resources;
        $this->table->raw_data = new \WP_Query( array( 'post_type' => 'projectx_resource', 'posts_per_page' => -1 ) );
        $this->table->prepare_items();
    }

    
}