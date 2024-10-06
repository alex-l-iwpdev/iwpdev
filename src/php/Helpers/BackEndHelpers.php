<?php
/**
 * Back end helper class.
 *
 * @package iwpdev/theme
 */

namespace Iwpdev\Theme\Helpers;

use Iwpdev\Theme\Main;

/**
 * BackEndHelpers class file.
 */
class BackEndHelpers {

	/**
	 * Get term to select.
	 *
	 * @param string $tax_name   Taxonomy name.
	 * @param bool   $hide_empty Hide empty ( default: false ).
	 *
	 * @return array
	 */
	public static function get_term_to_select( string $tax_name, bool $hide_empty = true ): array {

		$post_term = get_terms(
			[
				'taxonomy'   => $tax_name,
				'hide_empty' => $hide_empty,
			]
		);

		$terms_options = [];

		if ( empty( $post_term ) || is_wp_error( $post_term ) ) {
			return $terms_options;
		}

		foreach ( $post_term as $term ) {
			$terms_options[ $term->term_id ] = $term->name;
		}

		return $terms_options;
	}

	/**
	 * Get AVG rating.
	 *
	 * @param int $post_id Post id.
	 *
	 * @return float|int
	 */
	public static function get_avg_rating( int $post_id ) {
		global $wpdb;

		$table_name = $wpdb->prefix . Main::IWP_REVIEW_TABLE_NAME;

		//phpcs:disable
		$result = $wpdb->get_results( $wpdb->prepare( "SELECT AVG(rating) AS rating FROM $table_name WHERE post_id = %d", $post_id ) );
		//phpcs:enable

		if ( ! empty( $result[0]->rating ) ) {
			return round( $result[0]->rating, 1 );
		}

		return 0;
	}

	/**
	 * Get rating percent.
	 *
	 * @param int $post_id Post id.
	 *
	 * @return array
	 */
	public static function get_ratings_percent( int $post_id ): array {
		global $wpdb;

		$table_name = $wpdb->prefix . Main::IWP_REVIEW_TABLE_NAME;

		//phpcs:disable
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT rating, COUNT(*) AS count FROM $table_name WHERE post_id = %d GROUP BY rating ORDER BY rating", $post_id ), ARRAY_A );
		//phpcs:enable

		$total_reviews = array_sum( array_column( $results, 'count' ) );

		$ratings_percentage = array_fill( 1, 5, 0 );

		foreach ( $results as $row ) {
			$rating                        = (int) $row['rating'];
			$count                         = (int) $row['count'];
			$percentage                    = ( $total_reviews > 0 ) ? ( $count * 100.0 / $total_reviews ) : 0;
			$ratings_percentage[ $rating ] = $percentage;
		}

		return $ratings_percentage;
	}

	/**
	 * Get comment rate by id.
	 *
	 * @param int $comment_id Comment id.
	 *
	 * @return int
	 */
	public static function get_comment_rate_by_id( int $comment_id ): int {
		global $wpdb;

		$table_name = $wpdb->prefix . Main::IWP_REVIEW_TABLE_NAME;

		//phpcs:disable
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT rating FROM $table_name WHERE comment_id = %d", $comment_id ) );
		//phpcs:enable
		if ( ! empty( $results ) ) {
			return $results[0]->rating;
		}

		return 0;
	}

	/**
	 * Get name menu
	 *
	 * @return array
	 */
	public static function get_name_menu(): array {
		$menus = wp_get_nav_menus();
		if ( empty( $menus ) || is_wp_error( $menus ) ) {
			return [];
		}

		$menu_array = [];
		foreach ( $menus as $menu ) {
			$menu_array[ $menu->slug ] = $menu->name;
		}

		return $menu_array;
	}

}
