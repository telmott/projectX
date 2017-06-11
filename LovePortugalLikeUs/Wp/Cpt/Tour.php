<?php

namespace LovePortugalLikeUs\Wp\Cpt;

final class Tour
{
    public function start()
    {
        add_action('init', array($this, 'tourPostType'), 10);
        // add_action('save_post', [$this, 'saveTourMetabox'], 10, 2 );
    }

    public function tourPostType()
    {
        $post_type = 'lptlus_tour';

        $labels = [
            'name'               => _x( 'Tours', 'post type general name', 'lptlus' ),
            'singular_name'      => _x( 'Tour', 'post type singular name', 'lptlus' ),
            'menu_name'          => _x( 'Tours', 'admin menu', 'lptlus' ),
            'name_admin_bar'     => _x( 'Tour', 'add new on admin bar', 'lptlus' ),
            'add_new'            => _x( 'Add New', 'Tour', 'lptlus' ),
            'add_new_item'       => __( 'Add New Tour', 'lptlus' ),
            'new_item'           => __( 'New Tour', 'lptlus' ),
            'edit_item'          => __( 'Edit Tour', 'lptlus' ),
            'view_item'          => __( 'View Tour', 'lptlus' ),
            'all_items'          => __( 'All Tours', 'lptlus' ),
            'search_items'       => __( 'Search Tours', 'lptlus' ),
            'parent_item_colon'  => __( 'Parent Tours:', 'lptlus' ),
            'not_found'          => __( 'No Tours found.', 'lptlus' ),
            'not_found_in_trash' => __( 'No Tours found in Trash.', 'lptlus' )
        ];
        
        $args = [
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => false,
            'show_ui'               => true,
            'show_in_nav_menus'     => false,
            'show_in_menu'          => false,
            'show_in_admin_bar'     => false,
            'menu_position'         => null,
            'menu_icon'             => null,
            'capability_type'       => 'post',
            // 'capabilities'
            'map_meta_cap'          => null,
            'hierarchical'          => false,
            'supports'              => ['title', 'thumbnail', 'editor'],
            'register_meta_box_cb'  => [$this, 'tourMetabox'],
            'taxonomies'            => ['region'],
            'has_archive'           => false,
            'rewrite'               => false,
            // 'permalink_epmask'
            'query_var'             => true,
            'can_export'            => true,
            'show_in_rest'          => true,
            'rest_base'             => 'tours'
        ];

        register_post_type($post_type, $args);
    }

    public function tourMetabox()
    {
        add_meta_box('days', 'Days', [$this, 'renderTourMetabox'], null, 'normal');
    }

    public function renderTourMetabox()
    {
        global $post_id;
        wp_localize_script('lptlus-js', 'lptlusTourId', ['TourId' => $post_id]);
        wp_localize_script('lptlus-js', 'lptlusWpApiSettings', [
            'root'  => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest')
        ]);
        echo '<div id="tourMetaBox"></div>';
    }
}