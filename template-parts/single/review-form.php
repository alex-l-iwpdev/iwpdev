<?php
/**
 * Template part: Review from.
 *
 * @package iwpdev/telegram-bots-listing
 */

use Iwpdev\Theme\Main;

$article_id = $args['post_id'];

?>
<form class="reviews-form" id="bot-review-form">
	<div class="dfr">
		<div class="input">
			<input
					type="text"
					name="full_name"
					id="full-name"
					placeholder="<?php esc_html_e( 'Full Name', 'iwpdev' ); ?>"
					required>
		</div>
		<div class="rating-inputs">
			<label><?php esc_html_e( 'Add review', 'iwpdev' ); ?></label>
			<?php get_template_part( 'template-part/page/rating', 'input' ); ?>
		</div>
	</div>
	<div class="textarea">
		<textarea
				id="review-message"
				name="comment_message"
				required
				placeholder="<?php esc_html_e( 'Comment', 'iwpdev' ); ?>"></textarea>
	</div>
	<?php wp_nonce_field( Main::IWP_REVIEW_ACTION_NAME, 'comment_nonce' ); ?>
	<button class="button icon-send send-review" data-post_id="<?php echo esc_attr( $article_id ); ?>">
		<?php esc_html_e( 'Add Comment', 'iwpdev' ); ?>
	</button>
</form>
