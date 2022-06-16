<?php
/**
 * Custom Fudou template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress4.4
 * @subpackage Fudousan Plugin
 * Version: 1.6.8
 */

if ( ! function_exists( 'fudou_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own fudou_entry_meta() function to override in a child theme.
 *
 * @since Base Twenty Sixteen 1.0
 * Version: 1.6.8
 */
function fudou_entry_meta( $post_id=0 ) {

	$author_url = '';
	$author_id  = 0;
	$display_name = '';

	if( $post_id ){
		echo '<div class="fudou_author" style="display:none;">';

		$post = get_post($post_id);
		if ( $post ){
			$author = get_userdata( $post->post_author );
			$author_id = $author->ID;
			$author_url = $author->user_url;
			$display_name  = $author->display_name;
		}

		if( ! $author_url ){
			$author_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) );
		}

		if ( 'fudo' === get_post_type() ) {
			$author_avatar_size = apply_filters( 'fudou_author_avatar_size', 49 );
			printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
				get_avatar( get_the_author_meta( 'user_email', $author_id ), $author_avatar_size ),
				_x( 'Author', 'Used before post author name.', 'fudou' ),
				$author_url,
				$display_name
			);

			fudou_entry_date();

			fudou_entry_taxonomies( $post_id );
		}

		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'fudou_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own fudou_entry_date() function to override in a child theme.
 *
 * @package WordPress4.4
 * @subpackage Fudousan Plugin
 * Version: 1.6.8
 */
function fudou_entry_date() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'fudou' ),
		esc_url( get_permalink() ),
		$time_string
	);

}
endif;

if ( ! function_exists( 'fudou_entry_taxonomies' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own fudou_entry_taxonomies() function to override in a child theme.
 *
 * @package WordPress4.4
 * @subpackage Fudousan Plugin
 * Version: 1.6.8
 */
function fudou_entry_taxonomies( $post_id ) {

	$categories_list = get_the_term_list( $post_id, 'bukken', '', ', ' );

	if ( $categories_list ) {
		//$categories_list = str_replace( 'rel="tag"', 'rel="category"', $categories_list );
		printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Categories', 'Used before category names.', 'fudou' ),
			$categories_list
		);
	}

	$tags_list = get_the_term_list( $post_id, 'bukken_tag', '', ', ' ); 
	if ( $tags_list ) {
		printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags', 'Used before tag names.', 'fudou' ),
			$tags_list
		);
	}
}
endif;

