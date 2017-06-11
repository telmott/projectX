<?php

namespace LovePortugalLikeUs\Admin;

use LovePortugalLikeUs\View;

class Area
{
    private $dashboard;

    private $orders;

    private $tours;

    private $resources;

    private $settings;

    public function __construct()
    {
        $this->dashboard    = new View\ViewDashboard();
        $this->orders       = new View\ViewOrders();
        $this->tours        = new View\ViewTours();
        $this->resources    = new View\ViewResources();
        $this->settings     = new View\ViewSettings();
    }

    public function start()
    {
        $this->startAdminActions();
        // load admin scripts (styles & js)
        add_action('admin_enqueue_scripts', [$this, 'loadAdminScripts'], 10);
        add_action('admin_menu', array($this, 'adminSetup'), 10);
        add_action('admin_menu', array($this, 'ordersSubmenu'), 11);
        add_action('admin_menu', array($this, 'toursSubmenu'), 12);
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
        add_menu_page('Love Portugal Like Us', 'LPTLUS', 'manage_options', 'lptlus', array($this, 'dashboardMenuPage'), 'dashicons-location-alt', '5');
    }

    public function dashboardMenuPage()
    {
        return $this->dashboard->render();
    }

    public function ordersSubmenu()
    {
        add_submenu_page('lptlus', 'Orders', 'Orders', 'manage_options', 'lptlus-orders', array($this, 'ordersMenuPage'));
    }

    public function ordersMenuPage()
    {
        return $this->orders->render();
    }

    public function toursSubmenu()
    {
        add_submenu_page('lptlus', 'Tours', 'Tours', 'manage_options', 'lptlus-tours', array($this, 'toursMenuPage'));
    }

    public function toursMenuPage()
    {
        return $this->tours->render();
    }

    public function resourcesSubmenu()
    {
        add_submenu_page('lptlus', 'Resources', 'Resources', 'manage_options', 'lptlus-resources', array($this, 'resourcesMenuPage'));
    }

    public function resourcesMenuPage()
    {
        return $this->resources->render();
    }

    public function settigsSubmenu()
    {
        add_submenu_page('lptlus', 'Settings', 'Settings', 'manage_options', 'lptlus-settings', array($this, 'settingsMenuPage'));
    }

    public function settingsMenuPage()
    {
        return $this->settings->render();
    }

    public function loadAdminScripts()
    {
        wp_enqueue_style( 'jq-datetime-css', plugins_url('/loveportugallikeus/assets/css/jquery.datetimepicker.min.css') );
        wp_enqueue_style( 'lptlus-css', plugins_url('/loveportugallikeus/assets/css/lptlus.css') );

        wp_register_script('jq-datetime-js', plugins_url('/loveportugallikeus/assets/js/jquery.datetimepicker.full.min.js'), ['jquery'], null, true);
	    wp_enqueue_script( 'jq-datetime-js' );

        wp_register_script('datepicker-js', plugins_url('/loveportugallikeus/assets/js/datepicker.js'), ['jquery', 'jq-datetime-js'], '1', true);
	    wp_enqueue_script( 'datepicker-js' );

        wp_register_script('react-js', 'https://unpkg.com/react@15/dist/react.js', ['jquery'], '1', true);
	    wp_enqueue_script( 'react-js' );

        wp_register_script('react-dom-js', 'https://unpkg.com/react-dom@15/dist/react-dom.js', ['jquery'], '1', true);
	    wp_enqueue_script( 'react-dom-js' );

        wp_register_script('lptlus-js', plugins_url('/loveportugallikeus/assets/js/bundle.js'), ['jquery'], '1', true);
	    wp_enqueue_script( 'lptlus-js' );

    }
}