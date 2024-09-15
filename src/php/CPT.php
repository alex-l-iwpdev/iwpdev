<?php
/**
 * Register custom post types.
 *
 * @package iwpdev/theme
 */

namespace Iwpdev\Theme;

/**
 * CPT class file.
 */
class CPT {

	/**
	 * CPT construct.
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
		add_action( 'init', [ $this, 'register_portfolio_category' ] );
		add_action( 'init', [ $this, 'register_portfolio_cpt' ] );
	}

	/**
	 * Register taxonomy portfolio category.
	 *
	 * @return void
	 */
	public function register_portfolio_category(): void {
		register_taxonomy(
			'portfolio-category',
			[ 'portfolio' ],
			[
				'label'             => '',
				'labels'            => [
					'name'              => __( 'Portfolio Categories', 'iwpdev' ),
					'singular_name'     => __( 'Portfolio Category', 'iwpdev' ),
					'search_items'      => __( 'Search Portfolio Categories', 'iwpdev' ),
					'all_items'         => __( 'All Portfolio Categories', 'iwpdev' ),
					'view_item '        => __( 'View Portfolio Category', 'iwpdev' ),
					'parent_item'       => __( 'Parent Portfolio Category', 'iwpdev' ),
					'parent_item_colon' => __( 'Parent Portfolio Category:', 'iwpdev' ),
					'edit_item'         => __( 'Edit Portfolio Category', 'iwpdev' ),
					'update_item'       => __( 'Update Portfolio Category', 'iwpdev' ),
					'add_new_item'      => __( 'Add New Portfolio Category', 'iwpdev' ),
					'new_item_name'     => __( 'New Portfolio Category Name', 'iwpdev' ),
					'menu_name'         => __( 'Portfolio Categories', 'iwpdev' ),
					'back_to_items'     => __( 'Back to Portfolio Categories', 'iwpdev' ),
				],
				'description'       => '',
				'public'            => true,
				'hierarchical'      => true,
				'rewrite'           => true,
				'capabilities'      => [ 'manage_terms' ],
				'show_admin_column' => true,
				'show_in_rest'      => true,
			]
		);

		register_taxonomy(
			'portfolio-industry',
			[ 'portfolio' ],
			[
				'label'             => '',
				'labels'            => [
					'name'              => __( 'Portfolio Industry', 'iwpdev' ),
					'singular_name'     => __( 'Portfolio Industry', 'iwpdev' ),
					'search_items'      => __( 'Search Portfolio Industry', 'iwpdev' ),
					'all_items'         => __( 'All Portfolio Industry', 'iwpdev' ),
					'view_item '        => __( 'View Portfolio Industry', 'iwpdev' ),
					'parent_item'       => __( 'Parent Portfolio Industry', 'iwpdev' ),
					'parent_item_colon' => __( 'Parent Portfolio Industry:', 'iwpdev' ),
					'edit_item'         => __( 'Edit Portfolio Industry', 'iwpdev' ),
					'update_item'       => __( 'Update Portfolio Industry', 'iwpdev' ),
					'add_new_item'      => __( 'Add New Portfolio Industry', 'iwpdev' ),
					'new_item_name'     => __( 'New Portfolio Industry Name', 'iwpdev' ),
					'menu_name'         => __( 'Portfolio Industry', 'iwpdev' ),
					'back_to_items'     => __( 'Back to Portfolio Industry', 'iwpdev' ),
				],
				'description'       => '',
				'public'            => true,
				'hierarchical'      => true,
				'rewrite'           => true,
				'capabilities'      => [ 'manage_terms' ],
				'show_admin_column' => true,
				'show_in_rest'      => true,
			]
		);
	}

	/**
	 * Register CPT portfolio.
	 *
	 * @return void
	 */
	public function register_portfolio_cpt(): void {
		register_post_type(
			'portfolio',
			[
				'label'         => null,
				'labels'        => [
					'name'               => __( 'Portfolio', 'iwpdev' ),
					'singular_name'      => __( 'Portfolio', 'iwpdev' ),
					'add_new'            => __( 'Add Portfolio', 'iwpdev' ),
					'add_new_item'       => __( 'Add New Portfolio', 'iwpdev' ),
					'edit_item'          => __( 'Edit Portfolio', 'iwpdev' ),
					'new_item'           => __( 'New Portfolio', 'iwpdev' ),
					'view_item'          => __( 'View Portfolio', 'iwpdev' ),
					'search_items'       => __( 'Search Portfolio', 'iwpdev' ),
					'not_found'          => __( 'No Portfolio found', 'iwpdev' ),
					'not_found_in_trash' => __( 'No Portfolio found in Trash', 'iwpdev' ),
					'parent_item_colon'  => __( 'Parent Portfolio:', 'iwpdev' ),
					'menu_name'          => __( 'Portfolio', 'iwpdev' ),
				],
				'description'   => '',
				'public'        => true,
				'show_in_menu'  => true,
				'show_in_rest'  => true,
				'menu_position' => 20,
				//phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
				'menu_icon'     => 'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="fill: #a7aaad"><path d="M0 96l576 0c0-35.3-28.7-64-64-64L64 32C28.7 32 0 60.7 0 96zm0 32L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-288L0 128zM64 405.3c0-29.5 23.9-53.3 53.3-53.3l117.3 0c29.5 0 53.3 23.9 53.3 53.3c0 5.9-4.8 10.7-10.7 10.7L74.7 416c-5.9 0-10.7-4.8-10.7-10.7zM176 192a64 64 0 1 1 0 128 64 64 0 1 1 0-128zm176 16c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16z"/></svg>' ),
				'hierarchical'  => false,
				'supports'      => [
					'title',
					'editor',
					'author',
					'thumbnail',
					'excerpt',
					'custom-fields',
					'comments',
					'revisions',
				],
				'taxonomies'    => [ 'portfolio-category' ],
				'has_archive'   => true,
				'rewrite'       => true,
				'query_var'     => true,
			]
		);

