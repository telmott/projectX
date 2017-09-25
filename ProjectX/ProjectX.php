<?php

namespace ProjectX;

final class ProjectX
{
    protected static $instance = null;

	protected $admin_area;
	
	protected $post_types;

	protected $view_template;

	protected $rest_routes;

    public static function getInstance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		$this->taxonomies 	= new Wp\Taxonomies;
		$this->post_types 	= new Wp\CustomPostTypes;
		$this->rest_routes	= new Wp\RestRoutes;
		$this->admin_area 	= new Admin\Area;
		// $this->view_template = new View\ViewTemplate;
	}

	public function start()
	{
		// load taxonomies
		$this->taxonomies->start();

		// load custom post types
		$this->post_types->start();

		// load custom rest routes API
		$this->rest_routes->start();
		
		if (is_admin()) {
			$this->admin_area->start();
		}

		// if(!is_admin()) {
		// 	$this->view_template->start();
		// }
	}
    
}