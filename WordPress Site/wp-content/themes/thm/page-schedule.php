<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Mindset
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php //get_template_part( 'template-parts/content', 'page' ); ?>

				<?php 
			if(function_exists('get_field')){
		if( have_rows('schedule') ):
			
			echo "<h2>Course Schedule</h2>";
				 // loop through the rows of data
				while ( have_rows('schedule' ) ) : the_row();
			
                    //Both fields required , no need to check get_field()
                    echo '<figure>';
							
                            echo '<div class="schedule">';
                            the_sub_field('course_date');
							echo " --- Course : ";
							the_sub_field('course_title');
							echo " --- Instructor : ";
							the_sub_field('course_instructor');
							echo "</div>";
		
							
                    echo "</figure>";               
                
					
			
				endwhile;
			
			else :
			
				// no rows found
			
			endif;
			}
               
       
		

		
        
        ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
