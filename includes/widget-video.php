<?php
/**
 * Video Widget Class
 */
class video_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function video_widget() {
        parent::WP_Widget(false, $name = 'Video Widget');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $message 	= $instance['message'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<div class="omc-video-container">
								<?php echo $message; ?>
							</div>
              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = $new_instance['message'];
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'gonzo'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title', 'gonzo'); ?>" name="<?php echo $this->get_field_name('title', 'gonzo'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>">Video Embed Code</label> 
          <input class="widefat" id="<?php echo $this->get_field_id('message' , 'gonzo'); ?>" name="<?php echo $this->get_field_name('message' , 'gonzo'); ?>" type="text" value="<?php echo $message; ?>" />
        </p>
        <?php 
    }
 
 
} // end class video_widget
add_action('widgets_init', create_function('', 'return register_widget("video_widget");'));
?>
