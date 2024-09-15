<?php
/**
 * Footer template.
 *
 * @package iwpdev/theme
 */

?>
<footer>
	<div class="container">
		<div class="row align-items-center">
			<div class="col-auto"><?php the_custom_logo(); ?></div>
			<div class="col">
				<?php
				if ( has_nav_menu( 'footer_menu' ) ) {
					wp_nav_menu(
						[
							'theme_location' => 'footer_menu',
							'container'      => '',
							'menu_class'     => 'menu',
							'echo'           => true,
							'fallback_cb'    => 'wp_page_menu',
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						]
					);
				}
				?>
			</div>
			<div class="col-auto">
				<?php
				wp_nav_menu(
					[
						'menu'        => 'Social',
						'container'   => '',
						'menu_class'  => 'soc',
						'echo'        => true,
						'fallback_cb' => 'wp_page_menu',
						'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					]
				);
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-auto">
				<p class="copyright">© IWPDev. since 2019. All rights reserved.</p>
			</div>
			<div class="col">
				<ul class="menu">
					<li><a href="#">Terms of Service</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
