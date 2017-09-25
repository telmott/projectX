<?php

namespace ProjectX\Wp\Table;

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

use WP_List_Table;

abstract class BaseTable extends WP_List_Table
{
    public $table_data = [];

    public $raw_data;

    public function prepare_items()
    {
        $columns  = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [$columns, $hidden, $sortable];
        if (! empty($this->raw_data)) {
            $this->prepareData();
        
            $per_page = 20;
            $current_page = $this->get_pagenum();
            $total_items = count( $this->table_data );

            $this->set_pagination_args([
                'total_items' => $total_items,
                'per_page'    => $per_page
            ]);
            $this->items = array_slice( $this->table_data,( ( $current_page-1 )* $per_page ), $per_page );
        }
    }

    public function get_bulk_actions()
    {
        $actions = [];
        return $actions;
    }

    public function no_items() {
        _e( 'No items found.', 'projectx' );
    }

    public function column_name($item)
    {
        $actions = [
            'qedit'     => 'Quick edit',
            'delete'    => 'Delete',
            'duplicate' => '<a href="'.\wp_nonce_url('admin.php?action=projectx_duplicate&post='.$item['ID'] , 'projectx_duplicate_action', 'projectx_duplicate_nonce').'" title="Duplicate" rel="permalink">Duplicate</a>'
        ];

        return sprintf(
            '<strong><a class="row-title" href="http://localhost/wp-projectx.com/wp-admin/post.php?post=%2$d&amp;action=edit" aria-label="“%1$s” (Edit)">%1$s</a></strong> %3$s', $item['name'], $item['ID'], $this->row_actions($actions));
    }

    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="projectx[]" value="%s" />', $item['ID']
        );    
    }
}