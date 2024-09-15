<?php
/**
 * Add carbon fields in post type, and theme options.
 *
 * @package iwpdev/theme
 */

namespace Iwpdev\Theme;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * CarbonFields class file.
 */
class CarbonFields {
	/**
	 * CarbonFields construct.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Init action and filter.
	 *
	 * @return void
	 */
	private function init(): void {
		add_action( 'carbon_fields_register_fields', [ $this, 'add_fields_in_testimonials' ] );
	}

	/**
	 * Add field in testimonials.
	 *
	 * @return void
	 */
	public function add_fields_in_testimonials(): void {
		Container::make(
			'post_meta',
			__( 'Testimonials', 'iwpdev' )
		)->where(
			'post_type',
			'=',
			'testimonials'
		)->add_fields(
			[
				Field::make( 'text', 'iwp_position', __( 'Position', 'iwpdev' ) )->set_width( 50 ),
				Field::make( 'image', 'iwp_avatar', __( 'Avatar image', 'iwpdev' ) )->set_width( 50 ),
				Field::make(
					'text',
					'iwp_platform_review_name',
					__( 'Platform review', 'iwpdev' )
				)->set_width( 50 ),
				Field::make(
					'text',
					'iwp_platform_review_link',
					__( 'Platform review link', 'iwpdev' )
				)->set_width( 50 ),
			]
		);
	}
}
