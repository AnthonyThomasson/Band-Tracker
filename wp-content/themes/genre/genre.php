<?php
/**
 * @package Genre_Init
 * @version 1.0
 */
/*
Plugin Name: Genre Init
Description: This is how we init an genre
Author: Athony Thomasson
Version: 1.0
*/

/**
 * initializes an artist
**/
	
	add_action('init', 'genre_init', 0);
	function genre_init() {
		$labels = array(
						'name' =>__('Genres'),
						'singular_name' => __('Genre'),
						'add_new_item' => __('Add new Genre'),
						'all_items' => __('All Genres'),
						'view_item' => __('View Genre'),
						'edit_item' => __('Edit Genre'),
						'update_item' => __('Update Genre'),
						'search_items'=> __('Search Genres'),
						'not_found' => __('Not Found'),
						'not_found_in_trash' => __('Not Found in Trash :('),
					  );

		$args = array(
						'labels' => $labels,
						'description' => 'Conatains Genre data',
						'public' => TRUE,
						'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
						'has_archive' => TRUE,

						 'taxonomies'          => array( 'genres' ),
				        /* A hierarchical CPT is like Pages and can have
				        * Parent and child items. A non-hierarchical CPT
				        * is like Posts.
				        */ 
				        'hierarchical'        => false,
				        'public'              => true,
				        'show_ui'             => true,
				        'show_in_menu'        => true,
				        'show_in_nav_menus'   => true,
				        'show_in_admin_bar'   => true,
				        'menu_position'       => 5,
				        'can_export'          => true,
				        'has_archive'         => true,
				        'exclude_from_search' => false,
				        'publicly_queryable'  => true,
				        'capability_type'     => 'page',

			         );

		
		register_post_type('genre', $args);
	}
?>