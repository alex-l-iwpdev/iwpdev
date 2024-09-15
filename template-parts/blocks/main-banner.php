<?php
/**
 * Template part: Main banner.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];
$image      = wp_get_attachment_image( $fields['iwp_image'] ?? 0, 'full', [ 'alt' => esc_attr( get_the_title( $fields['iwp_image'] ) ) ] );
?>
<div class="row banner <?php echo esc_attr( $attributes['className'] ?? '' ); ?>">
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
		<h1><?php echo wp_kses_post( $fields['iwp_banner_title'] ?? '' ); ?></h1>
		<p><?php echo wp_kses_post( $fields['iwp_banner_description'] ?? '' ); ?></p>
		<a class="button icon-arrow-right" href="<?php echo esc_url( $fields['iwp_button_link'] ?? '' ); ?>">
			<?php echo esc_html( $fields['iwp_button_text'] ?? '' ); ?>
		</a>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
		<?php
		if ( ! empty( $image ) ) {
			echo wp_kses_post( $image );
		}
		?>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
		<a class="icon-arrow-down" href="#"></a>
	</div>
</div>
