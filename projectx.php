<?php
/**
 * Plugin Name: ProjectX
 * Description: Self guided tours in Portugal for everyone ;)
 * Plugin URI:  https://projectx.com/
 * Author:      Telmo Teixeira
 * Version:     1.0.0
 * Author URI:  https://telmoteixeira.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: projectx
 * Domain Path: /i18n
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Define plugin constants
define('PROJECTX_ROOT', (__DIR__));
define('PROJECTX_PLUGIN_FILE', (__FILE__));

/**
 * ProjectX Autoloader
 * 
 * Composer psr-4 autoloader for the namespace "ProjectX".
 *
 * @since 0.1.0
 *
 */
require_once(PROJECTX_ROOT.'/vendor/autoload.php');

/**
 * ProjectX READY!
 * 
 * Starts all plugin functionality by instantition of ProjectX main object.
 *
 * @since 0.1.0
 *
 * @return object  ProjectX main object instance.
 */
function PROJECTXRun()
{
    // Load plugin
    $ptouside = ProjectX\ProjectX::getInstance();

    // Start plugin
    $ptouside->start();
}

// ProjectX GO!
PROJECTXRun();