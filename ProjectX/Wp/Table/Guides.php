<?php

namespace ProjectX\Wp\Table;

class Guides extends BaseTable
{
    public function __construct()
    {
        global $status, $page;
        
        parent::__construct([
            'singular'  => __( 'guide', 'projectx' ),
            'plural'    => __( 'guides', 'projectx' ),
            'ajax'      => false
        ]);

        // add_action( 'admin_head', [$this, 'columnHeader']);            
    }

    public function columnHeader()
    {
        // $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
        // if( 'wprightontime' != $page )
        // return;
        echo '<style type="text/css">';
        echo '.wp-list-table .column-id { width: 5%; }';
        echo '.wp-list-table .column-calldate { width: 40%; }';
        echo '.wp-list-table .column-httpcode { width: 35%; }';
        echo '.wp-list-table .column-status { width: 20%;}';
        echo '</style>';
    }

    public function get_columns()
    {
        $columns = [
            'cb'        => '<input type="checkbox" />',
            'name'      => __('Name', 'projectx'),
            'region'    => __('Region', 'projectx'),
            'days'      => __('Days', 'projectx'),
            'status'    => __('Active', 'projectx')
        ];
        return $columns;
    }

    public function column_default( $item, $column_name )
    {
        switch( $column_name ) { 
            case 'name':
            case 'region':
            case 'days':
            case 'status':
                
            default:
                return '' ;
        }
    }

    function column_region($item)
    {
        $regions = '';

        if ($item['region']) {
            foreach ($item['region'] as $region) {
                $regions .= $region->name . ', ';
            }
        }
        
        return sprintf(
            '%s', rtrim($regions, ', ')
        );    
    }

    function column_days($item)
    {
        $tier = $item['tier'][0]->name ?? '';
        return sprintf(
            '%s', $tier
        );    
    }

    function column_status($item)
    {
        $status = get_post_meta($item['ID'], 'resource_active', true) == 'on' ? 'Yes' : 'No';
            
        return sprintf(
            '%s', $status
        );    
    }

    public function get_sortable_columns()
    {
        $sortable_columns = [
            'name'      => ['name',false],
            'region'    => ['region',false],
            'days'      => ['days',false],
            'status'    => ['status',false]
        ];
        return $sortable_columns;
    }

    public function prepareData()
    {
        foreach ($this->raw_data->posts as $resource) {
            $this->table_data[] = [
                'ID'        => $resource->ID,
                'name'      => $resource->post_title,
                'region'    => get_the_terms($resource->ID, 'region'),
                'days'      => '',
                'status'    => $resource->post_status,
            ];
        }
        return true;
    }


}