<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package hany-dark
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'hany-dark' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'hany-dark' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'hany-dark' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'hany-dark' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'hany_dark_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hany_dark_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '发布于 %s', 'post date', 'hany-dark' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( '作者： %s', 'post author', 'hany-dark' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'hany_dark_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function hany_dark_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'hany-dark' ) );
		if ( $categories_list && hany_dark_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( '类别：%1$s', 'hany-dark' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'hany-dark' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( '标签：%1$s', 'hany-dark' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( '我要写评论', 'hany-dark' ), __( '1 条评论', 'hany-dark' ), __( '% 条评论', 'hany-dark' ) );
		echo '</span>';
	}

	edit_post_link( __( '继续编辑', 'hany-dark' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( '类别：%s', 'hany-dark' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( '标签：%s', 'hany-dark' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( '作者： %s', 'hany-dark' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( '年份：%s', 'hany-dark' ), get_the_date( _x( 'Y', 'yearly archives date format', 'hany-dark' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( '月：%s', 'hany-dark' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'hany-dark' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( '日：%s', 'hany-dark' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'hany-dark' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( '边注', 'post format archive title', 'hany-dark' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( '图库', 'post format archive title', 'hany-dark' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( '图片', 'post format archive title', 'hany-dark' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( '视频', 'post format archive title', 'hany-dark' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( '引文', 'post format archive title', 'hany-dark' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( '链接', 'post format archive title', 'hany-dark' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( '状态', 'post format archive title', 'hany-dark' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( '音频', 'post format archive title', 'hany-dark' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( '聊天', 'post format archive title', 'hany-dark' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( '归档：%s', 'hany-dark' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'hany-dark' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( '归档', 'hany-dark' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hany_dark_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hany_dark_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hany_dark_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so hany_dark_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hany_dark_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in hany_dark_categorized_blog.
 */
function hany_dark_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hany_dark_categories' );
}
add_action( 'edit_category', 'hany_dark_category_transient_flusher' );
add_action( 'save_post',     'hany_dark_category_transient_flusher' );

/*
 * Social media icon menu as per http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 */
/*
function hany_dark_social_menu() {
    if ( has_nav_menu( 'social' ) ) {
	wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container'       => 'div',
			'container_id'    => 'menu-social',
			'container_class' => 'menu-social',
			'menu_id'         => 'menu-social-items',
			'menu_class'      => 'menu-items',
			'depth'           => 1,
			'fallback_cb'     => '',
		)
	);
    }
}
 */
