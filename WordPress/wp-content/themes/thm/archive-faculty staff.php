<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mindset
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<?php
					post_type_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			
			
			<?php 
			//  Output all photo with work category 'developers'
			$args = array(
				'post_type' => 'staff',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'staff-category',
						'field' => 'slug',
						'terms' => 'faculty',
 					)
				)
			);
			$student = new WP_Query($args);
			if($student -> have_posts()){
				echo '<h2>faculty staff</h2>';
				echo '<div class="staff-layout">';
				while($student -> have_posts()){
					$student -> the_post();
					echo '<article class="staff-item">';
						echo '<a href="'.get_permalink().'">';
						echo '<h3>'.get_the_title() . '</h3>';
						the_post_thumbnail('square');
						echo '</a>';
						the_excerpt();
						echo get_the_term_list( get_the_id(), 'staff-category', 'Speciality: ', ', ' );
					echo '</article>';
				}
				echo '</div>';
				wp_reset_postdata();
			}

			?>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>