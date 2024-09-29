<?php
/**
 * 404 error template.
 *
 * @package iwpdev/theme
 */

get_header();
?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
					<img
							src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/404.svg' ); ?>"
							alt="404 error image">
					<h1><?php esc_html_e( 'Page Not Found', 'iwpdev' ); ?></h1>
					<p><?php echo wp_kses_post( 'Sorry, the page you’re looking for does not exist or has been moved <br>please go back to the	Home page', 'iwpdev' ); ?></p>
					<a class="button" href="/"><?php echo esc_html__( 'Go back Home', 'iwpdev' ); ?></a>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();
