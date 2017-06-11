<?php

namespace LovePortugalLikeUs\View;

use LovePortugalLikeUs\Wp;

class ViewResources extends View
{
    protected $current_menu = 'resources';

    protected function setTable()
    {
        global $wpdb;

        $this->table = new Wp\Table\Resources;
        $this->table->raw_data = new \WP_Query( array( 'post_type' => 'lptlus_resource' ) );
        $this->table->prepare_items();
    }

    
}