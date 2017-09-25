<?php

namespace ProjectX\Wp\Cpt;

final class Resource
{
    public function start()
    {
        add_action('init', array($this, 'resourcePostType'), 10);
        add_action('save_post', [$this, 'saveResourceMetabox'], 10, 2 );
        add_action('rest_api_init', [$this, 'resourceRestFields']);
    }

    public function resourcePostType()
    {
        $post_type = 'projectx_resource';

        $labels = [
            'name'               => _x( 'Resources', 'post type general name', 'projectx' ),
            'singular_name'      => _x( 'Resource', 'post type singular name', 'projectx' ),
            'menu_name'          => _x( 'Resources', 'admin menu', 'projectx' ),
            'name_admin_bar'     => _x( 'Resource', 'add new on admin bar', 'projectx' ),
            'add_new'            => _x( 'Add New', 'Resource', 'projectx' ),
            'add_new_item'       => __( 'Add New Resource', 'projectx' ),
            'new_item'           => __( 'New Resource', 'projectx' ),
            'edit_item'          => __( 'Edit Resource', 'projectx' ),
            'view_item'          => __( 'View Resource', 'projectx' ),
            'all_items'          => __( 'All Resources', 'projectx' ),
            'search_items'       => __( 'Search Resources', 'projectx' ),
            'parent_item_colon'  => __( 'Parent Resources:', 'projectx' ),
            'not_found'          => __( 'No Resources found.', 'projectx' ),
            'not_found_in_trash' => __( 'No Resources found in Trash.', 'projectx' )
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
		if ( function_exists('wp_nonce_field') ) wp_nonce_field('projectx-save', 'projectx_nonce' );

        // Retrieve an existing value from the database.
        $resource_price = isset($_GET['post']) ? get_post_meta($_GET['post'], 'resource_price', true ) : '';
        $resource_margin = isset($_GET['post']) ? get_post_meta($_GET['post'], 'resource_margin', true ) : '';
        $resource_value = isset($_GET['post']) ? get_post_meta($_GET['post'], 'resource_value', true ) : '';
        $resource_active = isset($_GET['post']) ? (get_post_meta($_GET['post'], 'resource_active', true ) == 'on' ? 'checked' : '') : '';
        $resource_start = isset($_GET['post']) ? get_post_meta($_GET['post'], 'resource_start', true ) : '';
        $resource_end = isset($_GET['post']) ? get_post_meta($_GET['post'], 'resource_end', true ) : '';
        
		// // Set default values.
		// if( empty( $guide_description ) ) $guide_description = '';

        // Form fields.
        echo '<table class="form-table">

                <tr>
                    <td>
                        <label for="value">Price</label>
                        <input id="price" name="price" type="text" value="'.$resource_price.'" />
                    </td>
                    <td>
                        <label for="margin">%</label>
                        <input id="margin" name="margin" type="text" value="'.$resource_margin.'" />
                    </td>
                    <td>
                        <label for="value">Value</label>
                        <input id="value" name="value" type="text" value="'.$resource_value.'" disabled />
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
		$nonce_name   = $_POST['projectx_nonce'] ?? '';
		$nonce_action = 'projectx-save';

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
        
        $price = sanitize_text_field($_POST['price']) ?? '';
        $margin = sanitize_text_field($_POST['margin']) ?? '';
        $value = function() use ($price, $margin) {
            $override_margin = $margin ?? 0;
            $price_float = floatval(str_replace(',', '.', $price));
            return ceil($price_float + ($price_float * ($override_margin / 100)));
        };
        $active = sanitize_text_field($_POST['active']) ?? 'off';
        $start = sanitize_text_field($_POST['start']) ?? '';
        $end = sanitize_text_field($_POST['end']) ?? '';

        // Update the meta field in the database.
		update_post_meta($_POST['post_ID'], 'resource_price', $price);
		update_post_meta($_POST['post_ID'], 'resource_margin', $margin);
		update_post_meta($_POST['post_ID'], 'resource_value', $value());
		update_post_meta($_POST['post_ID'], 'resource_active', $active);
		update_post_meta($_POST['post_ID'], 'resource_start', $start);
		update_post_meta($_POST['post_ID'], 'resource_end', $end);

    }

    public function resourceRestFields() {
        register_rest_field( 'projectx_resource', 'resource_tier', array(
            'get_callback' => function( $resource ) {
                $tier = wp_get_post_terms( $resource['id'], 'tier' );
                if ($tier) {
                    return $tier[0]->name;
                }
                return null;
            },
            'update_callback' => function( $karma, $comment_obj ) {
                $ret = wp_update_comment( array(
                    'comment_ID'    => $comment_obj->comment_ID,
                    'comment_karma' => $karma
                ) );
                if ( false === $ret ) {
                    return new WP_Error( 'rest_comment_karma_failed', __( 'Failed to update comment karma.' ), array( 'status' => 500 ) );
                }
                return true;
            },
            'schema' => array(
                'type'        => 'string'
            ),
        ) );

        register_rest_field('projectx_resource', 'resource_cat', [
            'get_callback' => function($resource) {
                $cat = wp_get_post_terms($resource['id'], 'resource_type');
                return $cat[0]->name;
            }
        ]);

        register_rest_field('projectx_resource', 'resource_val', [
            'get_callback' => function($resource) {
                $val = get_post_meta($resource['id'], 'resource_value', true);
                return $val;
            }
        ]);
    }
}