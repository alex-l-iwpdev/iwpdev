<?php
/**
 * Template part: Portfolio loop.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];

$arg       = [
	'post_type'      => 'portfolio',
	'post_status'    => 'publish',
	'posts_per_page' => $fields['posts_per_page'],
	'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
];
$query_obj = get_queried_object();

if ( ! empty( $query_obj ) && ! is_wp_error( $query_obj ) ) {
	//phpcs:disable
	$arg['tax_query'] = [
		[
			'taxonomy' => $query_obj->taxonomy,
			'field'    => 'id',
			'terms'    => $query_obj->term_id,
		],
	];
	//phpcs:enable
}

$portfolio_query = new WP_Query( $arg );

?>
<div class="portfolio-items <?php echo esc_attr( $attributes['className'] ?? '' ); ?>">
	<?php
	if ( $portfolio_query->have_posts() ) {
		while ( $portfolio_query->have_posts() ) {
			$portfolio_query->the_post();

			$portfolio_id = get_the_ID();

			get_template_part(
				'template-parts/loop/portfolio',
				'item',
				[ 'portfolio_id' => $portfolio_id ]
			);
		}

		$big = 999999999;
		?>
		<div class="page_navigation_wrapper">
			<div class="wp-pagination">
				<?php
				echo wp_kses_post(
					paginate_links(
						[
							'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
							'format'  => '?paged=%#%',
							'current' => max( 1, get_query_var( 'paged' ) ),
							'total'   => $portfolio_query->max_num_pages,
						]
					) ?? ''
				);
				?>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	}
	?>
</div>
