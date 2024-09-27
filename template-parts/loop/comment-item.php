<?php
/**
 * Template part: Comment item.
 *
 * @package iwpdev/theme
 */

use Iwpdev\Theme\Helpers\BackEndHelpers;

$comment_id = get_comment_ID();
$rating     = BackEndHelpers::get_comment_rate_by_id( $comment_id );

$comment_class = get_comment_class();
?>
<div
		class="comment-item <?php echo ! empty( $comment_class ) ? esc_attr( implode( ' ', $comment_class ) ) : ''; ?>"
		itemprop="review"
		itemscope itemtype="https://schema.org/Review">
	<h3 itemprop="name">
		<span itemprop="author"><?php comment_author(); ?></span>
		<?php if ( ! empty( $rating ) ) { ?>
			<ul
					itemprop="aggregateRating"
					itemscope itemtype="https://schema.org/AggregateRating"
					class="rating"
					data-rating="<?php echo esc_attr( round( $rating ) ); ?>">
				<li class="icon-star"></li>
				<li class="icon-star"></li>
				<li class="icon-star"></li>
				<li class="icon-star"></li>
				<li class="icon-star"></li>
				<span itemprop="ratingValue"><?php echo esc_attr( round( $rating ) ); ?></span>
			</ul>
		<?php } ?>
	</h3>
	<div itemprop="reviewBody">
		<?php echo wp_kses_post( wpautop( get_comment_text() ) ); ?>
	</div>
</div>
