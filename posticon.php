<?php
/**
 * Plugin Name: Post Icon
 * Description: A plugin to add post icons
 * Version: 0.0.1
 * Author: Vova Developenko
 * Text Domain: picon
 *
 * @package PI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define PI_PLUGIN_FILE.
if ( ! defined( 'PI_PLUGIN_FILE' ) ) {
	define( 'PI_PLUGIN_FILE', __FILE__ );
}

// Define PI_PLUGIN_PATH.
if ( ! defined( 'PI_PLUGIN_PATH' ) ) {
	define( 'PI_PLUGIN_PATH', plugin_dir_path( PI_PLUGIN_FILE ) );
}

// Define PI_PLUGIN_URL.
if ( ! defined( 'PI_PLUGIN_URL' ) ) {
	define( 'PI_PLUGIN_URL', untrailingslashit( plugins_url( '/', PI_PLUGIN_FILE ) ) );
}

// Define PI_ADMIN_TPL_PATH.
if ( ! defined( 'PI_ADMIN_TPL_PATH' ) ) {
	define( 'PI_ADMIN_TPL_PATH', PI_PLUGIN_PATH . 'templates/admin' );
}

// Include the main GH_Data class.
if ( ! class_exists( 'Post_Icon' ) ) {
	include_once PI_PLUGIN_PATH . 'include/posticon-class.php';
    $PI = new Post_Icon();
}