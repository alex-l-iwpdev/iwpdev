<?php
/**
 * Template part: Blog item.
 *
 * @package iwpdev/theme
 */

$id_post = $args['id_post'];

$post_term = wp_get_post_terms( $id_post, 'category' );
?>
<div class="blog-item left">
	<a class="link" href="<?php the_permalink(); ?>"></a>
	<?php
	if ( has_post_thumbnail( $id_post ) ) {
		the_post_thumbnail( 'post_thumbnail' );
	} else {
		printf( '<img src="%s" alt="%s" />', 'https://placehold.co/411x231', __( 'No Image', 'iwpdev' ) );
	}
	?>
	<div class="desc">
		<ul class="cat">
			<li><?php esc_html_e( 'Category:', 'iwpdev' ); ?></li>
			<?php
			if ( ! empty( $post_term ) ) {
				foreach ( $post_term as $item ) {
					?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $item ) ); ?>">
							<?php echo esc_html( $item->name ); ?>
						</a>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<h3><?php the_title(); ?></h3>
		<ul class="meta">
			<li class="icon-date">
				<?php the_date( 'd.m.Y' ); ?>
			</li>
			<li class="icon-eye">
				<?php
				if ( function_exists( 'pvc_get_post_views' ) ) {
					echo esc_html( pvc_get_post_views( $id_post ) );
				}
				?>
			</li>
		</ul>
	</div>
</div>
