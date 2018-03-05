<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Alzira
 */
?>
			</div>
		</div>
	</div><!-- #content -->

	<?php do_action('alzira_before_footer'); ?>

	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<?php get_sidebar('footer'); ?>
	<?php endif; ?>

    <a class="go-top"><i class="fa fa-angle-up"></i></a>
		
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'alzira' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'alzira' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %2$s by %1$s.', 'alzira' ), 'aThemes', '<a href="https://athemes.com/theme/alzira" rel="designer">Alzira</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php do_action('alzira_after_footer'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
