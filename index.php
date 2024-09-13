<?php
/**
 * Index file.
 *
 * @package iwpdev/theme
 */

get_header();
?>
	<section>
		<div class="container">
			<?php
			while ( have_posts() ) {
				the_post();

				the_content();
			}
			?>
		</div>
	</section>
<?php
get_footer();
