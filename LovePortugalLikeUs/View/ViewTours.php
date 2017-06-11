<?php

namespace LovePortugalLikeUs\View;

use LovePortugalLikeUs\Wp;

class ViewTours extends View
{
    protected $current_menu = 'tours';

    protected function setTable()
    {
        $this->table = new Wp\Table\Tours;
        $this->table->raw_data = new \WP_Query(['post_type' => 'lptlus_tour']);
        $this->table->prepare_items();
    }
}