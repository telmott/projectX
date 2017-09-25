<?php

namespace ProjectX\Wp\Rest;

final class TransportRoute extends BaseRoute
{
    private $base = 'transport';

    public function start()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {
        register_rest_route($this->namespace, '/'.$this->base.'/(?P<regionId>[\d]+)', [
            [
                'methods'   => \WP_REST_Server::READABLE,
                'callback'  => [$this, 'getItems']
            ]
        ]);
    }

    /**
     * Get the requested Items from wp_query
     *
     * @param object $request WP_REST_Request
     * @return object WP_REST_Response object
     */
    public function getItems($request)
    {
        $region_id = $request['regionId'];

        $items = new \WP_Query([
            'post_type' => 'projectx_resource',
            'tax_query' => [
                'relations' => 'AND',
                [
                    'taxonomy'  => 'region',
                    'field'     => 'term_id',
                    'terms'     => $region_id
                ],
                [
                    'taxonomy'  => 'resource_type',
                    'field'     => 'slug',
                    'terms'     => 'transportation'
                ]
            ],
            'meta_key'   => 'resource_active',
            'meta_value' => 'on'
        ]);

        $data = [];

        foreach($items->posts as $item) {
            $item_data = $this->prepare_item_for_response($item, $request);
            $data[$item_data['cat']][] = $this->prepare_response_for_collection($item_data);
        }

        return new \WP_REST_Response($data, 200);
    }
 
    /**
     * Prepare the item for the REST response
     *
     * @param mixed $item WordPress representation of the item.
     * @param WP_REST_Request $request Request object.
     * @return mixed
     */
    public function prepare_item_for_response( $item, $request ) {
        $resource_value = get_post_meta($item->ID, 'resource_value', true);

        $post_terms = get_the_terms($item, 'resource_type');
        $term = array_values(array_filter($post_terms, function($item) {
            return $item->name != 'transportation';
        }));

        $item_data = [
            'name'  => $item->post_title,
            'cat'   => $term[0]->name,
            'value' => $resource_value,
            'info'  => $item->post_excerpt
        ];
    
        return $item_data;
    }
}