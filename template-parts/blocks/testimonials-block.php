<?php
/**
 * Template part: Testimonials Block.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];

$arg = [
	'post_type'      => 'testimonials',
	'post_status'    => 'publish',
	'posts_per_page' => $fields['count_output'],
];

$testimonials_query = new WP_Query( $arg );
if ( $testimonials_query->have_posts() ) {
	?>
	<div
			class="testimonial-items <?php echo esc_attr( $attributes['className'] ?? '' ); ?>"
			data-iteems_in_row="<?php echo esc_attr( $fields['count_one_row'] ?? 3 ); ?>">
		<?php
		while ( $testimonials_query->have_posts() ) {
			$testimonials_query->the_post();

			$testimonial_id = get_the_ID();

			get_template_part(
				'template-parts/loop/testimonial',
				'item',
				[
					'testimonial_id' => $testimonial_id,
				]
			);
		}
		?>
	</div>
	<?php
}
