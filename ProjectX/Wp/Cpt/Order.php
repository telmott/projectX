<?php

namespace ProjectX\Wp\Cpt;

final class Order
{
    public function start()
    {
        add_action('init', array($this, 'orderPostType'), 10);
        add_action('save_post', [$this, 'saveOrderMetabox'], 10, 2 );
    }

    public function orderPostType()
    {

    }

    public function saveOrderMetabox()
    {
        
    }
}