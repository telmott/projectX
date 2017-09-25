<?php

namespace ProjectX\Wp\Cpt;

use Sunra\PhpSimple\HtmlDomParser;

final class Guide
{
    public function start()
    {
        add_action('init', array($this, 'guidePostType'), 10);
        add_action('save_post', [$this, 'saveGalleryMetabox'], 10, 2 );
    }

    public function guidePostType()
    {
        $post_type = 'projectx_guide';

        $labels = [
            'name'               => _x( 'Guides', 'post type general name', 'projectx' ),
            'singular_name'      => _x( 'Guide', 'post type singular name', 'projectx' ),
            'menu_name'          => _x( 'Guides', 'admin menu', 'projectx' ),
            'name_admin_bar'     => _x( 'Guide', 'add new on admin bar', 'projectx' ),
            'add_new'            => _x( 'Add New', 'Guide', 'projectx' ),
            'add_new_item'       => __( 'Add New Guide', 'projectx' ),
            'new_item'           => __( 'New Guide', 'projectx' ),
            'edit_item'          => __( 'Edit Guide', 'projectx' ),
            'view_item'          => __( 'View Guide', 'projectx' ),
            'all_items'          => __( 'All Guides', 'projectx' ),
            'search_items'       => __( 'Search Guides', 'projectx' ),
            'parent_item_colon'  => __( 'Parent Guides:', 'projectx' ),
            'not_found'          => __( 'No Guides found.', 'projectx' ),
            'not_found_in_trash' => __( 'No Guides found in Trash.', 'projectx' )
        ];
        
        $args = [
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_nav_menus'     => false,
            'show_in_menu'          => false,
            'show_in_admin_bar'     => false,
            'menu_position'         => null,
            'menu_icon'             => null,
            'capability_type'       => 'post',
            'map_meta_cap'          => null,
            'hierarchical'          => false,
            'supports'              => ['title', 'thumbnail', 'editor'],
            'register_meta_box_cb'  => [$this, 'guideMetabox'],
            'taxonomies'            => ['region'],
            'has_archive'           => true,
            'rewrite'               => [
                'slug'  => 'guide'
            ],
            'query_var'             => true,
            'can_export'            => true,
            'show_in_rest'          => true,
            'rest_base'             => 'guide'
        ];

        register_post_type($post_type, $args);
    }

    public function guideMetabox()
    {
        add_meta_box('gallery', 'Gallery', [$this, 'renderGalleryMetabox'], null, 'normal');
        add_meta_box('days', 'Days', [$this, 'renderGuideMetabox'], null, 'normal');
    }

    public function renderGuideMetabox()
    {
        global $post_id;
        wp_localize_script('projectx-js', 'projectxTourId', ['TourId' => $post_id]);
        wp_localize_script('projectx-js', 'projectxWpApiSettings', [
            'root'  => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest')
        ]);
        echo '<div id="tourMetaBox"></div>';
    }

    public function renderGalleryMetabox($post)
    {
        $images = get_post_meta($post->ID, 'gallery', true);

        $images = is_array($images) ? implode($images) : '';

        echo wp_editor($images, 'galleryeditor', [
            'quicktags' => false,
            'teeny'     => true
        ]);
    }

    public function saveGalleryMetabox($post_id, $post)
    {
        if ($_POST['post_type'] != 'projectx_guide') {
            return;
        }

        if (!isset($_POST['galleryeditor'])) {
            return;
        }

        $images = '';

        if (!empty($_POST['galleryeditor'])) {
            $html_dom = HtmlDomParser::str_get_html($_POST['galleryeditor']);
            $nodes = $html_dom->find('img');
            $images = array_map(function($node) {
                return '<img class="guide-gallery-img" src='.$node->src.' />';
            }, $nodes);
        }

        

        update_post_meta($post_id, 'gallery', $images);
    }
}