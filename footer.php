<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package hany-dark
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
            <?php get_sidebar('footer'); ?>
		<div class="site-info">
                        <span class="powered">Proudly powered by </span>
                        <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'hany-dark' ) ); ?>"><?php printf( __( 'WordPress', 'hany-dark' ) ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s based on %2$s.', 'hany-dark' ), '<a href="https://github.com/johnhany/Hany-Dark" rel="designer">Hany Dark</a>', '<a href="http://underscores.me/" rel="_s">Underscores</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
