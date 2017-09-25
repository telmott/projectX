<?php

namespace ProjectX\Wp\Rest;

final class AccommodationRoute extends BaseRoute
{
    private $base = 'accommodation';
    
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
                    'terms'     => 'accommodation'
                ]
            ],
            'meta_key'   => 'resource_active',
            'meta_value' => 'on'
        ]);

        $data = [];

        foreach ($items->posts as $item) {
            $item_data = $this->prepare_item_for_response($item, $request);

            if (!isset($data[$item_data['tier']][$item_data['cat']])) {
                $data[$item_data['tier']][$item_data['cat']] = $this->prepare_response_for_collection($item_data);
            } else {
                if ($item_data['value'] > $data[$item_data['tier']][$item_data['cat']]['value']) {
                    $data[$item_data['tier']][$item_data['cat']] = $this->prepare_response_for_collection($item_data);
                }
            }
            
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
    public function prepare_item_for_response($item, $request)
    {
        $resource_value = get_post_meta($item->ID, 'resource_value', true);

        $post_terms = get_the_terms($item, 'resource_type');
        $term = array_values(array_filter($post_terms, function($item) {
            return $item->name != 'accommodation';
        }));

        $post_tier = get_the_terms($item, 'tier');

        $item_data = [
            'tier'  => $post_tier[0]->slug ?? 'no tier',
            'name'  => $item->post_title,
            'cat'   => $term[0]->name ?? 'no cat',
            'value' => $resource_value,
            'info'  => $item->post_excerpt
        ];
    
        return $item_data;
    }
}