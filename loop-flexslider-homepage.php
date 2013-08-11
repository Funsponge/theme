<div class="flex-container omc-resize-620">
	
		<div class="flexslider">
		
		    <ul class="slides">
		    
			<?php

				 $querydetails = "
				   SELECT wposts.*
				   FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
				   WHERE wposts.ID = wpostmeta.post_id
				   AND wpostmeta.meta_key = 'omc_featured_post'
				   AND wpostmeta.meta_value = '1'
				   AND wposts.post_status = 'publish'
				   AND wposts.post_type = 'post'
				   ORDER BY wposts.post_date DESC
				 ";

				 $pageposts = $wpdb->get_results($querydetails, OBJECT)
						
			?>
			<?php 
			
			$i = 0;
			if ($pageposts):
			foreach ($pageposts as $post):
			setup_postdata($post); 
			$category = get_the_category(); 
			$omc_is_video = get_post_meta(get_the_ID(), 'omc_is_video', true);  
			$i++;
			$format = get_post_format();
			if ($i <9) {
			?>			

		    	<li>	
				
					<?php if($category[0]){ echo '<a href="'.get_category_link($category[0]->term_id ).'" class="omc-flex-category">'.$category[0]->cat_name.'</a>';} ?>
					
		    		<a href="<?php the_permalink();?>">
					
						<?php if ($format == 'video' || $format == 'audio') {?>
						
							<span class="omc-big-video-icon"></span>
							
						<?php } ?>
						
						<?php if (has_post_thumbnail()) { 
						
								the_post_thumbnail('featured-image'); 
								
							} else {
							
								echo('<img src="'.get_template_directory_uri().'/images/no-image-featured-image.png" class="omc-image-resize" alt="no image" />');
								
						} ?>
					
					</a>
					
		    		<div class="flex-caption omc-featured-overlay">
					
					<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
						
						<p><?php wpe_excerpt('wpe_minislider', 'wpe_excerptmore'); ?></p>
						
					</div>
		    	</li>
			<?php } endforeach; 	endif; wp_reset_query();?>		    
			
		    </ul><!-- /slides -->
			
		 </div><!-- /flexsilder -->
		 
	</div><!-- /felx-container -->