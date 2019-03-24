<?php
function mindset_register_custom_post_types() {
    $labels = array(
        'name'               => _x( 'Students', 'post type general name' ),
        'singular_name'      => _x( 'Student', 'post type singular name'),
        'menu_name'          => _x( 'Students', 'admin menu' ),
        'name_admin_bar'     => _x( 'Student', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Student' ),
        'add_new_item'       => __( 'Add New Student' ),
        'new_item'           => __( 'New Student' ),
        'edit_item'          => __( 'Edit Student' ),
        'view_item'          => __( 'View Student' ),
        'all_items'          => __( 'All Students' ),
        'search_items'       => __( 'Search Students' ),
        'parent_item_colon'  => __( 'Parent Students:' ),
        'not_found'          => __( 'No Students found.' ),
        'not_found_in_trash' => __( 'No Students found in Trash.' ),
        'archives'           => __( 'Student Archives'),
        'insert_into_item'   => __( 'Insert into Student'),
        'uploaded_to_this_item' => __( 'Uploaded to this Student'),
        'filter_item_list'   => __( 'Filter Students list'),
        'items_list_navigation' => __( 'Students list navigation'),
        'items_list'         => __( 'Students list'),
        'featured_image'     => __( 'Students feature image'),
        'set_featured_image' => __( 'Set Students feature image'),
        'remove_featured_image' => __( 'Remove Students feature image'),
        'use_featured_image' => __( 'Use as feature image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'students' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'thumbnail', 'editor' ),
    );
    register_post_type( 'student', $args );
 
    $labels = array(
        'name'               => _x( 'Staff', 'post type general name' ),
        'singular_name'      => _x( 'Staff', 'post type singular name'),
        'menu_name'          => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'     => _x( 'Staff', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Staff' ),
        'add_new_item'       => __( 'Add New Staff' ),
        'new_item'           => __( 'New Staff' ),
        'edit_item'          => __( 'Edit Staff' ),
        'view_item'          => __( 'View Staff' ),
        'all_items'          => __( 'All Staff' ),
        'search_items'       => __( 'Search Staff' ),
        'parent_item_colon'  => __( 'Parent Staff:' ),
        'not_found'          => __( 'No Staff found.' ),
        'not_found_in_trash' => __( 'No Staff found in Trash.' ),
        'archives'           => __( 'Staff Archives'),
        'insert_into_item'   => __( 'Insert into Staff'),
        'uploaded_to_this_item' => __( 'Uploaded to this Staff'),
        'filter_item_list'   => __( 'Filter Staff list'),
        'items_list_navigation' => __( 'Staff list navigation'),
        'items_list'         => __( 'Staff list'),
        'featured_image'     => __( 'Staff feature image'),
        'set_featured_image' => __( 'Set Staff feature image'),
        'remove_featured_image' => __( 'Remove Staff feature image'),
        'use_featured_image' => __( 'Use as feature image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'thumbnail', 'editor' ),
    );
    register_post_type( 'staff', $args );
 
    $labels = array(
        'name'               => _x( 'Schedule', 'post type general name'  ),
        'singular_name'      => _x( 'Schedule', 'post type singular name'  ),
        'menu_name'          => _x( 'Schedule', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Schedule', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Schedule' ),
        'add_new_item'       => __( 'Add New Schedule' ),
        'new_item'           => __( 'New Schedule' ),
        'edit_item'          => __( 'Edit Schedule' ),
        'view_item'          => __( 'View Schedule'  ),
        'all_items'          => __( 'All Schedule' ),
        'search_items'       => __( 'Search Schedule' ),
        'parent_item_colon'  => __( 'Parent Schedule:' ),
        'not_found'          => __( 'No Schedule found.' ),
        'not_found_in_trash' => __( 'No Schedule found in Trash.' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'schedule' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title' )
    );
 register_post_type( 'schedule', $args );
 
 $labels = array(
    'name'               => _x( 'Services', 'post type general name' ),
    'singular_name'      => _x( 'Service', 'post type singular name' ),
    'menu_name'          => _x( 'Services', 'admin menu' ),
    'name_admin_bar'     => _x( 'Service', 'add new on admin bar' ),
    'add_new'            => _x( 'Add New', 'service'  ),
    'add_new_item'       => __( 'Add New Service'  ),
    'new_item'           => __( 'New Service' ),
    'edit_item'          => __( 'Edit Service' ),
    'view_item'          => __( 'View Service' ),
    'all_items'          => __( 'All Services'  ),
    'search_items'       => __( 'Search Services' ),
    'parent_item_colon'  => __( 'Parent Services:' ),
    'not_found'          => __( 'No services found.' ),
    'not_found_in_trash' => __( 'No services found in Trash.' ),
    'insert_into_item'   => __( 'Insert into service'),
    'uploaded_to_this_item' => __( 'Uploaded to this service'),
    );

    $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
	'show_in_rest'      => true,
	'query_var'          => true,
    'rewrite'            => array( 'slug' => 'services'),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => 5,
    'menu_icon'          => 'dashicons-align-none',
    'supports'           => array( 'title', 'editor' )
    );

 register_post_type( 'service', $args );
 


 $labels = array(
	'name'               => _x( 'Gallery', 'post type general name'  ),
	'singular_name'      => _x( 'Gallery', 'post type singular name'  ),
	'menu_name'          => _x( 'Gallery', 'admin menu'  ),
	'name_admin_bar'     => _x( 'Gallery', 'add new on admin bar' ),
	'add_new'            => _x( 'Add New', 'Gallery' ),
	'add_new_item'       => __( 'Add New Gallery' ),
	'new_item'           => __( 'New Gallery' ),
	'edit_item'          => __( 'Edit Gallery' ),
	'view_item'          => __( 'View Gallery'  ),
	'all_items'          => __( 'All Gallery' ),
	'search_items'       => __( 'Search Gallery' ),
	'parent_item_colon'  => __( 'Parent Gallery:' ),
	'not_found'          => __( 'No Gallery found.' ),
	'not_found_in_trash' => __( 'No Gallery found in Trash.' ),
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'show_in_rest'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'Gallery' ),
	'capability_type'    => 'post',
	'has_archive'        => false,
	'hierarchical'       => false,
	'menu_position'      => 5,
	'menu_icon'          => 'dashicons-heart',
	'supports'           => array( 'title' )
);
register_post_type( 'Gallery', $args );



$labels = array(
	'name'               => _x( 'partner', 'post type general name'  ),
	'singular_name'      => _x( 'partner', 'post type singular name'  ),
	'menu_name'          => _x( 'partner', 'admin menu'  ),
	'name_admin_bar'     => _x( 'partner', 'add new on admin bar' ),
	'add_new'            => _x( 'Add New', 'partner' ),
	'add_new_item'       => __( 'Add New partner' ),
	'new_item'           => __( 'New partner' ),
	'edit_item'          => __( 'Edit partner' ),
	'view_item'          => __( 'View partner'  ),
	'all_items'          => __( 'All partner' ),
	'search_items'       => __( 'Search partner' ),
	'parent_item_colon'  => __( 'Parent partner:' ),
	'not_found'          => __( 'No partner found.' ),
	'not_found_in_trash' => __( 'No partner found in Trash.' ),
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'partner' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => 5,
	'menu_icon'          => 'dashicons-heart',
	'supports'           => array( 'title' )
);
register_post_type( 'partner', $args );


$args = array(
    'public' => true,
    'label'  => 'Books',
    'show_in_rest' => true,
    'template' => array(
        array( 'core/image', array(
            'align' => 'left',
        ) ),
        array( 'core/heading', array(
            'placeholder' => 'Add Author...',
        ) ),
        array( 'core/paragraph', array(
            'placeholder' => 'Add Description...',
        ) ),
    ),
);
register_post_type( 'book', $args );


$args = array(
    'public' => true,
    'label'  => 'Job Postings',
    'show_in_rest' => true,
    'template' => array(
        array( 'core/heading', array( 'level' => '3', 'content' => 'Role', ) ),
        array( 'core/paragraph', array( 'placeholder' => 'Describe the role...' ) ),
        array( 'core/heading', array( 'level' => '3', 'content' => 'Requirements' ) ),
        array( 'core/list' ),
        array( 'core/heading', array( 'level' => '3', 'content' => 'Location' ) ),
        array( 'core/paragraph' ),
        array( 'core/heading', array( 'level' => '3', 'content' => 'How to Apply' ) ),
        array( 'core/paragraph' ),
    ),
    'template_lock' => 'all',
);
register_post_type( 'job-postings', $args );
}

 add_action( 'init', 'mindset_register_custom_post_types' );


 function mindset_rewrite_flush() {
	mindset_register_custom_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'mindset_rewrite_flush' );



function mindset_register_taxonomies() {
    // Add Student Catagory taxonomy - hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Student Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Student Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Student Categories' ),
        'all_items'         => __( 'All Student Category' ),
        'parent_item'       => __( 'Parent Student Category' ),
        'parent_item_colon' => __( 'Parent Student Category:' ),
        'edit_item'         => __( 'Edit Student Category' ),
        'view_item'         => __( 'Vview Student Category' ),
        'update_item'       => __( 'Update Student Category' ),
        'add_new_item'      => __( 'Add New Student Category' ),
        'new_item_name'     => __( 'New Student Category Name' ),
        'menu_name'         => __( 'Student Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'student-categories' ),
    );
	register_taxonomy( 'student-category', array( 'student' ), $args );
    
    
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Categories' ),
        'all_items'         => __( 'All Staff Category' ),
        'parent_item'       => __( 'Parent Staff Category' ),
        'parent_item_colon' => __( 'Parent Staff Category:' ),
        'edit_item'         => __( 'Edit Staff Category' ),
        'view_item'         => __( 'Vview Staff Category' ),
        'update_item'       => __( 'Update Staff Category' ),
        'add_new_item'      => __( 'Add New Staff Category' ),
        'new_item_name'     => __( 'New Staff Category Name' ),
        'menu_name'         => __( 'Staff Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff-categories' ),
    );
	register_taxonomy( 'staff-category', array( 'staff' ), $args );
// Add Featured taxonomy
$labels = array(
	'name'              => _x( 'Featured', 'taxonomy general name' ),
	'singular_name'     => _x( 'Featured', 'taxonomy singular name' ),
	'search_items'      => __( 'Search Featured' ),
	'all_items'         => __( 'All Featured' ),
	'parent_item'       => __( 'Parent Featured' ),
	'parent_item_colon' => __( 'Parent Featured:' ),
	'edit_item'         => __( 'Edit Featured' ),
	'update_item'       => __( 'Update Featured' ),
	'add_new_item'      => __( 'Add New Featured' ),
	'new_item_name'     => __( 'New Work Featured' ),
	'menu_name'         => __( 'Featured' ),
   );
   $args = array(
	   'hierarchical'      => true,
	   'labels'            => $labels,
	   'show_ui'           => true,
	   'show_admin_column' => true,
	   'show_in_rest'      => true,
	   'query_var'         => true,
	   'rewrite'           => array( 'slug' => 'featured' ),
   );
   register_taxonomy( 'featured', array( 'work' ), $args );


 }
 add_action( 'init', 'mindset_register_taxonomies');