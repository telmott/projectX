<?php

namespace LovePortugalLikeUs\Wp\Cpt;

final class Day
{
    public function start()
    {
        add_action('init', [$this, 'dayPostType'], 10);
        // add_action('save_post', [$this, 'saveDayMetabox'], 10, 2 );
    }

    public function dayPostType()
    {
        $post_type = 'lptlus_day';

        $labels = [
            'name'               => _x( 'Days', 'post type general name', 'lptlus' ),
            'singular_name'      => _x( 'Day', 'post type singular name', 'lptlus' ),
            'menu_name'          => _x( 'Days', 'admin menu', 'lptlus' ),
            'name_admin_bar'     => _x( 'Day', 'add new on admin bar', 'lptlus' ),
            'add_new'            => _x( 'Add New', 'Day', 'lptlus' ),
            'add_new_item'       => __( 'Add New Day', 'lptlus' ),
            'new_item'           => __( 'New Day', 'lptlus' ),
            'edit_item'          => __( 'Edit Day', 'lptlus' ),
            'view_item'          => __( 'View Day', 'lptlus' ),
            'all_items'          => __( 'All Days', 'lptlus' ),
            'search_items'       => __( 'Search Days', 'lptlus' ),
            'parent_item_colon'  => __( 'Parent Days:', 'lptlus' ),
            'not_found'          => __( 'No Days found.', 'lptlus' ),
            'not_found_in_trash' => __( 'No Days found in Trash.', 'lptlus' )
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