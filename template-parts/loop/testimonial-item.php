<?php
/**
 * Template part: Testimonial item.
 *
 * @package iwpdev/theme
 */

$testimonial_id = $args['testimonial_id'];
$avatar         = wp_get_attachment_image( carbon_get_post_meta( $testimonial_id, 'iwp_avatar' ) ?? 0, 'thumbnail', '', [ 'alt' => get_the_title( $testimonial_id ) ] );
?>
<div class="testimonial-item">
	<div class="testimonial-head">
		<?php
		if ( ! empty( $avatar ) ) {
			echo wp_kses_post( $avatar );
		} else {
			printf( '<img src="%s" alt="%s">', 'https://ui-avatars.com/api/?name=John+Doe', __( 'No Image', 'iwpdev' ) );
		}
		?>
		<div class="desc">
			<h3><?php the_title(); ?></h3>
			<p><?php echo esc_html( carbon_get_post_meta( $testimonial_id, 'iwp_position' ) ?? '' ); ?></p>
		</div>
	</div>
	<div class="testimonial-body">
		<?php the_content(); ?>
	</div>
	<div class="testimonial-footer">
		<p>
			<?php
			esc_html_e( 'Platform  : ', 'iwpdev' );
			echo esc_html( carbon_get_post_meta( $testimonial_id, 'iwp_platform_review_name' ) ?? '' );
			?>
		</p>
		<a
				class="icon-chevron-right"
				href="<?php echo esc_url( carbon_get_post_meta( $testimonial_id, 'iwp_platform_review_link' ) ?? '' ); ?>">
			<?php esc_html_e( 'Original review', 'iwpdev' ); ?>
		</a>
	</div>
</div>
