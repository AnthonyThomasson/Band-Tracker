<?php
/**
 * @package Event_Init
 * @version 1.0
 */
/*
Plugin Name: Event Init
Description: This is how we init an event
Author: Not Tyler 2.0
Version: 1.0
*/

/**
 * initializes an event
**/
	
	add_action('init', 'event_init', 0);
	function event_init() {
		$labels = array(
						'name' =>__('Events'),
						'singular_name' => __('Events'),
						'add_new_item' => __('Add new Event'),
						'all_items' => __('All Events'),
						'view_item' => __('View Event'),
						'edit_item' => __('Edit Event'),
						'update_item' => __('Update Event'),
						'search_items'=> __('Search Events'),
						'not_found' => __('Not Found'),
						'not_found_in_trash' => __('Not Found in Trash :('),
					  );

		$args = array(
						'labels' => $labels,
						'description' => 'Conatains Event data',
						'public' => TRUE,
						'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
						'has_archive' => TRUE,

						 'taxonomies'          => array( 'events' ),
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

		
		register_post_type('event', $args);
	}
?>