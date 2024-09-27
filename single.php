<?php
/**
 * Single post template.
 *
 * @package iwpdev/theme
 */

use Iwpdev\Theme\Helpers\FrontEndHelpers;

get_header();

$id_post = get_the_ID();
?>
	<section>
		<div class="container">
			<div class="row">
				<h1><?php the_title(); ?></h1>
				<ul class="meta">
					<li class="icon-date"><?php the_date( 'd.m.Y' ); ?></li>
					<li class="icon-eye">
						<?php
						if ( function_exists( 'pvc_get_post_views' ) ) {
							echo esc_html( pvc_get_post_views( $id_post ) );
						}
						?>
					</li>
					<li class="icon-read">
						<?php echo esc_html( FrontEndHelpers::get_read_time( get_the_content( $id_post ) ) ); ?>
					</li>
					<li>
						<?php
						esc_html_e( 'Category:', 'iwpdev' );
						$post_term = get_the_category( $id_post );

						if ( ! empty( $post_term ) || ! is_wp_error( $post_term ) ) {
							foreach ( $post_term as $article_term ) {
								printf( '<a href="%1$s">%2$s</a>', esc_url( get_category_link( $article_term->term_id ) ), esc_html( $article_term->name ) );
							}
						} else {
							printf( '<a href="%1$s">%2$s</a>', esc_attr( '#' ), esc_html__( 'No category', 'iwpdev' ) );
						}
						?>
					</li>
				</ul>
				<?php
				the_excerpt();

				if ( has_post_thumbnail( $id_post ) ) {
					the_post_thumbnail( 'single_post_thumbnail' );
				}
				?>
				<div class="content-text">
					<?php the_content(); ?>
				</div>
			</div>

			<?php
			/**
			 * You need to decide whether the article will have a rating and comments.
			 * @todo Add comment or reviews ?
			 */
			?>
			<!--			<div class="row">-->
			<!--				<div class="col">-->
			<!--					<div class="reviews">-->
			<!--						--><?php //comments_template(); ?>
			<!--					</div>-->
			<!--				</div>-->
			<!--			</div>-->
		</div>
	</section>
<?php
get_footer();
