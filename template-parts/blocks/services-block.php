<?php
/**
 * Template part: Services block.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];

if ( ! empty( $fields['iwp_services'] ) ) {
	?>
	<div class="service-items <?php echo esc_attr( $attributes['className'] ?? '' ); ?>">
		<?php
		foreach ( $fields['iwp_services'] as $key => $item ) {
			?>
			<div class="service-item top">
				<h3 class="<?php echo esc_html( $item['service_icon_name'] ); ?>">
					<a href="<?php echo esc_url( $item['service_link'] ?? '#' ); ?>">
						<?php echo esc_html( $item['service_title'] ); ?>
					</a>
				</h3>
				<?php echo wp_kses_post( wpautop( $item['service_description'] ) ); ?>
				<a class="button icon-mail" href="#">
					<?php esc_html_e( 'Request a Quote', 'iwpdev' ); ?>
				</a>
			</div>
		<?php } ?>
	</div>
	<?php
}
