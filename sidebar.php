<section id="omc-sidebar" class="omc-right">

	<a href="#top" class="omc-mobile-back-to-top"><?php _e('Back to Top', 'gonzo');?> &uarr;</a>
	
	<ul class="xoxo">
		<?php 	
			if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				$post_custom = get_post_meta($post->ID,'omc_page_sidebar',true);
			endwhile; endif; 
			
			if (!empty($post_custom)){
				dynamic_sidebar($post_custom);
			} else {
				dynamic_sidebar(get_sidebar_name());
			}	 
		?>					

	</ul><!-- /xoxo -->

</section>	

<br class="clear" />
	
</div> <!--! end of #container -->