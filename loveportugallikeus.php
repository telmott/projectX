<?php
/**
 * Plugin Name: Love Portugal Like Us
 * Description: Self guided tours in Portugal for everyone ;)
 * Plugin URI:  https://loveportugallikeus.com/
 * Author:      Telmo Teixeira
 * Version:     1.0.0
 * Author URI:  https://telmoteixeira.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: lptlus
 * Domain Path: /i18n
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Define plugin constants
define('LPTLUS_ROOT', (__DIR__));
define('LPTLUS_PLUGIN_FILE', (__FILE__));

/**
 * LovePortugalLikeUs Autoloader
 * 
 * Composer psr-4 autoloader for the namespace "LovePortugalLikeUs".
 *
 * @since 0.1.0
 *
 */
require_once(LPTLUS_ROOT.'/vendor/autoload.php');

/**
 * LovePortugalLikeUs READY!
 * 
 * Starts all plugin functionality by instantition of LovePortugalLikeUs main object.
 *
 * @since 0.1.0
 *
 * @return object  LovePortugalLikeUs main object instance.
 */
function LPTLUS()
{
    // Load plugin
    $lptlus = LovePortugalLikeUs\LovePortugalLikeUs::getInstance();

    // Start plugin
    $lptlus->start();
}

// LovePortugalLikeUs GO!
LPTLUS();