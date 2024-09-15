<?php
/**
 * Template part: Portfolio item.
 *
 * @package iwpdev/theme
 */

$portfolio_id       = $args['portfolio_id'];
$portfolio_category = wp_get_post_terms( $portfolio_id, 'portfolio-category' )[0] ?? '';
$portfolio_industry = wp_get_post_terms( $portfolio_id, 'portfolio-industry' )[0] ?? '';
?>
<div class="portfolio-item">
	<a class="link" href="<?php the_permalink(); ?>"></a>
	<?php
	if ( has_post_thumbnail( $portfolio_id ) ) {
		the_post_thumbnail( $portfolio_id, [ 'alt' => get_the_title( $portfolio_id ) ] );
	} else {
		sprintf( '<img src="%s" alt="%s">', esc_url( 'https://placehold.co/600x900' ), esc_html__( 'No Image', 'iwpdev' ) );
	}
	?>
	<div class="description">
		<h3><?php the_title(); ?></h3>
		<ul class="meta">
			<?php if ( ! empty( $portfolio_category ) && ! is_wp_error( $portfolio_category ) ) { ?>
				<li>
					<?php esc_html_e( 'Solution', 'iwpdev' ); ?>
					<a href="<?php echo esc_url( get_term_link( $portfolio_category ) ); ?>">
						<span><?php echo esc_html( $portfolio_category->name ); ?></span>
					</a>
				</li>
				<?php
			}

			if ( ! empty( $portfolio_industry ) && ! is_wp_error( $portfolio_industry ) ) {
				?>
				<li>
					<?php esc_html_e( 'Industry', 'iwpdev' ); ?>
					<a href="<?php echo esc_url( get_term_link( $portfolio_industry ) ); ?>">
						<span><?php echo esc_html( $portfolio_industry->name ); ?></span>
					</a>
				</li>
			<?php } ?>
		</ul>
		<a class="icon-chevron-right" href="<?php the_permalink(); ?>"></a>
	</div>
</div>
