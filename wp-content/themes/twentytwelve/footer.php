<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'twentytwelve_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<script src="http://gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/js/bjqs-1.3.min.js"></script>
 <script class="secret-source">
        jQuery(document).ready(function($) {
          if($('div').is('#banner-fade')) {
	          $('#banner-fade').bjqs({
	            height      : 320,
	            width       : 620,
	            responsive  : true
	          });
	      }

        });
      </script>
<?php wp_footer(); ?>
</body>
</html>