<?php
/**
 * Template part: Blog block.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];

$arg = [
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => $fields['count_output'],
];

if ( is_singular( 'post' ) ) {
	$current_post         = get_the_ID();
	$args['post__not_in'] = [ $current_post ];
}

$post_query = new WP_Query( $arg );

if ( $post_query->have_posts() ) {
	?>
	<div class="blog-items <?php echo esc_attr( $attributes['className'] ?? '' ); ?>">
		<?php
		while ( $post_query->have_posts() ) {
			$post_query->the_post();

			$id_post = get_the_ID();

			get_template_part(
				'template-parts/loop/blog',
				'item',
				[
					'id_post' => $id_post,
				]
			);
		}
		wp_reset_postdata();
		?>
		<a
				class="button icon-chevron-right"
				href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
			<?php esc_html_e( 'All Posts', 'iwpdev' ); ?>
		</a>
	</div>
	<?php
}
