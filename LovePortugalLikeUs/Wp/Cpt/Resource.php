<?php

namespace LovePortugalLikeUs\Wp\Cpt;

final class Resource
{
    public function start()
    {
        add_action('init', array($this, 'resourcePostType'), 10);
        add_action('save_post', [$this, 'saveResourceMetabox'], 10, 2 );
    }

    public function resourcePostType()
    {
        $post_type = 'lptlus_resource';

        $labels = [
            'name'               => _x( 'Resources', 'post type general name', 'lptlus' ),
            'singular_name'      => _x( 'Resource', 'post type singular name', 'lptlus' ),
            'menu_name'          => _x( 'Resources', 'admin menu', 'lptlus' ),
            'name_admin_bar'     => _x( 'Resource', 'add new on admin bar', 'lptlus' ),
            'add_new'            => _x( 'Add New', 'Resource', 'lptlus' ),
            'add_new_item'       => __( 'Add New Resource', 'lptlus' ),
            'new_item'           => __( 'New Resource', 'lptlus' ),
            'edit_item'          => __( 'Edit Resource', 'lptlus' ),
            'view_item'          => __( 'View Resource', 'lptlus' ),
            'all_items'          => __( 'All Resources', 'lptlus' ),
            'search_items'       => __( 'Search Resources', 'lptlus' ),
            'parent_item_colon'  => __( 'Parent Resources:', 'lptlus' ),
            'not_found'          => __( 'No Resources found.', 'lptlus' ),
            'not_found_in_trash' => __( 'No Resources found in Trash.', 'lptlus' )
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
            'supports'              => ['title', 'thumbnail', 'excerpt'],
            'register_meta_box_cb'  => [$this, 'resourceMetabox'],
            'taxonomies'            => ['region', 'resource_type', 'tier'],
            'has_archive'           => false,
            'rewrite'               => false,
            // 'permalink_epmask'
            'query_var'             => true,
            'can_export'            => true,
            'show_in_rest'          => true,
            'rest_base'             => 'resources'
        ];

        register_post_type($post_type, $args);
    }

    public function resourceMetabox()
    {
        add_meta_box('details', 'Details', [$this, 'renderResourceMetabox']);
    }

    public function renderResourceMetabox()
    {
        // Add nonce for security and authentication.
		if ( function_exists('wp_nonce_field') ) wp_nonce_field('lptlus-save', 'lptlus_nonce' );

        // Retrieve an existing value from the database.
		$resource_value = get_post_meta($_GET['post'], 'resource_value', true );
		$resource_margin = get_post_meta($_GET['post'], 'resource_margin', true );
		$resource_active = get_post_meta($_GET['post'], 'resource_active', true ) == 'on' ? 'checked' : '';
		$resource_start = get_post_meta($_GET['post'], 'resource_start', true );
		$resource_end = get_post_meta($_GET['post'], 'resource_end', true );

		// // Set default values.
		// if( empty( $guide_description ) ) $guide_description = '';

        // Form fields.
        echo '<table class="form-table">

                <tr>
                    <td>
                        <label for="value">Value</label>
                        <input id="value" name="value" type="text" value="'.$resource_value.'" />
                    </td>
                    <td>
                        <label for="margin">%</label>
                        <input id="margin" name="margin" type="text" value="'.$resource_margin.'" />
                    </td>
                    <td>
                        <label for="active">Active</label>
                        <input id="active" name="active" type="checkbox" '.$resource_active.'/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="start">Start</label>
                        <input id="start" name="start" type="text" class="datetime-js" value="'.$resource_start.'" />
                    </td>
                    <td>
                        <label for="start">End</label>
                        <input id="end" name="end" type="text" class="datetime-js" value="'.$resource_end.'" />
                    </td>
                </tr>
            </table>';
    }

    public function saveResourceMetabox()
    {
        // Add nonce for security and authentication.
		$nonce_name   = $_POST['lptlus_nonce'] ?? '';
		$nonce_action = 'lptlus-save';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $_POST['post_ID'] ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $_POST['post_ID'] ) )
			return;

		// Check if it's not a revision.
		if ( wp_is_post_revision( $_POST['post_ID'] ) )
			return;
        
        $value = sanitize_text_field($_POST['value']) ?? '';
        $margin = sanitize_text_field($_POST['margin']) ?? '';
        $active = sanitize_text_field($_POST['active']) ?? 'off';
        $start = sanitize_text_field($_POST['start']) ?? '';
        $end = sanitize_text_field($_POST['end']) ?? '';

        // Update the meta field in the database.
		update_post_meta($_POST['post_ID'], 'resource_value', $value);
		update_post_meta($_POST['post_ID'], 'resource_margin', $margin);
		update_post_meta($_POST['post_ID'], 'resource_active', $active);
		update_post_meta($_POST['post_ID'], 'resource_start', $start);
		update_post_meta($_POST['post_ID'], 'resource_end', $end);

    }
}