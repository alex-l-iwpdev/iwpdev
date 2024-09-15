<?php
/**
 * Template part: Icons block.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];

if ( ! empty( $fields['iwp_icons'] ) ) {
	?>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
		<div class="items <?php echo esc_attr( $attributes['className'] ?? '' ); ?>">
			<?php foreach ( $fields['iwp_icons'] as $item ) { ?>
				<div class="item"><i class="<?php echo esc_attr( $item['icon_class'] ); ?>"></i></div>
			<?php } ?>
		</div>
	</div>
	<?php
}
