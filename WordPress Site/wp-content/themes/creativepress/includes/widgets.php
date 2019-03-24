<?php
/**
 * Register and Display Widget Areas and Custom Widgets for the theme.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */

add_action( 'widgets_init', 'creativepress_register_sidebars', 5 );
/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function creativepress_register_sidebars() {
	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary Sidebar', 'sidebar', 'creativepress' ),
			'description' => esc_html__( 'The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.', 'creativepress' ),
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'header-right',
			'name'        => _x( 'Header Right Sidebar', 'sidebar', 'creativepress' ),
			'description' => esc_html__( 'The Header sidebar. It is displayed on right side of the header beside the logo/site-title.', 'creativepress' ),
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'frontpage',
			'name'        => _x( 'Front Page Sidebar', 'sidebar', 'creativepress' ),
			'description' => esc_html__( 'The Front Page sidebar. It is displayed on front page of the site.', 'creativepress' ),
		)
	);

	$footer_sidebar_count = absint( get_theme_mod('creativepress_footer_widgets', 4) );

	while($footer_sidebar_count) {
		hybrid_register_sidebar(
			array(
				'id'          => 'tertiary'.$footer_sidebar_count,
				'name'        => _x( 'Footer Sidebar', 'sidebar', 'creativepress').$footer_sidebar_count,
				'description' => sprintf( esc_html__( 'The Front Page sidebar %d. It is displayed on front page of the site.', 'creativepress' ), $footer_sidebar_count ),
			)
		);
		$footer_sidebar_count--;
	}

	// Register Custom Widgets for Theme
	register_widget( "CreativePress_Post_List_Widget" );
	register_widget( "CreativePress_Post_Grid_Widget" );
	register_widget( "CreativePress_Post_2Column_Widget" );
	register_widget( "CreativePress_Post_Slider_Widget" );
}

/**
 * Custom Widget for displaying post lists.
 *
 * Displays posts from Category/Tags or Latest Posts.
 *
 * @link http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @since       1.0.0
 */

