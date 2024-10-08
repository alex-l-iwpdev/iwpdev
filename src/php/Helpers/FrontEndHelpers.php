<?php
/**
 * Front end helpers class.
 *
 * @package iwpdev/theme
 */

namespace Iwpdev\Theme\Helpers;

/**
 * FontEndHelpers class file.
 */
class FrontEndHelpers {

	/**
	 * Get read time.
	 *
	 * @param string $content Content.
	 *
	 * @return string
	 */
	public static function get_read_time( string $content ): string {
		$count_words = count( explode( ' ', $content ) );

		$minutes_read = round( $count_words / 150, 0, PHP_ROUND_HALF_UP );

		if ( 0 === (int) $minutes_read ) {
			$minutes_read = 1;
		}

		return sprintf(
		/* translators: %s: read time. */
			__( 'Read tyme: %d min', 'iwpdev' ),
			esc_attr( $minutes_read )
		);
	}

	/**
	 * Gives the first letters of the first and last names.
	 *
	 * @param string $full_name User name.
	 *
	 * @return string
	 */
	public static function get_avatar_name_chars( string $full_name ): string {

		$string = explode( ' ', $full_name );

		return strtoupper( str_split( $string[0] )[0] . ' ' . str_split( $string[1] )[0] );
	}
}
