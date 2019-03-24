<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mindset_Starter
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header style="font-size: 40px" class="page-header">
				<?php
				single_term_title();
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); 
				?>
				

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<?php
					echo '<a href="'.get_permalink().'">';
					echo '<h2>' . get_the_title() .'</h2>';
					echo '</a>';
					the_post_thumbnail('large', array('class' => 'alignright'));
					the_excerpt();
					echo get_the_term_list( get_the_id(), 'student-category', 'Speciality: ', ', ' );
					?>

	
</article>

<?php



				
				

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();