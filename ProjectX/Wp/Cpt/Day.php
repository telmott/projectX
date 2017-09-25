<?php

namespace ProjectX\Wp\Cpt;

final class Day
{
    public function start()
    {
        add_action('init', [$this, 'dayPostType'], 10);
        // add_action('save_post', [$this, 'saveDayMetabox'], 10, 2 );
    }

    public function dayPostType()
    {
        $post_type = 'projectx_day';

        $labels = [
            'name'               => _x( 'Days', 'post type general name', 'projectx' ),
            'singular_name'      => _x( 'Day', 'post type singular name', 'projectx' ),
            'menu_name'          => _x( 'Days', 'admin menu', 'projectx' ),
            'name_admin_bar'     => _x( 'Day', 'add new on admin bar', 'projectx' ),
            'add_new'            => _x( 'Add New', 'Day', 'projectx' ),
            'add_new_item'       => __( 'Add New Day', 'projectx' ),
            'new_item'           => __( 'New Day', 'projectx' ),
            'edit_item'          => __( 'Edit Day', 'projectx' ),
            'view_item'          => __( 'View Day', 'projectx' ),
            'all_items'          => __( 'All Days', 'projectx' ),
            'search_items'       => __( 'Search Days', 'projectx' ),
            'parent_item_colon'  => __( 'Parent Days:', 'projectx' ),
            'not_found'          => __( 'No Days found.', 'projectx' ),
            'not_found_in_trash' => __( 'No Days found in Trash.', 'projectx' )
        ];
        
        $args = [
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_ui'               => false,
            'show_in_nav_menus'     => false,
            'show_in_menu'          => false,
            'show_in_admin_bar'     => false,
            'menu_position'         => null,
            'menu_icon'             => null,
            'capability_type'       => 'post',
            // 'capabilities'
            'map_meta_cap'          => null,
            'hierarchical'          => true,
            'supports'              => ['title', 'thumbnail', 'editor'],
            // 'register_meta_box_cb'  => [$this, 'DayMetabox'],
            'taxonomies'            => ['region'],
            'has_archive'           => false,
            'rewrite'               => false,
            // 'permalink_epmask'
            'query_var'             => true,
            'can_export'            => true,
            'show_in_rest'          => true,
            'rest_base'             => 'days'
        ];

        register_post_type($post_type, $args);
    }
}