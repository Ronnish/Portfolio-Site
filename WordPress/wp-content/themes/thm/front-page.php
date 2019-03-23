<?php
/**
 * The template for displaying the Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mindset_Starter
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		

		<section class="intro">

		<?php echo do_shortcode('[metaslider id="72" percentwidth=100]'); ?>

			<?php
				//load the intro section from a separate page using WP_Query
				//The page_id is the ID of that page where the intro text is added
				//We created a Front Intro page for this
				$args = array('page_id' => 38);
				$intro_query = new WP_Query($args);
				if($intro_query -> have_posts()){
					while($intro_query -> have_posts()){
						$intro_query -> the_post();
						the_post_thumbnail('medium');
						the_content();
					}
					wp_reset_postdata();
				}

			?>

		</section>
				
		


	

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
