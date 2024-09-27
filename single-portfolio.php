<?php
/**
 * Single portfolio template.
 *
 * @package iwpdev/theme
 */

get_header();
?>
	<section>
		<div class="container">
			<div class="row">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();

						the_content();
					}
				}
				?>
			</div>
		</div>
	</section>
<?php
get_footer();
