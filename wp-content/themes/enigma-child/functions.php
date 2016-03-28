<?php

	add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
	
	function enqueue_parent_theme_style() 
	{
	    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	}




	// custom tweets for artist page

	function tweets_by_hashtag_9867($atts, $content = null)
	{
            extract(shortcode_atts(array(
                "hashtag" => 'default_tag',
                "number" => 5,
                ), $atts));
        $api_url = 'http://search.twitter.com/search.json';
        $raw_response = wp_remote_get("$api_url?q=%23$hashtag&rpp=$number");

        if ( is_wp_error($raw_response) ) {
            $output = "<p>Failed to update from Twitter!</p>\n";
            $output .= "<!--{$raw_response->errors['http_request_failed'][0]}-->\n";
            $output .= get_option('twitter_hash_tag_cache');
        } else {
            if ( function_exists('json_decode') ) {
                $response = get_object_vars(json_decode($raw_response['body']));
                for ( $i=0; $i < count($response['results']); $i++ ) {
                    $response['results'][$i] = get_object_vars($response['results'][$i]);
                }
            } else {
                include(ABSPATH . WPINC . '/js/tinymce/plugins/spellchecker/classes/utils/JSON.php');
                $json = new Moxiecode_JSON();
                $response = @$json->decode($raw_response['body']);
            }

            $output = "<div class='twitter-hash-tag'>\n";
            foreach ( $response['results'] as $result ) {
                $text = $result['text'];
                $user = $result['from_user'];
                $image = $result['profile_image_url'];
                $user_url = "http://twitter.com/$user";
                $source_url = "$user_url/status/{$result['id']}";

                $text = preg_replace('|(https?://[^\ ]+)|', '<a href="$1">$1</a>', $text);
                $text = preg_replace('|@(\w+)|', '<a href="http://twitter.com/$1">@$1</a>', $text);
                $text = preg_replace('|#(\w+)|', '<a href="http://search.twitter.com/search?q=%23$1">#$1</a>', $text);

                $output .= "<div>";

                if ( $images )
                    $output .= "<a href='$user_url'><img src='$image' alt='$user' /></a>";
                $output .= "<a href='$user_url'>$user</a>: $text <a href='$source_url'>&raquo;</a></div>\n";
            }
            $output .= "<div class='view-all'><a href='http://search.twitter.com/search?q=%23$hashtag'>" . __('View All') . "</a></div>\n";
            $output .= "</div>\n";
        }

        return $output;
	}

	add_shortcode("hashtag_tweets", "tweets_by_hashtag_9867");


    function catch_that_image() 
    {
      global $post, $posts;
      $first_img = '';
      ob_start();
      ob_end_clean();
      $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
      $first_img = $matches [1] [0];

      if(empty($first_img)){ //Defines a default image
        $first_img = "NO";
      }
      return $first_img;
    }

    add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
    function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'primary' )
        return $items."<div class='input-group' style='margin-top: -5px;'>
                            <li class='menu-header-search'>
                                <form action='http://wpress.bandtracker.ca/' id='searchform' method='get'>
                                    <input class='form-control' type='text' name='s' id='s' placeholder='Search'>
                                    <span class='input-group-btn'>
                                        <button class='btn btn-search' type='submit'>
                                            <i class='fa fa-search'></i>
                                        </button>
                                    </span>
                                </form>
                            </li>
                        </div>";
    return $items;
    }

?>