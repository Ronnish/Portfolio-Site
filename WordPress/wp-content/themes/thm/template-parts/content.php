<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mindset
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header style="font-size: 25px" class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' ); 
	
			
		
		
				
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>

		

		<div class="entry-meta">
			<?php mindset_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>



	
	</header><!-- .entry-header -->
	<a href="<?php echo get_permalink(8); ?>"><?php echo get_the_title(8); ?></a>
	<div class="entry-content">
		<?php
		
			if(has_post_thumbnail()){
				the_post_thumbnail('post-thumbnail',array('class'=>'alignleft'));

			}

			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mindset' ),
				'after'  => '</div>',
			) );
			
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php mindset_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->