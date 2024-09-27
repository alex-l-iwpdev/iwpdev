<?php
/**
 * Comments template.
 *
 * @package iwpdev/theme
 */

use Iwpdev\Theme\Helpers\BackEndHelpers;

$rating_avg = BackEndHelpers::get_avg_rating( get_the_ID() );

$r_by_stars      = BackEndHelpers::get_ratings_percent( get_the_ID() );
$number_comments = get_comments_number( get_the_ID() )
?>
<div class="row">
	<div class="reviews">
		<h3>
			<?php echo esc_html( _nx( 'Review', 'Reviews', $number_comments, 'iwpdev' ) ); ?>
		</h3>
		<div class="dfr">
			<div class="rating-description">
				<div class="dfr"><span><?php echo esc_html( $rating_avg ); ?></span>
					<div class="dfc">
						<ul class="stars" data-rating="<?php echo esc_attr( floor( $rating_avg ) ); ?>">
							<li class="icon-star"></li>
							<li class="icon-star"></li>
							<li class="icon-star"></li>
							<li class="icon-star"></li>
							<li class="icon-star"></li>
						</ul>
						<p>
							<?php echo esc_html( $number_comments ); ?><?php echo esc_html( _nx( ' Review', ' Reviews', $number_comments, 'iwpdev' ) ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="rating-stat">
				<ul>
					<?php for ( $i = 5; $i > 0; $i -- ) { ?>
						<li>
							<?php echo sprintf( '%d %s', esc_attr( $i ), esc_html( __( 'Star', 'iwpdev' ) ) ); ?>
							<div class="progress">
								<div
										class="progress-bar"
										role="progressbar"
										aria-valuenow="<?php echo esc_attr( $r_by_stars[ $i ] ); ?>" aria-valuemin="0"
										aria-valuemax="100"
										style="width: <?php echo esc_attr( $r_by_stars[ $i ] ); ?>%;"></div>
							</div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="comments">
			<div class="comment-items">
				<?php
				if ( have_comments() ) {
					while ( have_comments() ) {
						the_comment();
						get_template_part( 'template-part/loop/comment', 'item' );
					}
				}
				?>
			</div>
		</div>
		<?php
		get_template_part( 'template-part/single/review', 'form', [ 'bot_id' => get_the_ID() ] );
		?>
	</div>
</div>

