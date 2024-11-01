<?php

namespace xaddons_Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Function to add Elementor widget categories
function add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
        'x-addons',
        [
            'title' => esc_html__( 'X Addons', 'x-addons-elementor' ),
            'icon' => 'fa fa-plug',
        ]
    );
}
// Hook to register widget categories
add_action( 'elementor/elements/categories_registered', 'xaddons_Elementor\add_elementor_widget_categories' );


final class Plugin {

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.19.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \xaddons_Elementor\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \xaddons_Elementor\Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	
		$elementor_url = 'https://wordpress.org/plugins/elementor/';
	
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires %2$s to be installed and activated.', 'x-addons-elementor' ),
			'<strong>' . esc_html__( 'X-Addons for Elementor', 'x-addons-elementor' ) . '</strong>',
			'<a href="' . esc_url( $elementor_url ) . '"><strong>' . esc_html__( 'Elementor', 'x-addons-elementor' ) . '</strong></a>'
		);
	
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}
	
	

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'x-addons-elementor' ),
			'<strong>' . esc_html__( 'X Addons for Elementor', 'x-addons-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'x-addons-elementor' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
	
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	
	}
	

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'x-addons-elementor' ),
			'<strong>' . esc_html__( 'X Addons for Elementor', 'x-addons-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'x-addons-elementor' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
	
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}
	

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		
		require_once( __DIR__ . '/widgets/xa-button.php' );
		require_once( __DIR__ . '/widgets/xa-hero-personal.php' );
		require_once( __DIR__ . '/widgets/xa-section-title.php' );
		require_once( __DIR__ . '/widgets/xa-service-card.php' );
		require_once( __DIR__ . '/widgets/xa-ex-image.php' );
		require_once( __DIR__ . '/widgets/xa-list-style.php' );
		require_once( __DIR__ . '/widgets/xa-ex-card.php' );
		require_once( __DIR__ . '/widgets/xa-progress-list.php' );
		require_once( __DIR__ . '/widgets/xa-circle-progress.php' );
		require_once( __DIR__ . '/widgets/xa-portfolio-slider.php' );
		require_once( __DIR__ . '/widgets/xa-cta.php' );
		require_once( __DIR__ . '/widgets/xa-testimonials.php' );
		require_once( __DIR__ . '/widgets/xa-contact-card.php' );
		require_once( __DIR__ . '/widgets/xa-contact-form7.php' );
		require_once( __DIR__ . '/widgets/xa-brand-logos.php' );
		require_once( __DIR__ . '/widgets/xa-blog.php' );

		$widgets_manager->register( new \xaddons_button_Widget() );		
		$widgets_manager->register( new \xaddons_hero_personal_Widget() );	
		$widgets_manager->register( new \xaddons_section_title_Widget() );	
		$widgets_manager->register( new \xaddons_service_card_Widget() );
		$widgets_manager->register( new \xaddons_ex_image_Widget() );
		$widgets_manager->register( new \xaddons_list_style_Widget() );
		$widgets_manager->register( new \xaddons_ex_card_Widget() );
		$widgets_manager->register( new \xaddons_progress_list_Widget() );
		$widgets_manager->register( new \xaddons_circle_progress_Widget() );
		$widgets_manager->register( new \xaddons_portfolio_slider_widget() );
		$widgets_manager->register( new \xaddons_cta_Widget() );
		$widgets_manager->register( new \xaddons_testimonials_widget() );
		$widgets_manager->register( new \xaddons_contact_card_Widget() );
		$widgets_manager->register( new \xaddons_contact_form7_widget() );
		$widgets_manager->register( new \xaddons_brand_logos_widget() );
		$widgets_manager->register( new \xaddons_blog_Widget() );
	}


}

