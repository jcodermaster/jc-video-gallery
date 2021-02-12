<?php

function jc_video_gallery_post() { 	
    
    $cpt_name = "video-gallery";
    $slug_term = "jc-video-gallery";
    
    register_post_type( $cpt_name, 
    	 	
		array('labels' => array(
			'name' => __('Videos', $slug_term), /* This is the Title of the Group */
			'singular_name' => __('Video', $slug_term), /* This is the individual type */
			'all_items' => __('All Videos', $slug_term), /* the all items menu item */
			'add_new' => __('Add New', $slug_term), /* The add new menu item */
			'add_new_item' => __('Add New Video', $slug_term), /* Add New Display Title */
			'edit' => __( 'Edit', $slug_term ), /* Edit Dialog */
			'edit_item' => __('Edit Video', $slug_term), /* Edit Display Title */
			'new_item' => __('New Video', $slug_term), /* New Display Title */
			'view_item' => __('View Video', $slug_term), /* View Display Title */
			'search_items' => __('Search Video', $slug_term), /* Search Course Title */ 
			'not_found' =>  __('Nothing found in the Database.', $slug_term), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', $slug_term), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
            
            'description' => __( '', $slug_term ), 
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-video-alt3', /* the icon for the custom Course menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'video', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'author', 'thumbnail', 'excerpt', 'revisions')
	 	) /* end of options */
	); /* end of register Course */
	
	$all_items = "Videos";
	$name = "Video";
	// now let's add custom categories (these act like categories)
    register_taxonomy(  $cpt_name.'_cat', 
    	array( $cpt_name ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( $all_items.' Categories', $slug_term ), /* name of the custom taxonomy */
    			'singular_name' => __( $name.' Category', $slug_term ), /* single taxonomy name */
    			'search_items' =>  __( 'Search '.$name.' Categories', $slug_term ), /* search title for taxomony */
    			'all_items' => __( 'All '.$name, $slug_term ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent '.$name.' Category', $slug_term ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent '.$name.' Category:', $slug_term ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit '.$name.' Category', $slug_term ), /* edit '.$name.' taxonomy title */
    			'update_item' => __( 'Update '.$name.' Category', $slug_term ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New '.$name, $slug_term ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New '.$name, $slug_term ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' =>  $cpt_name.'-category' ),
    	)
    ); 
	
} 
	
add_action( 'init', 'jc_video_gallery_post');		