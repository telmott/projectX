<?php

namespace LovePortugalLikeUs;

final class LovePortugalLikeUs
{
    protected static $instance = null;

	protected $admin_area;
	
	protected $post_types;

    public static function getInstance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		$this->taxonomies = new Wp\Taxonomies;
		$this->post_types = new Wp\CustomPostTypes;
		$this->admin_area = new Admin\Area;
	}

	public function start()
	{
		// load taxonomies
		$this->taxonomies->start();

		// load custom post types
		$this->post_types->start();
		
		if (is_admin()) {
			$this->admin_area->start();
		}
	}
    
}