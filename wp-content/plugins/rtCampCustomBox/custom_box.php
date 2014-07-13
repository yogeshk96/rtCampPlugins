<?php 
/*
Plugin Name: rtCampCustomBox
Plugin URI: http://gadgets-accessories.com/rtcamp/wp-plugin.php
Description: Make use of our super-cool widget that can spice up your blog posts/articles. The widget lists all the contributers who contributed for the article
Version: 1.0
Author: Gadgetronica
Author URI: http://gadgets-accessories.com/rtcamp/
License: A "Slug" license name e.g. GPL2
*/
/*--------------------------------Adding meta boxes----------------------------------------------------- */

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_custom_box() {

    $screens = array( 'post', 'page' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            __( 'CONTRIBUTORS CUSTOM FIELDS', 'myplugin_textdomain' ),
            'myplugin_inner_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_inner_custom_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */

   global $wpdb;

   $authorsId = $wpdb->get_results("SELECT meta_value from $wpdb->postmeta WHERE meta_key LIKE 'authorId-%' AND post_id='".$post->ID."' ");
   

   //looping each author id stored for the current post
   foreach($authorsId as $ID) {

    //array to store the IDs which are already checked earlier
    $idList[] = $ID->meta_value;

    echo '<tr><td style="width:60px;"><label for="author_name">';
       _e( the_author_meta('display_name', $ID->meta_value), 'myplugin_textdomain' );
    echo '</label> -</td>';
    echo '<td colspan="2"><input type="checkbox" checked="checked"  name="author_id[]" value="'.$ID->meta_value.'" style="margin:0 5px 0 5px;" size="25" /><div style="clear:both;height:10px;"></div><td></tr>';

   }
  if(!empty($idList)) {

    //creating list so that we can exclude them from the remaining authors and keep the remaining authors unchecked as they are not checked earlier
    $mainList = implode(",", $idList);
    
  } else {

    $mainList = "";
  }
  
  //excluding the main author's name from the list
  $excludeThisAuthorID = $post->post_author;
  
  if($mainList != "") {

    $mainList .= ",".$excludeThisAuthorID;
  } else {

    $mainList = $excludeThisAuthorID;
  }

  $mainList = "(".$mainList.")";
  //query for getting authors who are not checked for the current post
  $authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users WHERE ID NOT IN ".$mainList." ORDER BY display_name");
  
  //looping each author id who are not checked
	foreach($authors as $author) {
    echo '<tr><td style="width:60px;"><label for="author_name">';
       _e( the_author_meta('display_name', $author->ID), 'myplugin_textdomain' );
    echo '</label> -</td>';
    echo '<td colspan="2"><input type="checkbox" name="author_id[]" value="'.$author->ID.'" style="margin:0 5px 0 5px;" size="25" /><div style="clear:both;height:10px;"></div><td></tr>';

	
	}

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['myplugin_inner_custom_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }
  
  /* OK, its safe for us to save the data now. */
   
    foreach($_POST['author_id'] as $id) {

            update_post_meta( $post_id, 'authorId-'.$id, $id );
         
    }
  
 
}
add_action( 'save_post', 'myplugin_save_postdata' );

/* ----------------------------Adding meta boxes ends----------------------------------------------------*/




?>