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

		
			
			<?php 
			//  Output all work with Staff category 'administative'
			$args = array(
				'post_type' => 'staff',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'staff-category',
						'field' => 'slug',
						'terms' => 'administrative',
 					)
				)
			);
			$staff = new WP_Query($args);
			if($staff -> have_posts()){
				echo '<h2>Administrative Staff</h2>';
				echo '<div class="staff">';
				while($staff -> have_posts()){
					$staff -> the_post();
					echo '<article class="staff-item">';
						echo '<h3>'.get_the_title() . '</h3>';
						the_post_thumbnail('large');
						echo '</a>';
						the_content();
						
					echo '</article>';
				}
				echo '</div>';
				wp_reset_postdata();
			}

			?>
			<?php 
			//  Output all photo with staff category 'faculty'
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
			$staff = new WP_Query($args);
			if($staff -> have_posts()){
				echo '<h2>Faculty Staff</h2>';
				echo '<div class="works-gird">';
				while($staff -> have_posts()){
					$staff -> the_post();
					echo '<article class="staff-item">';
						echo '<a href="'.get_permalink().'">';
						echo '<h3>'.get_the_title() . '</h3>';
						the_post_thumbnail('large');
						echo '</a>';
						the_content();
					echo '</article>';
				}
				echo '</div>';
				wp_reset_postdata();
			}

			?>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