class CreativePress_Post_List_Widget extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since creativepress 1.0
	 *
	 * @return CreativePress_Post_List_Widget
	 */
	public function __construct() {
		parent::__construct( 'widget_recent_post', esc_html__( 'CP: Post List Widget', 'creativepress' ), array(
			'classname'   => 'widget-recent-post clearfix',
			'description' => esc_html__( 'Use this widget to list your latest posts or posts from specific category/tag.', 'creativepress' ),
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since creativepress 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 */
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$number   = empty( $instance['number'] ) ? 3 : $instance['number'];
		$source   = isset( $instance[ 'source' ] ) ? $instance[ 'source' ] : 'latest' ;
		$category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$tag      = isset( $instance[ 'tag' ] ) ? $instance[ 'tag' ] : '';
		$content  = isset( $instance[ 'content' ] ) ? $instance[ 'content' ] : '';

		if( $source == "category" ) {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'category__in'        => absint( $category )
			) );
			$widget_link = get_category_link( $category );
		} elseif ( $source == "tag" ) {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'tag__in'             => absint( $tag )
			) );
			$widget_link = get_category_link( $tag );
		} else {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			) );
		}

		if ( $post_list->have_posts() ) :

			echo $args['before_widget'];
			if ( !empty( $title ) ) : ?>
			<h2 class="widget-title">
				<?php
				if ( !empty( $widget_link ) ) { ?>
				<a href="<?php echo esc_url( $widget_link ); ?>"><?php echo esc_html( $title ); ?></a>
				<?php } else {
					echo esc_html( $title );
				}
				?>
			</h2>
			<?php endif; ?>
			<?php
				while ( $post_list->have_posts() ) :
					$post_list->the_post();
			?>
			<article class="single-article clearfix">
			<?php
				if ( has_post_thumbnail() ) : ?>
				<div class="figure-wrap">
					<figure>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'creativepress-medium'); ?>
						</a>
					</figure>
					<?php creativepress_colored_category(); ?>
				</div>
			<?php endif; ?>
				<div class="article-content">
					<h3 class="entry-title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="entry-meta">
						<?php creativepress_entry_published(); ?>
					</div>
					<?php
					if( $content !== 'none' ) : ?>
					<div class="entry-content">
					<?php
					if ( $content == 'excerpt' ) {
						the_excerpt();
					} else {
						the_content();
						wp_link_pages();
					}
					?>
					</div>
					<?php endif;?>
				</div>
			</article>
			<?php

			endwhile;
			// Reset the post globals as this query will have stomped on it.
			wp_reset_postdata();

			echo $args['after_widget'];

		endif; // End check for post_list posts.
	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @since creativepress 1.0
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['number']     = empty( $new_instance['number'] ) ? 3 : absint( $new_instance['number'] );
		$instance[ 'source' ]   = sanitize_text_field( $new_instance[ 'source' ] );
		$instance[ 'category' ] = absint( $new_instance[ 'category' ] );
		$instance[ 'tag' ]      = absint( $new_instance[ 'tag' ] );
		$instance[ 'content' ]  = sanitize_text_field( $new_instance[ 'content' ] );

		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 * @since creativepress 1.0
	 *
	 * @param array $instance
	 */
	function form( $instance ) {
		$title    = empty( $instance['title'] ) ? '' : $instance['title'];
		$number   = empty( $instance['number'] ) ? 3 : $instance['number'];
		$source   = empty( $instance['source'] ) ? 'latest' : $instance['source'];
		$category = empty( $instance['category'] ) ? '' : $instance['category'];
		$tag      = empty( $instance['tag'] ) ? '' : $instance['tag'];
		$content  = empty( $instance['content'] ) ? 'excerpt' : $instance['content'];
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'creativepress' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'creativepress' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo absint( $number ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'source' ) ); ?>"><?php esc_html_e( 'Post Source:', 'creativepress' ); ?></label><br />
			<input type="radio" <?php checked($source, 'latest') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="latest"/><?php esc_html_e( 'Show latest Posts', 'creativepress' );?><br />
			<input type="radio" <?php checked($source,'category') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="category"/><?php esc_html_e( 'Show posts from a category', 'creativepress' );?><br />
			<input type="radio" <?php checked($source,'tag') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="tag"/><?php esc_html_e( 'Show posts from a tag', 'creativepress' );?><br /></p>

			<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category', 'creativepress' ); ?>:</label><br />
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => absint( $category ) ) ); ?></p>

			<p><label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php esc_html_e( 'Select tag', 'creativepress' ); ?>:</label><br />
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ', 'taxonomy' => 'post_tag', 'name' => $this->get_field_name( 'tag' ), 'selected' => absint( $tag ) ) ); ?></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_html_e( 'Post Content:', 'creativepress' ); ?></label><br />
			<input type="radio" <?php checked($content, 'excerpt') ?> id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="excerpt"/><?php esc_html_e( 'Show Excerpt', 'creativepress' );?><br />
			<input type="radio" <?php checked($content,'full') ?> id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="full"/><?php esc_html_e( 'Show Full Content', 'creativepress' );?><br />
			<input type="radio" <?php checked($content,'none') ?> id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="none"/><?php esc_html_e( 'No Content', 'creativepress' );?><br /></p>

		<?php
	}
}

/**
 * Custom Widget for displaying post in grid.
 *
 * Displays posts from Category/Tags or Latest Posts.
 *
 * @link http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @since       1.0.0
 */

