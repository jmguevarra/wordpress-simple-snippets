<?php
/**
 * Title: How Wordpress pre_get_posts() works - Hook Guide
 * Desc: A snippet that helps to understand the pre_get_posts() of wordpress. Note is just a summarized
 * Date Modified: 10/07/21
 * 
 * Author: Jaime I. Guevarra Jr.
 */


//Let assume we want to modify post query before post is being retreived

add_action('pre_get_posts', 'function_to_add');
function function_to_add($query){

    if( $query->is_main_query() ){
        $query->set('posts_per_page', 2); //it limits the posts per page if query is main
    }

}

/**
 * Notes: 
 * Arguement is a query object see here: https://developer.wordpress.org/reference/hooks/pre_get_posts/
 * 
 */