		register_post_type(
			'testimonials',
			[
				'label'         => null,
				'labels'        => [
					'name'               => __( 'Testimonials', 'iwpdev' ),
					'singular_name'      => __( 'Testimonials', 'iwpdev' ),
					'add_new'            => __( 'Add Testimonials', 'iwpdev' ),
					'add_new_item'       => __( 'Add New Testimonials', 'iwpdev' ),
					'edit_item'          => __( 'Edit Testimonials', 'iwpdev' ),
					'new_item'           => __( 'New Testimonials', 'iwpdev' ),
					'view_item'          => __( 'View Testimonials', 'iwpdev' ),
					'search_items'       => __( 'Search Testimonials', 'iwpdev' ),
					'not_found'          => __( 'No Testimonials found', 'iwpdev' ),
					'not_found_in_trash' => __( 'No Testimonials found in Trash', 'iwpdev' ),
					'parent_item_colon'  => __( 'Parent Testimonials:', 'iwpdev' ),
					'menu_name'          => __( 'Testimonials', 'iwpdev' ),
				],
				'description'   => '',
				'public'        => true,
				'show_in_menu'  => true,
				'show_in_rest'  => true,
				'menu_position' => 20,
				//phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
				'menu_icon'     => 'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" style="fill: #a7aaad"><path d="M88.2 309.1c9.8-18.3 6.8-40.8-7.5-55.8C59.4 230.9 48 204 48 176c0-63.5 63.8-128 160-128s160 64.5 160 128s-63.8 128-160 128c-13.1 0-25.8-1.3-37.8-3.6c-10.4-2-21.2-.6-30.7 4.2c-4.1 2.1-8.3 4.1-12.6 6c-16 7.2-32.9 13.5-49.9 18c2.8-4.6 5.4-9.1 7.9-13.6c1.1-1.9 2.2-3.9 3.2-5.9zM208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 41.8 17.2 80.1 45.9 110.3c-.9 1.7-1.9 3.5-2.8 5.1c-10.3 18.4-22.3 36.5-36.6 52.1c-6.6 7-8.3 17.2-4.6 25.9C5.8 378.3 14.4 384 24 384c43 0 86.5-13.3 122.7-29.7c4.8-2.2 9.6-4.5 14.2-6.8c15.1 3 30.9 4.5 47.1 4.5zM432 480c16.2 0 31.9-1.6 47.1-4.5c4.6 2.3 9.4 4.6 14.2 6.8C529.5 498.7 573 512 616 512c9.6 0 18.2-5.7 22-14.5c3.8-8.8 2-19-4.6-25.9c-14.2-15.6-26.2-33.7-36.6-52.1c-.9-1.7-1.9-3.4-2.8-5.1C622.8 384.1 640 345.8 640 304c0-94.4-87.9-171.5-198.2-175.8c4.1 15.2 6.2 31.2 6.2 47.8l0 .6c87.2 6.7 144 67.5 144 127.4c0 28-11.4 54.9-32.7 77.2c-14.3 15-17.3 37.6-7.5 55.8c1.1 2 2.2 4 3.2 5.9c2.5 4.5 5.2 9 7.9 13.6c-17-4.5-33.9-10.7-49.9-18c-4.3-1.9-8.5-3.9-12.6-6c-9.5-4.8-20.3-6.2-30.7-4.2c-12.1 2.4-24.8 3.6-37.8 3.6c-61.7 0-110-26.5-136.8-62.3c-16 5.4-32.8 9.4-50 11.8C279 439.8 350 480 432 480z"/></svg>' ),
				'hierarchical'  => false,
				'supports'      => [
					'title',
					'editor',
					'author',
					'thumbnail',
					'excerpt',
					'custom-fields',
					'comments',
					'revisions',
				],
				'taxonomies'    => [],
				'has_archive'   => false,
				'rewrite'       => true,
				'query_var'     => true,
			]
		);
	}
}
