<?php

namespace ProjectX\Wp\Rest;

final class DaysRoute extends BaseRoute
{
    private $base = 'days';

    public function start()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {
        register_rest_route($this->namespace, '/'.$this->base.'/(?P<guideId>[\d]+)', [
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
        $guide_id = $request['guideId'];
        $items = new \WP_Query([
            'post_type'     => 'projectx_day',
            'post_parent'   => $guide_id
        ]);
        $data = [];

        foreach($items->posts as $item) {
            $item_data = $this->prepare_item_for_response($item, $request);
            $data[] = $this->prepare_response_for_collection($item_data);
        }

        usort($data, function($a, $b) {
            return ($a['day']->post_title < $b['day']->post_title) ? -1 : 1;
        });
       
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
        $activities = get_post_meta($item->ID, 'activities');
        return [
            'day'   => $item,
            'act'   => array_map(function($act) {
                $act_obj = json_decode(html_entity_decode($act));
                $act_obj->img_url = get_the_post_thumbnail_url($act_obj->id, 'large');
                return $act_obj;
            }, $activities)
        ];
    }
}