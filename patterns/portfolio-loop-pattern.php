<?php
/**
 * Title: Portfolio loop.
 * Slug: iwpdev/portfolio-loop-pattern
 *
 * @package iwpdev/theme
 */

?>
<!-- wp:columns {"className":"row"} -->
<div class="wp-block-columns row"><!-- wp:column {"className":"col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"} -->
	<div class="wp-block-column col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
		<!-- wp:heading {"className":"title top"} -->
		<h2 class="wp-block-heading title"><?php echo isset( get_queried_object()->term_id ) ? esc_html__( 'Category: ', 'iwpdev' ) . esc_html( get_queried_object()->name ) : ''; ?></h2>
		<!-- /wp:heading -->
		<!-- wp:term-description /-->

		<!-- wp:carbon-fields/portfolio-loop {"data":{"posts_per_page":"6","order":"DESC","order_by":"date"}} /--></div>
	<!-- /wp:column --></div>
<!-- /wp:columns -->
