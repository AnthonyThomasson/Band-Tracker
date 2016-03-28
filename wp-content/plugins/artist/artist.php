<?php
/**
 * @package Artist_Init
 * @version 1.0
 */
/*
Plugin Name: Artist Init
Description: This is how we init an artist.
Author: Tyler Rop
Version: 1.0
*/

/**
 * initializes an artist
**/
	
	add_action('init', 'artist_init', 0);
	function artist_init() {
		$labels = array(
						'name' =>__('Artists'),
						'singular_name' => __('Artists'),
						'add_new_item' => __('Add new Artist'),
						'all_items' => __('All Artists'),
						'view_item' => __('View Artist'),
						'edit_item' => __('Edit Artist'),
						'update_item' => __('Update Artist'),
						'search_items'=> __('Search Artists'),
						'not_found' => __('Not Found'),
						'not_found_in_trash' => __('Not Found in Trash :('),
					  );

		$args = array(
						'labels' => $labels,
						'description' => 'Contains Artist data',
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

		
		register_post_type('artist', $args);
	}
?>	