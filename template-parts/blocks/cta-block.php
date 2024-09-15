<?php
/**
 * Template part: CTA block.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];
?>
<div class="form top">
	<h2><?php echo wp_kses_post( $fields['title'] ); ?></h2>
	<p><?php echo wp_kses_post( $fields['sub_title'] ); ?></p>
	<?php echo do_shortcode( $fields['form_shot_code'] ); ?>
</div>