class CreativePress_Post_Grid_Widget extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since creativepress 1.0
	 *
	 * @return CreativePress_Post_Grid_Widget
	 */
	public function __construct() {
		parent::__construct( 'widget_stories_post', esc_html__( 'CP: Post Grid Widget', 'creativepress' ), array(
			'classname'   => 'widget-stories-post clearfix',
			'description' => esc_html__( 'Use this widget to show your latest posts or posts from specific category/tag in grid.', 'creativepress' ),
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since creativepress 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 */
	public function widget( $args, $instance ) {

		$title    = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$source   = isset( $instance[ 'source' ] ) ? $instance[ 'source' ] : 'latest' ;
		$category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$tag      = isset( $instance[ 'tag' ] ) ? $instance[ 'tag' ] : '';
		$content  = isset( $instance[ 'content' ] ) ? $instance[ 'content' ] : '';

		if( $source == "category" ) {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'category__in'        => absint( $category )
			) );
			$widget_link = get_category_link( $category );
		} elseif ( $source == "tag" ) {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'tag__in'             => absint( $tag )
			) );
			$widget_link = get_category_link( $tag );
		} else {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			) );
		}

		if ( $post_list->have_posts() ) :

			echo $args['before_widget'];
			if ( !empty( $title ) ) : ?>
			<h2 class="widget-title">
				<?php
				if ( !empty( $widget_link ) ) { ?>
				<a href="<?php echo esc_url( $widget_link ); ?>"><?php echo esc_html( $title ); ?></a>
				<?php } else {
					echo esc_html( $title );
				}
				?>
			</h2>
			<?php endif; ?>
			<div class="column-wrapper">
			<?php
				while ( $post_list->have_posts() ) :
					$post_list->the_post();
				?>
			<article class="single-article column-2">
			<?php
				if ( has_post_thumbnail() ) : ?>
				<div class="figure-wrap">
					<figure>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'creativepress-grid'); ?>
						</a>
					</figure>
					<?php creativepress_colored_category(); ?>
				</div>
			<?php endif; ?>
				<div class="article-content">
					<h3 class="entry-title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="entry-meta">
						<?php creativepress_entry_published(); ?>
					</div>
					<?php
					if( $content !== 'none' ) : ?>
					<div class="entry-content">
					<?php
					if ( $content == 'excerpt' ) {
						the_excerpt();
					} else {
						the_content();
						wp_link_pages();
					}
					?>
					</div>
					<?php endif;?>
				</div>
			</article>
			<?php

			endwhile;
			// Reset the post globals as this query will have stomped on it.
			wp_reset_postdata();
			?>
			</div>
			<?php

			echo $args['after_widget'];

		endif; // End check for post_list posts.
	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @since creativepress 1.0
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['number']     = empty( $new_instance['number'] ) ? 4 : absint( $new_instance['number'] );
		$instance[ 'source' ]   = sanitize_text_field( $new_instance[ 'source' ] );
		$instance[ 'category' ] = absint( $new_instance[ 'category' ] );
		$instance[ 'tag' ]      = absint( $new_instance[ 'tag' ] );
		$instance[ 'content' ]  = sanitize_text_field( $new_instance[ 'content' ] );

		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 * @since creativepress 1.0
	 *
	 * @param array $instance
	 */
	function form( $instance ) {
		$title    = empty( $instance['title'] ) ? '' : $instance['title'];
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$source   = empty( $instance['source'] ) ? 'latest' : $instance['source'];
		$category = empty( $instance['category'] ) ? '' : $instance['category'];
		$tag      = empty( $instance['tag'] ) ? '' : $instance['tag'];
		$content  = empty( $instance['content'] ) ? 'excerpt' : $instance['content'];
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'creativepress' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'creativepress' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'source' ) ); ?>"><?php esc_html_e( 'Post Source:', 'creativepress' ); ?></label><br />
			<input type="radio" <?php checked($source, 'latest') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="latest"/><?php esc_html_e( 'Show latest Posts', 'creativepress' );?><br />
			<input type="radio" <?php checked($source,'category') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="category"/><?php esc_html_e( 'Show posts from a category', 'creativepress' );?><br />
			<input type="radio" <?php checked($source,'tag') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="tag"/><?php esc_html_e( 'Show posts from a tag', 'creativepress' );?><br /></p>

			<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category', 'creativepress' ); ?>:</label><br />
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => absint( $category ) ) ); ?></p>

			<p><label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php esc_html_e( 'Select tag', 'creativepress' ); ?>:</label><br />
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ', 'taxonomy' => 'post_tag', 'name' => $this->get_field_name( 'tag' ), 'selected' => absint( $tag ) ) ); ?></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_html_e( 'Post Content:', 'creativepress' ); ?></label><br />
			<input type="radio" <?php checked($content, 'excerpt') ?> id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="excerpt"/><?php esc_html_e( 'Show Excerpt', 'creativepress' );?><br />
			<input type="radio" <?php checked($content,'full') ?> id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="full"/><?php esc_html_e( 'Show Full Content', 'creativepress' );?><br />
			<input type="radio" <?php checked($content,'none') ?> id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="none"/><?php esc_html_e( 'No Content', 'creativepress' );?><br /></p>

		<?php
	}
}

/**
 * Custom Widget for displaying post in two columns.
 *
 * Displays posts from Category/Tags or Latest Posts.
 *
 * @link http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @since       1.0.0
 */

