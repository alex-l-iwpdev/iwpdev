<?php
/**
 * Header template.
 *
 * @package iwpdev/theme
 */

$body_classes = '';

if ( is_front_page() ) {
	$body_classes = 'home';
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta
			name="viewport"
			id="viewport"
			content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<title><?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( $body_classes ); ?>>
<div class="wrapper">
	<div class="content">
		<header>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-auto"><?php the_custom_logo(); ?></div>
					<div class="col d-flex align-items-center">
						<?php
						if ( has_nav_menu( 'header_menu' ) ) {
							wp_nav_menu(
								[
									'theme_location' => 'header_menu',
									'container'      => '',
									'menu_class'     => 'menu',
									'echo'           => true,
									'fallback_cb'    => 'wp_page_menu',
									'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								]
							);
						}
						?>
						<div class="burger-menu">
							<span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
						</div>
					</div>
				</div>
			</div>
		</header>
