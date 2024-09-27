<?php
/**
 * Template part: Portfolio block.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];

$portfolio_ids = [];
if ( ! empty( $fields['iwp_portfolio'] ) ) {
	foreach ( $fields['iwp_portfolio'] as $field ) {
		$portfolio_ids[] = $field['id'];
	}

	$arg = [
		'post_type'      => 'portfolio',
		'post__in'       => $portfolio_ids,
		'orderby'        => 'post__in',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
	];

	$portfolio_query = new WP_Query( $arg );
	if ( $portfolio_query->have_posts() ) {
		?>
		<div class="portfolio-items <?php echo esc_attr( $attributes['className'] ?? '' ); ?>">
			<?php
			while ( $portfolio_query->have_posts() ) {
				$portfolio_query->the_post();

				$portfolio_id = get_the_ID();

				get_template_part(
					'template-parts/loop/portfolio',
					'item',
					[ 'portfolio_id' => $portfolio_id ]
				);
			}
			wp_reset_postdata();
			?>
		</div>
		<?php
	}
}
