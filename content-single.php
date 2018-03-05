<?php
/**
 * @package Alzira
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action('alzira_inside_top_post'); ?>

	<?php if ( has_post_thumbnail() && ( get_theme_mod( 'post_feat_image' ) != 1 ) ) : ?>
		<div class="entry-thumb">
			<?php the_post_thumbnail('alzira-large-thumb'); ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="title-post entry-title">', '</h1>' ); ?>

		<?php if (get_theme_mod('hide_meta_single') != 1 ) : ?>
		<div class="meta-post">
			<?php alzira_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'alzira' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php alzira_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php do_action('alzira_inside_bottom_post'); ?>

</article><!-- #post-## -->
