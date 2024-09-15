<?php
/**
 * Main theme class.
 *
 * @package iwpdev/theme
 */

namespace Iwpdev\Theme;

use Carbon_Fields\Carbon_Fields;
use Iwpdev\Theme\Blocks\GutenbergBlocks;

/**
 * Main class file.
 */
class Main {

	/**
	 * Theme version.
	 */
	const IWP_VERSION = '1.0.0';

	/**
	 * Main construct.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Init Action and filters.
	 *
	 * @return void
	 */
	private function init(): void {
		// actions.
		add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts_and_styles' ] );
		add_action( 'after_setup_theme', [ $this, 'theme_support' ] );

		// filters.
		add_filter( 'get_custom_logo', [ $this, 'output_logo' ] );
		add_filter( 'mime_types', [ $this, 'add_support_mimes' ] );

		// Int classes.
		new GutenbergBlocks();
		new CPT();
		new CarbonFields();
	}

	/**
	 * Add scripts and style.
	 *
	 * @return void
	 */
	public function add_scripts_and_styles(): void {
		$url = get_stylesheet_directory_uri();
		$min = '.min';

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			$min = '';
		}

		wp_enqueue_script( 'iwp_gsap', $url . '/assets/js/gsap.min.js', [], self::IWP_VERSION, true );
		wp_enqueue_script( 'iwp_scroll_trigger', $url . '/assets/js/ScrollTrigger.min.js', [], self::IWP_VERSION, true );
		wp_enqueue_script( 'iwp_scroll_smoother', $url . '/assets/js/ScrollSmoother.min.js', [], self::IWP_VERSION, true );
		wp_enqueue_script( 'iwp_slick', $url . '/assets/js/slick.min.js', [ 'jquery' ], self::IWP_VERSION, true );
		wp_enqueue_script( 'iwp_build', $url . '/assets/js/build' . $min . '.js', [ 'jquery' ], self::IWP_VERSION, true );

		wp_enqueue_script( 'html5shiv', '//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', [], '3.7.0', false );
		wp_enqueue_script( 'respond', '//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', [], '1.4.2', false );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
		wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

		wp_enqueue_style( 'iwp_slick', $url . '/assets/css/slick' . $min . '.css', '', self::IWP_VERSION );
		wp_enqueue_style( 'iwp_slick_theme', $url . '/assets/css/slick-theme' . $min . '.css', '', self::IWP_VERSION );
		wp_enqueue_style( 'iwp_main', $url . '/assets/css/main' . $min . '.css', '', self::IWP_VERSION );
	}

	/**
	 * Theme support.
	 *
	 * @return void
	 */
	public function theme_support(): void {

		// register menu.
		register_nav_menus(
			[
				'header_menu' => __( 'Main Menu', 'iwpdev' ),
				'footer_menu' => __( 'Footer Menu', 'iwpdev' ),
			]
		);

		// images sizes.
		add_image_size( 'portfolio_thumbnail', 604, 9999, [ 'top', 'center' ] );
		add_image_size( 'post_thumbnail', 411, 231, [ 'top', 'center' ] );

		// add custom logo.
		add_theme_support( 'custom-logo', [ 'unlink-homepage-logo' => true ] );
		add_theme_support( 'post-thumbnails' );

		// carbone fields init.
		Carbon_Fields::boot();
	}

	/**
	 * Change output custom logo.
	 *
	 * @param string $html HTML custom logo.
	 *
	 * @return string
	 */
	public function output_logo( string $html ): string {

		$home  = esc_url( get_bloginfo( 'url' ) );
		$class = 'logo';
		if ( has_custom_logo() ) {
			$logo    = wp_get_attachment_image(
				get_theme_mod( 'custom_logo' ),
				'full',
				false,
				[
					'class'    => 'black-logo',
					'itemprop' => 'logo',
				]
			);
			$content = $logo;

			$content .= '<span class="sr-only">' . get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' ) . '</span>';

			$html = sprintf(
				'<a href="%s" class="%s" rel="home" itemprop="url">%s</a>',
				$home,
				$class,
				$content
			);

		}

		return $html;
	}

	/**
	 * Add SVG and Webp formats to upload.
	 *
	 * @param array $mimes Mimes type.
	 *
	 * @return array
	 */
	public function add_support_mimes( array $mimes ): array {

		$mimes['webp'] = 'image/webp';
		$mimes['svg']  = 'image/svg+xml';

		return $mimes;
	}
}
