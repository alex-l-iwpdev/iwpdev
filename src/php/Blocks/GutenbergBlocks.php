<?php
/**
 * Gutenberg block.
 *
 * @package iwpdev/theme
 */

namespace Iwpdev\Theme\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;
use Iwpdev\Theme\Helpers\BackEndHelpers;

/**
 * GutenbergBlocks class file.
 */
class GutenbergBlocks {

	/**
	 * GutenbergBlocks construct.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Init action and filters.
	 *
	 * @return void
	 */
	private function init(): void {
		add_action( 'carbon_fields_register_fields', [ $this, 'add_gutenberg_blocks' ] );
	}

	/**
	 * Gutenberg block fields.
	 *
	 * @return void
	 */
	public function add_gutenberg_blocks(): void {

		// Main banner.
		Block::make(
			__( 'Main banner', 'iwpdev' )
		)->add_fields(
			[
				Field::make( 'textarea', 'iwp_banner_title', __( 'Title', 'iwpdev' ) ),
				Field::make( 'textarea', 'iwp_banner_description', __( 'Description', 'iwpdev' ) ),
				Field::make( 'text', 'iwp_button_text', __( 'Button text', 'iwpdev' ) )->set_width( 50 ),
				Field::make( 'text', 'iwp_button_link', __( 'Button link', 'iwpdev' ) )->set_width( 50 ),
				Field::make( 'image', 'iwp_image', __( 'Image', 'iwpdev' ) ),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/main',
					'banner',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);

		// Icon item.
		Block::make(
			__( 'Icon items', 'iwpdev' )
		)->add_fields(
			[
				Field::make(
					'complex',
					'iwp_icons',
					__( 'Icons', 'iwpdev' )
				)->add_fields(
					[
						Field::make( 'text', 'icon_class', __( 'Icon class', 'iwpdev' ) ),
					]
				),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/icons',
					'block',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);

		// Services.
		Block::make(
			__( 'Services', 'iwpdev' )
		)->add_fields(
			[
				Field::make(
					'complex',
					'iwp_services',
					__( 'Services', 'iwpdev' )
				)->add_fields(
					[
						Field::make( 'text', 'service_icon_name', __( 'Icon name', 'iwpdev' ) ),
						Field::make( 'text', 'service_title', __( 'Services title', 'iwpdev' ) ),
						Field::make( 'rich_text', 'service_description', __( 'Services description', 'iwpdev' ) ),
						Field::make( 'text', 'service_link', __( 'Services Link', 'iwpdev' ) ),
					]
				),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/services',
					'block',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);

		// Portfolio.
		Block::make(
			__( 'Portfolio', 'iwpdev' )
		)->add_fields(
			[
				Field::make(
					'association',
					'iwp_portfolio',
					__( 'Portfolio items', 'iwpdev' )
				)->set_types(
					[
						[
							'type'      => 'post',
							'post_type' => 'portfolio',
						],
					]
				),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/portfolio',
					'block',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);

		// Testimonials.
		Block::make(
			__( 'Testimonials', 'iwpdev' )
		)->add_fields(
			[
				Field::make( 'text', 'count_output', __( 'Count output', 'iwpdev' ) ),
				Field::make( 'text', 'count_one_row', __( 'Count in row output', 'iwpdev' ) ),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/testimonials',
					'block',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);

		// Blog.
		Block::make(
			__( 'Blog', 'iwpdev' )
		)->add_fields(
			[
				Field::make( 'text', 'count_output', __( 'Count output', 'iwpdev' ) ),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/blog',
					'block',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);

		// CTA.
		Block::make(
			__( 'CTA', 'iwpdev' )
		)->add_fields(
			[
				Field::make( 'textarea', 'title', __( 'Title', 'iwpdev' ) ),
				Field::make( 'textarea', 'sub_title', __( 'Sub title', 'iwpdev' ) ),
				Field::make( 'text', 'form_shot_code', __( 'Form short code', 'iwpdev' ) ),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/cta',
					'block',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);

		// Blog loop.
		Block::make(
			__( 'Blog loop', 'iwpdev' )
		)->add_fields(
			[
				Field::make( 'text', 'count_to_row', __( 'Count to row', 'iwpdev' ) ),
				Field::make( 'text', 'posts_per_page', __( 'Post per page', 'iwpdev' ) ),
				Field::make(
					'select',
					'order',
					__( 'Order', 'iwpdev' )
				)->set_options(
					[
						'ASC'  => __( 'Ascending', 'iwpdev' ),
						'DESC' => __( 'Descending', 'iwpdev' ),
					]
				),
				Field::make(
					'multiselect',
					'category',
					__( 'Category', 'iwpdev' )
				)->set_options( BackEndHelpers::get_term_to_select( 'category' ) ),
				Field::make(
					'multiselect',
					'tags',
					__( 'Tags', 'iwpdev' )
				)->set_options( BackEndHelpers::get_term_to_select( 'post_tag' ) ),
				Field::make(
					'select',
					'order_by',
					__( 'Order by', 'iwpdev' )
				)->set_options(
					[
						'ID'              => __( 'ID', 'iwpdev' ),
						'author'          => __( 'Author', 'iwpdev' ),
						'title'           => __( 'Title', 'iwpdev' ),
						'name'            => __( 'Name', 'iwpdev' ),
						'date'            => __( 'Date', 'iwpdev' ),
						'modified'        => __( 'Modified', 'iwpdev' ),
						'parent'          => __( 'Parent', 'iwpdev' ),
						'rand'            => __( 'Rand', 'iwpdev' ),
						'comment_count'   => __( 'Comment count', 'iwpdev' ),
						'post__in'        => __( 'Post in', 'iwpdev' ),
						'post_name__in'   => __( 'Post name in', 'iwpdev' ),
						'post_parent__in' => __( 'Post parent in', 'iwpdev' ),
					]
				),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/blog',
					'loop',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);

		// Portfolio loop.
		Block::make(
			__( 'Portfolio loop', 'iwpdev' )
		)->add_fields(
			[
				Field::make( 'text', 'posts_per_page', __( 'Post per page', 'iwpdev' ) ),
				Field::make(
					'select',
					'order',
					__( 'Order', 'iwpdev' )
				)->set_options(
					[
						'ASC'  => __( 'Ascending', 'iwpdev' ),
						'DESC' => __( 'Descending', 'iwpdev' ),
					]
				),
				Field::make(
					'select',
					'order_by',
					__( 'Order by', 'iwpdev' )
				)->set_options(
					[
						'ID'              => __( 'ID', 'iwpdev' ),
						'author'          => __( 'Author', 'iwpdev' ),
						'title'           => __( 'Title', 'iwpdev' ),
						'name'            => __( 'Name', 'iwpdev' ),
						'date'            => __( 'Date', 'iwpdev' ),
						'modified'        => __( 'Modified', 'iwpdev' ),
						'parent'          => __( 'Parent', 'iwpdev' ),
						'rand'            => __( 'Rand', 'iwpdev' ),
						'comment_count'   => __( 'Comment count', 'iwpdev' ),
						'post__in'        => __( 'Post in', 'iwpdev' ),
						'post_name__in'   => __( 'Post name in', 'iwpdev' ),
						'post_parent__in' => __( 'Post parent in', 'iwpdev' ),
					]
				),
			]
		)->set_category(
			'iwpdev',
			'IWPDEV',
			'editor-code'
		)->set_render_callback(
			function ( $fields, $attributes, $inner_blocks ) {
				get_template_part(
					'template-parts/blocks/portfolio',
					'loop',
					[
						'attributes' => $attributes,
						'fields'     => $fields,
					]
				);
			}
		);
	}
}
