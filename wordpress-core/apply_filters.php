<?php
/**
 * Title: How Wordpress apply_filters() works - Hook Guide
 * Desc: A snippet that helps to understand the apply_filters() of wordpress. Note is just a summarized
 * Date Modified: 10/07/21
 * Filter Reference of Wordpress: https://codex.wordpress.org/Plugin_API/Filter_Reference
 * 
 * Author: Jaime I. Guevarra Jr.
 */

?>

<!-- Assume we have posts loop and you want to filter the message if there's no post found -->
<div class="articles">
    <div class="container">

        <?php if( have_post() ): ?>
            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                <h2>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>

            <?php endwhile; ?>
        <?php else: //no post ?> 
                <p>
                    <?php apply_filters( '_themename_no_post_text', esc_html_e( 'Sorry, no posts found.', '_themename')); ?>
                </p>
        <?php endif; ?>
    </div>
</div>


<?php 
/**
 * Usage of using filter action
 * 
 * @arguement of add_filter()
 * 1st - filter_name in our case its _themename_no_post_text
 * 2nd - your custom function to filter our it
 * 3rd - priority index must integer
 * 4th - accepted arguement
 */

add_filter('_themename_no_post_text', 'noPostText', 10, 1);
function noPostText($text){
    return $text = 'Update your message text here for no post';
}