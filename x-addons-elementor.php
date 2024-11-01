<?php
/*
 * Plugin Name:       X Addons for Elementor
 * Plugin URI:        #
 * Description:       The Ultimate Elementor Addons.
 * Version:           1.0.5
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            PencilWp
 * Author URI:        https://pencilwp.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       x-addons-elementor
 * Domain Path:       /languages
 * 
 * Elementor tested up to: 3.19.0
 * Elementor Pro tested up to: 3.19.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Load X Addons Plugin
function xaddons_elementor() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\xaddons_Elementor\Plugin::instance();

}
add_action( 'plugins_loaded', 'xaddons_elementor' );

// Load X Addons Assets
function xaddons_elementor_assets(){
	wp_enqueue_style( 'video-popup-css', plugin_dir_url( __FILE__ ) . 'assets/css/video-popup.css', array(), '2.4.6' );
	wp_enqueue_style( 'slick-css', plugin_dir_url( __FILE__ ) . 'assets/css/slick.css', array(), '1.0' );
	wp_enqueue_style( 'fancy-box-css', plugin_dir_url( __FILE__ ) . 'assets/css/fancy-box.css', array(), '3.5.7' );
	wp_enqueue_style( 'odometer-css', plugin_dir_url( __FILE__ ) . 'assets/css/odometer.css', array(), '1.0' );
	wp_enqueue_style( 'xa-styles', plugin_dir_url( __FILE__ ) . 'assets/css/xa-styles.css', array(), '1.0' );
	wp_enqueue_script( 'slick-js', plugin_dir_url( __FILE__ ) . 'assets/js/slick.js', array('jquery'), '2.0', true );
	wp_enqueue_script( 'video-popup-js', plugin_dir_url( __FILE__ ) . 'assets/js/video-popup.js', array(), '2.4.6', true );
	wp_enqueue_script( 'odometer', plugin_dir_url( __FILE__ ) . 'assets/js/odometer.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'circle-progress', plugin_dir_url( __FILE__ ) . 'assets/js/circle-progress.js', array('jquery'), '1.2.2', true );
	wp_enqueue_script( 'fancy-box-js', plugin_dir_url( __FILE__ ) . 'assets/js/fancy-box.js', array('jquery'), '3.5.7', true );
	wp_enqueue_script( 'typed-js', plugin_dir_url( __FILE__ ) . 'assets/js/typed.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'plugin', plugin_dir_url( __FILE__ ) . 'assets/js/plugin-active.js', array('jquery'), '1.0', true );
}
add_action('wp_enqueue_scripts', 'xaddons_elementor_assets');


function xaddons_elementor_textdomain() {
    load_plugin_textdomain( 'x-addons-elementor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'xaddons_elementor_textdomain' );
