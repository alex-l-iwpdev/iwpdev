<?php
/**
 * Template part: Nav menu.
 *
 * @package iwpdev/theme
 */

$attributes = $args['fields'];

wp_nav_menu(
	[
		'menu'        => $attributes['nav_menu'],
		'container'   => '',
		'menu_class'  => 'menu',
		'echo'        => true,
		'fallback_cb' => 'wp_page_menu',
		'before'      => '',
		'after'       => '',
		'link_before' => '',
		'link_after'  => '',
		'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'       => 0,
		'walker'      => '',
	]
);
