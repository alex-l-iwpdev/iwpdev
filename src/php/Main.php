<?php
/**
 * Main theme class.
 *
 * @package iwpdev/theme
 */

namespace Iwpdev\Theme;

use Carbon_Fields\Carbon_Fields;
use DOMDocument;
use DOMXPath;
use Iwpdev\Theme\Blocks\GutenbergBlocks;
use WP_Query;

/**
 * Main class file.
 */
class Main {

	/**
	 * Theme version.
	 */
	const IWP_VERSION = '1.0.0';

	/**
	 * Review table name.
	 */
	const IWP_REVIEW_TABLE_NAME = 'review_rating_post';

	/**
	 * Review action and nonce name.
	 */
	const IWP_REVIEW_ACTION_NAME = 'review_rating_action_name';

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
		add_action( 'init', [ $this, 'add_review_post' ] );
		add_action( 'pre_get_posts', [ $this, 'fix_404_error' ] );

		// filters.
		add_filter( 'get_custom_logo', [ $this, 'output_logo' ] );
		add_filter( 'mime_types', [ $this, 'add_support_mimes' ] );
		add_filter( 'wpcf7_form_elements', [ $this, 'delete_span_el' ] );

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
		wp_enqueue_script( 'iwp_highlight',  'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js', [], self::IWP_VERSION, true );
		wp_enqueue_script( 'highlightjs_line_numbers', $url . '/assets/js/highlightjs-line-numbers.min.js', [], self::IWP_VERSION, true );
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
		wp_enqueue_style( 'iwp_github_dark', $url . '/assets/css/github-dark' . $min . '.css', '', self::IWP_VERSION );
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
		add_image_size( 'single_post_thumbnail', 1332, 749, [ 'top', 'center' ] );

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

	/**
	 * Add custom table reviews bot.
	 *
	 * @return void
	 */
	public function add_review_post(): void {
		global $wpdb;

		$review_table_created = get_option( 'iwp_review_table_created', false );

		if ( ! $review_table_created ) {
			$table_name      = $wpdb->prefix . self::IWP_REVIEW_TABLE_NAME;
			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE $table_name (
			        id INT NOT NULL AUTO_INCREMENT,
			        post_id INT NOT NULL,
			        comment_id INT NOT NULL,
			        rating DECIMAL(3,2) NULL DEFAULT NULL,
			        status VARCHAR(20) NOT NULL DEFAULT 'draft',
			        date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			        PRIMARY KEY (id),
			        INDEX idx_post_id_status (post_id, status)
			    ) $charset_collate;";

			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			dbDelta( $sql );

			add_option( 'iwp_review_table_created', true, '', true );
		}
	}

	/**
	 * Fix 404 error on pagination.
	 *
	 * @param WP_Query $q WP Query.
	 *
	 * @return void
	 */
	public function fix_404_error( WP_Query $q ): void {
		if ( is_admin() || ! $q->is_main_query() || ! is_post_type_archive( 'portfolio' ) ) {
			return;
		}

		$q->set( 'posts_per_page', $q->query_vars['paged'] );
	}

	/**
	 * Delete span element in contact form.
	 *
	 * @param string $content Content.
	 *
	 * @return false|string
	 */
	public function delete_span_el( string $content ) {
		// Enable internal errors for libxml.
		libxml_use_internal_errors( true );

		$dom = new DOMDocument();
		//phpcs:ignore
		$dom->preserveWhiteSpace = false;

		$dom->loadHTML( $content );

		$xpath = new DomXPath( $dom );
		$spans = $xpath->query( "//span[contains(@class, 'wpcf7-form-control-wrap')]" );

		foreach ( $spans as $span ) {
			//phpcs:ignore
			$children = $span->firstChild;

			//phpcs:ignore
			$span->parentNode->replaceChild( $children, $span );
		}

		return $dom->saveHTML();
	}
}
