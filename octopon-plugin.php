<?php
/*
Plugin Name: octopon
Plugin URI: https://octopon.me
Description: Create and distribute any type of coupons, anywhere with Octopon
Version: 1.0
Author: Octopon
License: GPL2
*/

class octopon_widget extends WP_Widget {

	// constructor
	function octopon_widget() {
		parent::WP_Widget(false, $name = __('Octopon Widget', 'octopon_widget') );
	}

	// widget form creation
	function form($instance) {
		// Check values
		if( $instance) {
			$title = esc_attr($instance['title']);
			$url = esc_attr($instance['url']);
		} else {
			$title = '';
			$url = '';
		}
		?>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'octopon_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('My Embed Url from Octopon', 'octopon_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
		</p>

		<?php
	}

	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
    // Fields
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['url'] = strip_tags($new_instance['url']);
    return $instance;
	}

	// widget display
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$url = $instance['url'];
		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';

		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if( $url ) {
			echo '<iframe frameborder="0" src="' . $url . '" style="width: 300px; height: 300px;"></iframe>';
		} else {
			echo '<div style="text-align: center;">
				<p>' . __('Website owner', 'octopon_widget') . '</p>
				<p>' . __('Join and create your coupons and they will automatically be shown here', 'octopon_widget') . '</p>
				<br/><br/>
				<p><a target="_blank" href="https://octopon.me/biz-onboarding">' . __('CREATE YOUR FIRST COUPON', 'octopon_widget') . '</a></p>
			</div>';
		}
		
		echo '</div>';
		echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("octopon_widget");'));
?>