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
	<?php wp_head(); ?>
</head>
<body class="<?php body_class( $body_classes ); ?>">
<div class="wrapper">
	<div class="content">
		<header>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-auto"><a class="logo-wrap" href="#"><img src="img/logo.svg" alt=""></a></div>
					<div class="col d-flex align-items-center">
						<ul class="menu">
							<li class="menu-item-has-children"><a href="#">Services</a>
								<ul class="sub-menu">
									<li><a href="#">HTML to WordPress</a></li>
									<li><a href="#">Figma to WordPress</a></li>
									<li><a href="#">Create plugin to WordPress </a></li>
									<li><a href="#">Personalize your WordPress</a></li>
									<li><a href="#">Personalize your WooCommerse</a></li>
									<li><a href="#">Security Audit</a></li>
									<li><a href="#">Speed optimization</a></li>
									<li><a href="#">Api integration</a></li>
								</ul>
							</li>
							<li><a href="#">Portfolio</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="#">About us</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
						<div class="burger-menu">
							<span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
						</div>
					</div>
				</div>
			</div>
		</header>
