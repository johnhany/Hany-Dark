<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package hany-dark
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( '什么也没找到', 'hany-dark' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( '开始写第一篇<a href="%1$s">博文</a>吧。', 'hany-dark' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( '没有搜索到您需要的内容，可以试着变换关键词重新搜索一下。', 'hany-dark' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( '没有找到您想查看的内容，可以试着用搜索栏找一下。', 'hany-dark' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
