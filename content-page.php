<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package hany-dark
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-body">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( '页码：', 'hany-dark' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( '继续编辑', 'hany-dark' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
    </div>
</article><!-- #post-## -->
