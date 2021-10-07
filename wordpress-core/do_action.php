<?php
/**
 * Title: How Wordpress do_action() works - Hook Guide
 * Desc: A snippet that helps to understand the do_action of wordpress. Note is just a summarized
 * Date Modified: 10/07/21
 * 
 * Author: Jaime I. Guevarra Jr.
 */

?>

<header>
    <!-- Let Assume there a header content here and we need to add more actions after header section -->
</header>

<!-- After Header Action --> 
<div class="_themename-after-header">
    <div class="container">
        
        <?php do_action('_themename_after_header');  //@args is the name of your action ?> 

    </div>
</div>
<!-- End After Header Action --> 



<?php 
/** Do add a content/section on this action { _themename_after_header } . You must create your own function the add to it. */

function formSection(){ //add form section after header section
    ?>
        <!-- html contents here -->
    <?php
}

function formSection(){ //add infograph after header section
    ?>
        <!-- html contents here -->
    <?php
}


//Notes @Arguements of add_action()
//1st - is the name of the do_action which in our case is { _themename_after_header  }
//2nd - your function name to attach in our case its formSection
//3rd - is the index it must be integer

add_action('_themename_after_header', 'formSection');
add_action('_themename_after_header', 'infoGraph');

//if you want to remove just call remove_action
remove_action('_themename_after_header', 'formSection'); //it must same arguement to its add_action

/** Notes:
 *  We can add multiple content/actions to our { _themename_after_header }
 *
 */

?>