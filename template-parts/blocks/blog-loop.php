<?php
/**
 * Template part: Blog loop.
 *
 * @package iwpdev/theme
 */

$fields     = $args['fields'];
$attributes = $args['attributes'];

$post_arg = [
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $fields['posts_per_page'],
	'order'               => $fields['order'],
	'orderby'             => $fields['order_by'],
];

if ( ! empty( $fields['category'] ) ) {
	$post_arg['cat'] = $fields['category'];
}
if ( ! empty( $fields['tags'] ) ) {
	$post_arg['tag__in'] = $fields['category'];
}

$articles_object = new WP_Query( $post_arg );
?>
<div
		class="blog-items <?php echo esc_attr( $attributes['className'] ?? '' ); ?>"
		data-cout_to_row="<?php echo esc_attr( $fields['count_to_row'] ?? 0 ); ?>">
	<?php
	if ( $articles_object->have_posts() ) {
		while ( $articles_object->have_posts() ) {
			$articles_object->the_post();

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

		if ( function_exists( 'wp_pagenavi' ) ) {
			wp_pagenavi( [ 'query' => $articles_object ] );
		}
	} else {
		printf( '<p>%s</p>', esc_html__( 'Post not found.', 'iwpdev' ) );
	}
	?>
</div>
