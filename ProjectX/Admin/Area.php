<?php

namespace ProjectX\Admin;

use ProjectX\View;

class Area
{
    private $dashboard;

    private $orders;

    private $guides;

    private $resources;

    private $settings;

    public function __construct()
    {
        $this->dashboard    = new View\ViewDashboard();
        $this->orders       = new View\ViewOrders();
        $this->guides       = new View\ViewGuides();
        $this->resources    = new View\ViewResources();
        $this->settings     = new View\ViewSettings();
    }

    public function start()
    {
        // $this->startAdminActions();
        // load admin scripts (styles & js)
        add_action('admin_enqueue_scripts', [$this, 'loadAdminScripts'], 10);
        add_action('admin_menu', array($this, 'adminSetup'), 10);
        add_action('admin_menu', array($this, 'ordersSubmenu'), 11);
        add_action('admin_menu', array($this, 'guidesSubmenu'), 12);
        add_action('admin_menu', array($this, 'resourcesSubmenu'), 13);
        add_action('admin_menu', array($this, 'settigsSubmenu'), 14);
    }

    public function startAdminActions()
    {
        $actionDuplicate = new Action\DuplicateCPT;
        $actionDuplicate->start();
    }

    public function adminSetup()
    {
        add_menu_page('ProjectX', 'PROJECTX', 'manage_options', 'projectx', array($this, 'dashboardMenuPage'), 'dashicons-location-alt', '5');
    }

    public function dashboardMenuPage()
    {
        return $this->dashboard->render();
    }

    public function ordersSubmenu()
    {
        add_submenu_page('projectx', 'Orders', 'Orders', 'manage_options', 'projectx-orders', array($this, 'ordersMenuPage'));
    }

    public function ordersMenuPage()
    {
        return $this->orders->render();
    }

    public function guidesSubmenu()
    {
        add_submenu_page('projectx', 'Guides', 'Guides', 'manage_options', 'projectx-guides', array($this, 'guidesMenuPage'));
    }

    public function guidesMenuPage()
    {
        return $this->guides->render();
    }

    public function resourcesSubmenu()
    {
        add_submenu_page('projectx', 'Resources', 'Resources', 'manage_options', 'projectx-resources', array($this, 'resourcesMenuPage'));
    }

    public function resourcesMenuPage()
    {
        return $this->resources->render();
    }

    public function settigsSubmenu()
    {
        add_submenu_page('projectx', 'Settings', 'Settings', 'manage_options', 'projectx-settings', array($this, 'settingsMenuPage'));
    }

    public function settingsMenuPage()
    {
        return $this->settings->render();
    }

    public function loadAdminScripts()
    {
        wp_enqueue_style( 'jq-datetime-css', plugins_url('/projectx/assets/css/jquery.datetimepicker.min.css') );
        wp_enqueue_style( 'projectx-css', plugins_url('/projectx/assets/css/projectx.css') );

        wp_register_script('jq-datetime-js', plugins_url('/projectx/assets/js/jquery.datetimepicker.full.min.js'), ['jquery'], null, true);
	    wp_enqueue_script( 'jq-datetime-js' );

        wp_register_script('datepicker-js', plugins_url('/projectx/assets/js/datepicker.js'), ['jquery', 'jq-datetime-js'], '1', true);
	    wp_enqueue_script( 'datepicker-js' );

        wp_enqueue_script('projectx-admin-js', plugins_url('/projectx/assets/js/projectx-admin-bundle.js'), ['jquery'], '1', true);

        wp_localize_script('projectx-admin-js', 'projectxRest', [
            'url' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest')
        ]);
        
        $terms = wp_get_post_terms( get_the_ID(), 'region' );
        wp_localize_script('projectx-admin-js', 'guide', [
            'Id'        => get_the_ID(),
            'Region'    => empty($terms[0]->term_id) ? null : $terms[0]->term_id 
        ]);

    }
}