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

if ( is_category() ) {
	$query_obj = get_queried_object();

	//phpcs:ignore
	$post_arg['tax_query'] = [
		[
			'taxonomy' => $query_obj->taxonomy,
			'field'    => 'term_id',
			'terms'    => $query_obj->term_id,
		],
	];
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

		$big = 999999999;
		?>
		<div class="page_navigation_wrapper">
			<div class="wp-pagination">
				<?php
				echo wp_kses_post(
					paginate_links(
						[
							'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
							'format'  => '?paged=%#%',
							'current' => max( 1, get_query_var( 'paged' ) ),
							'total'   => $articles_object->max_num_pages,
						]
					) ?? ''
				);
				?>
			</div>
		</div>
		<?php
	} else {
		printf( '<p>%s</p>', esc_html__( 'Post not found.', 'iwpdev' ) );
	}
	?>
</div>