class CreativePress_Post_2Column_Widget extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since creativepress 1.0
	 *
	 * @return CreativePress_Post_2Column_Widget
	 */
	public function __construct() {
		parent::__construct( 'widget_featured_posts', esc_html__( 'CP: 2 Columns Post Widget', 'creativepress' ), array(
			'classname'   => 'widget-featured-posts clearfix',
			'description' => esc_html__( 'Use this widget to show your latest posts or posts from specific category/tag in grid.', 'creativepress' ),
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since creativepress 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 */
	public function widget( $args, $instance ) {

		$title    = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$source   = isset( $instance[ 'source' ] ) ? $instance[ 'source' ] : 'latest' ;
		$category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$tag      = isset( $instance[ 'tag' ] ) ? $instance[ 'tag' ] : '';

		if( $source == "category" ) {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'category__in'        => absint( $category )
			) );
			$widget_link = get_category_link( $category );
		} elseif ( $source == "tag" ) {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'tag__in'             => absint( $tag )
			) );
			$widget_link = get_category_link( $tag );
		} else {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			) );
		}

		if ( $post_list->have_posts() ) :

			echo $args['before_widget'];
			if ( !empty( $title ) ) : ?>
			<h2 class="widget-title">
				<?php
				if ( !empty( $widget_link ) ) { ?>
				<a href="<?php echo esc_url( $widget_link ); ?>"><?php echo esc_html( $title ); ?></a>
				<?php } else {
					echo esc_html( $title );
				}
				?>
			</h2>
			<?php endif; ?>
			<div class="column-wrapper">
			<?php
			$image_size = "creativepress-medium";
			$count = 1;
				while ( $post_list->have_posts() ) :
					$post_list->the_post();
			if( $count == 1 ) {
				$image_size = "creativepress-slider";
			?>
				<div class="column-5 first-post clearfix">
			<?php }
			if ( $count == 2 ) { ?>
				<div class="column-4 following-post">
			<?php
			}
			?>
				<article class="single-article">
				<?php
				if ( has_post_thumbnail() ) : ?>
				<div class="figure-wrap">
					<figure>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail($image_size); ?>
						</a>
					</figure>
					<?php creativepress_colored_category(); ?>
				</div>
			<?php endif; ?>
				<div class="article-content">
					<h3 class="entry-title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="entry-meta">
						<?php creativepress_entry_published(); ?>
					</div>
					<?php
					if ( $count == 1 ) { ?>
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>
					<?php } ?>
				</div>
			</article>
			<?php
			if ($count == 1 ) { ?>
				</div><!-- .column-5 first-post clearfix -->
			<?php }
			$count++;
			endwhile;
			if ( $count > 2 ) { ?>
				</div><!-- .column-4 following-post -->
			<?php }
			// Reset the post globals as this query will have stomped on it.
			wp_reset_postdata();
			?>
			</div>
			<?php

			echo $args['after_widget'];

		endif; // End check for post_list posts.
	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @since creativepress 1.0
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['number']     = empty( $new_instance['number'] ) ? 4 : absint( $new_instance['number'] );
		$instance[ 'source' ]   = sanitize_text_field( $new_instance[ 'source' ] );
		$instance[ 'category' ] = absint( $new_instance[ 'category' ] );
		$instance[ 'tag' ]      = absint( $new_instance[ 'tag' ] );

		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 * @since creativepress 1.0
	 *
	 * @param array $instance
	 */
	function form( $instance ) {
		$title    = empty( $instance['title'] ) ? '' : $instance['title'];
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$source   = empty( $instance['source'] ) ? 'latest' : $instance['source'];
		$category = empty( $instance['category'] ) ? '' : $instance['category'];
		$tag      = empty( $instance['tag'] ) ? '' : $instance['tag'];
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'creativepress' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'creativepress' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo absint( $number ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'source' ) ); ?>"><?php esc_html_e( 'Post Source:', 'creativepress' ); ?></label><br />
			<input type="radio" <?php checked($source, 'latest') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="latest"/><?php esc_html_e( 'Show latest Posts', 'creativepress' );?><br />
			<input type="radio" <?php checked($source,'category') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="category"/><?php esc_html_e( 'Show posts from a category', 'creativepress' );?><br />
			<input type="radio" <?php checked($source,'tag') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="tag"/><?php esc_html_e( 'Show posts from a tag', 'creativepress' );?><br /></p>

			<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category', 'creativepress' ); ?>:</label><br />
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => absint( $category ) ) ); ?></p>

			<p><label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php esc_html_e( 'Select tag', 'creativepress' ); ?>:</label><br />
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ', 'taxonomy' => 'post_tag', 'name' => $this->get_field_name( 'tag' ), 'selected' => absint( $tag ) ) ); ?></p>

		<?php
	}
}

