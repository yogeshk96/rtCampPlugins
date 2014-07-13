<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
  <style>
  .bjqs-controls {
  	display: none;
  }
  </style>
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

                
                <?php
                $postid = get_the_ID();
                $custom_fields = get_post_custom($postid);
                        //--checking all the custom fields of the current post in the loop and storing their values in variables--
						foreach ( $custom_fields as $field_key => $field_values ) {
							foreach ( $field_values as $key => $value )
							{
								if(strpos($field_key, 'authorId-') !== false)
								{
									$authorIdArr[] = $value;
								}

							}
						}

						if(!empty($authorIdArr)) { ?>
                            
                            <h3>Contributor(s) of this article</h3>

                           <?php
                           
                            foreach ($authorIdArr as $authorID) {
                            	
                            	$authorName = get_the_author_meta( 'user_nicename', $authorID );
                            	$authorUrl = get_author_posts_url($authorID); ?>

                            	<div class="authorBox"><a href="<?php echo $authorUrl; ?>"><?php echo $authorName; ?></a></div>


                   <?php    } 
 
						}
						
                ?>
                <div style="clear:both;height:30px;border-bottom:1px solid #ccc;"></div>
				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>



		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>