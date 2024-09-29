<?php
/**
 * Template part: FAQ block template.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];

if ( ! empty( $fields['faq_items'] ) ) {
	?>
	<div class="faq-items <?php echo esc_attr( $attributes['className'] ?? '' ); ?>">
		<?php foreach ( $fields['faq_items'] as $item ) { ?>
			<div class="faq-item">
				<h4 class="icon-chevron"><?php echo esc_html( $item['title'] ?? '' ); ?></h4>
				<div class="hide">
					<?php echo wp_kses_post( wpautop( $item['description'] ?? '' ) ); ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php
}