/**
 * Custom Widget for displaying post in slider.
 *
 * Displays posts from Category/Tags or Latest Posts.
 *
 * @link http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @since       1.0.0
 */

class CreativePress_Post_Slider_Widget extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since creativepress 1.0
	 *
	 * @return CreativePress_Post_Slider_Widget
	 */
	public function __construct() {
		parent::__construct( 'widget_image_posts', esc_html__( 'CP: Post Slider Widget', 'creativepress' ), array(
			'classname'   => 'widget-image-posts clearfix',
			'description' => esc_html__( 'Use this widget to show your latest posts or posts from specific category/tag in slider.', 'creativepress' ),
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since creativepress 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 */
	public function widget( $args, $instance ) {

		$title    = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$source   = isset( $instance[ 'source' ] ) ? $instance[ 'source' ] : 'latest' ;
		$category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$tag      = isset( $instance[ 'tag' ] ) ? $instance[ 'tag' ] : '';

		if( $source == "category" ) {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'category__in'        => absint( $category )
			) );
			$widget_link = get_category_link( $category );
		} elseif ( $source == "tag" ) {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'tag__in'             => absint( $tag )
			) );
			$widget_link = get_category_link( $tag );
		} else {
			$post_list = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => absint( $number ),
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			) );
		}

		if ( $post_list->have_posts() ) :

			echo $args['before_widget'];
			if ( !empty( $title ) ) : ?>
			<h2 class="widget-title">
				<?php
				if ( !empty( $widget_link ) ) { ?>
				<a href="<?php echo esc_url( $widget_link ); ?>"><?php echo esc_html( $title ); ?></a>
				<?php } else {
					echo esc_html( $title );
				}
				?>
			</h2>
			<?php endif; ?>
			<ul class="blog-img-slider">
			<?php
				while ( $post_list->have_posts() ) :
					$post_list->the_post();
				?>
			<?php
				if ( has_post_thumbnail() ) : ?>
				<div class="figure-wrap">
					<figure>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'creativepress-medium'); ?>
						</a>
					</figure>
				</div>
			<?php endif; ?>
			<?php
			endwhile;
			// Reset the post globals as this query will have stomped on it.
			wp_reset_postdata();
			?>
			</ul>
			<?php

			echo $args['after_widget'];

		endif; // End check for post_list posts.
	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @since creativepress 1.0
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['number']     = empty( $new_instance['number'] ) ? 4 : absint( $new_instance['number'] );
		$instance[ 'source' ]   = sanitize_text_field( $new_instance[ 'source' ] );
		$instance[ 'category' ] = absint( $new_instance[ 'category' ] );
		$instance[ 'tag' ]      = absint( $new_instance[ 'tag' ] );

		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 * @since creativepress 1.0
	 *
	 * @param array $instance
	 */
	function form( $instance ) {
		$title    = empty( $instance['title'] ) ? '' : $instance['title'];
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$source   = empty( $instance['source'] ) ? 'latest' : $instance['source'];
		$category = empty( $instance['category'] ) ? '' : $instance['category'];
		$tag      = empty( $instance['tag'] ) ? '' : $instance['tag'];
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'creativepress' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'creativepress' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo absint( $number ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'source' ) ); ?>"><?php esc_html_e( 'Post Source:', 'creativepress' ); ?></label><br />
			<input type="radio" <?php checked($source, 'latest') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="latest"/><?php esc_html_e( 'Show latest Posts', 'creativepress' );?><br />
			<input type="radio" <?php checked($source,'category') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="category"/><?php esc_html_e( 'Show posts from a category', 'creativepress' );?><br />
			<input type="radio" <?php checked($source,'tag') ?> id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" value="tag"/><?php esc_html_e( 'Show posts from a tag', 'creativepress' );?><br /></p>

			<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category', 'creativepress' ); ?>:</label><br />
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => absint( $category ) ) ); ?></p>

			<p><label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php esc_html_e( 'Select tag', 'creativepress' ); ?>:</label><br />
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ', 'taxonomy' => 'post_tag', 'name' => $this->get_field_name( 'tag' ), 'selected' => absint( $tag ) ) ); ?></p>

		<?php
	}
}