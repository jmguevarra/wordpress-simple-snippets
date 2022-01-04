<?php
/**
 * Snippet Name: Additional Field for Taxonomy
 * Desc: In specific taxonomy additional can be added by code below
 * Screenshot: 
 * 
 * Author: Jaime Guevarra Jr.
 * Email: jaimeguevarra22@gmail.com
 */

// add the field to the edit screen of Post Tag
add_action( 'post_tag_edit_form_fields', 'lee_edit_post_tag_fields', 10, 2 );
function lee_edit_post_tag_fields( $term, $taxonomy ) {
    $value = get_term_meta($term->term_id, 'lee_post_tag', true );
    ?>
        <tr class="form-field">
			<th scope="row"><label for="lee_post_tag">Show Only</label></th>
			<td>
				<select id="lee_post_tag" name="lee_post_tag">
					<option value="default">Default</option>
					<option value="logged-user" <?php if($value == 'logged-user'){ echo 'selected="selected"'; } ?> >Logged User</option>
				</select>
			<p class="description">Show this tag in given option above.</p></td>
		</tr>
    <?php
}

add_action( 'created_post_tag', 'lee_created_post_tag_fields' );
add_action( 'edited_post_tag', 'lee_created_post_tag_fields' );
function lee_created_post_tag_fields( $term_id ) {
    update_term_meta( $term_id, 'lee_post_tag', sanitize_text_field( $_POST['lee_post_tag'] ) );
}