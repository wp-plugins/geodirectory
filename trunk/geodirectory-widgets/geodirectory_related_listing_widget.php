<?php

/**
* Geodirectory popular posts widget *
**/
class geodir_related_listing_postview extends WP_Widget {

	function geodir_related_listing_postview()
	{
		//Constructor
		$widget_ops = array('classname' => 'geodir_related_listing_post_view', 'description' => __('GD > Related Listing',GEODIRECTORY_TEXTDOMAIN) );
		$this->WP_Widget('post_related_listing', __('GD > Related Listing',GEODIRECTORY_TEXTDOMAIN), $widget_ops);
	}
	
	
	function widget($args, $instance) 
	{
		
		// prints the widget
		extract($args, EXTR_SKIP);
		
		$title = empty($instance['title']) ? __('Related Listing',GEODIRECTORY_TEXTDOMAIN) : apply_filters('widget_title', __($instance['title'],GEODIRECTORY_TEXTDOMAIN));
	
		$post_number = empty($instance['post_number']) ? '5' : apply_filters('widget_post_number', $instance['post_number']);
		
		$relate_to = empty($instance['relate_to']) ? 'category' : apply_filters('widget_relate_to', $instance['relate_to']);
		
		$layout = empty($instance['layout']) ? 'gridview_onehalf' : apply_filters('widget_layout', $instance['layout']);
		
		$add_location_filter = empty($instance['add_location_filter']) ? '0' : apply_filters('widget_layout', $instance['add_location_filter']);
		
		$listing_width = empty($instance['listing_width']) ? '' : apply_filters('widget_layout', $instance['listing_width']);
		
		$list_sort = empty($instance['list_sort']) ? 'latest' : apply_filters('widget_list_sort', $instance['list_sort']);
		
		$character_count = empty($instance['character_count']) ? 20 : apply_filters('widget_list_sort', $instance['character_count']);
		
		
		$arr = array(
			'before_title'=>$before_title,
			'after_title'=>$after_title,
			'title'=>$title,
			'post_number'=>$post_number,
			'relate_to'=>$relate_to,
			'layout'=>$layout,
			'add_location_filter'=>$add_location_filter,
			'listing_width'=>$listing_width,
			'list_sort'=>$list_sort,
			'character_count'=>$character_count,
			'is_widget' => '1'
		);
		
		
		if($widget_display = geodir_related_posts_display($arr)){
				
			echo $before_widget;
			echo $widget_display;
			echo $after_widget;
		}
		
		
	}
	
	function update($new_instance, $old_instance) {
		//save the widget
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);	
		$instance['post_number'] = strip_tags($new_instance['post_number']);
		$instance['relate_to'] = strip_tags($new_instance['relate_to']);
		$instance['layout'] = strip_tags($new_instance['layout']);
		$instance['listing_width'] = strip_tags($new_instance['listing_width']);
		$instance['list_sort'] = strip_tags($new_instance['list_sort']);
		$instance['character_count'] = $new_instance['character_count'];
		if(isset($new_instance['add_location_filter']) && $new_instance['add_location_filter'] != '')
		$instance['add_location_filter']= strip_tags($new_instance['add_location_filter']);
		else
		$instance['add_location_filter'] = '0';
		
		
		return $instance;
	}
	
	function form($instance) 
	{
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, 
									array( 	'title' => '',
											'list_sort'=>'', 
											'list_order'=>'',
											'post_number' => '5',
											'relate_to' => '',
											'layout'=> 'gridview_onehalf',
											'listing_width' => '',
											'add_location_filter'=>'1',
											'character_count'=>'20') 
								 );
		
		$title = strip_tags($instance['title']);
		
		$list_sort = strip_tags($instance['list_sort']);
		
		$list_order = strip_tags($instance['list_order']);
		
		$post_number = strip_tags($instance['post_number']);
		
		$relate_to = strip_tags($instance['relate_to']);
		
		$layout = strip_tags($instance['layout']);
		
		$listing_width = strip_tags($instance['listing_width']);
		
		$add_location_filter = strip_tags($instance['add_location_filter']);
		
		$character_count = $instance['character_count'];
		
		?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',GEODIRECTORY_TEXTDOMAIN);?>
            
            	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
       
		<p>
        	<label for="<?php echo $this->get_field_id('list_sort'); ?>"><?php _e('Sort by:',GEODIRECTORY_TEXTDOMAIN);?>
            
           <select class="widefat" id="<?php echo $this->get_field_id('list_sort'); ?>" name="<?php echo $this->get_field_name('list_sort'); ?>">
            	
                <option <?php if($list_sort == 'latest'){ echo 'selected="selected"'; } ?> value="latest"><?php _e('Latest',GEODIRECTORY_TEXTDOMAIN); ?></option>
               
                 <option <?php if($list_sort == 'featured'){ echo 'selected="selected"'; } ?> value="featured"><?php _e('Featured',GEODIRECTORY_TEXTDOMAIN); ?></option>
                
                <option <?php if($list_sort == 'high_review'){ echo 'selected="selected"'; } ?> value="high_review"><?php _e('Review',GEODIRECTORY_TEXTDOMAIN); ?></option>
                
                <option <?php if($list_sort == 'high_rating'){ echo 'selected="selected"'; } ?> value="high_rating"><?php _e('Rating',GEODIRECTORY_TEXTDOMAIN); ?></option>
								
								<option <?php if($list_sort == 'random'){ echo 'selected="selected"'; } ?> value="random"><?php _e('Random',GEODIRECTORY_TEXTDOMAIN); ?></option>
                
            </select>
            </label>
        </p>
        
        <p>
        
            <label for="<?php echo $this->get_field_id('post_number'); ?>"><?php _e('Number of posts:',GEODIRECTORY_TEXTDOMAIN);?>
            
            <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo esc_attr($post_number); ?>" />
            </label>
        </p>
				
				<p>
        	<label for="<?php echo $this->get_field_id('relate_to'); ?>">
			<?php _e('Relate to:',GEODIRECTORY_TEXTDOMAIN);?>
            <select class="widefat" id="<?php echo $this->get_field_id('relate_to'); ?>" name="<?php echo $this->get_field_name('relate_to'); ?>">
            	<option <?php if($relate_to == 'category'){ echo 'selected="selected"'; } ?> value="category"><?php _e('Categories',GEODIRECTORY_TEXTDOMAIN); ?></option>
                <option <?php if($relate_to == 'tags'){ echo 'selected="selected"'; } ?> value="tags"><?php _e('Tags',GEODIRECTORY_TEXTDOMAIN); ?></option>
            </select>    
            </label>
        </p>
        
        <p>
       
        <p>
        	<label for="<?php echo $this->get_field_id('layout'); ?>">
			<?php _e('Layout:',GEODIRECTORY_TEXTDOMAIN);?>
            <select class="widefat" id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
            	<option <?php if($layout == 'gridview_onehalf'){ echo 'selected="selected"'; } ?> value="gridview_onehalf"><?php _e('Grid View (Two Columns)',GEODIRECTORY_TEXTDOMAIN); ?></option>
              <option <?php if($layout == 'gridview_onethird'){ echo 'selected="selected"'; } ?> value="gridview_onethird"><?php _e('Grid View (Three Columns)',GEODIRECTORY_TEXTDOMAIN); ?></option>
							<option <?php if($layout == 'gridview_onefourth'){ echo 'selected="selected"'; } ?> value="gridview_onefourth"><?php _e('Grid View (Four Columns)',GEODIRECTORY_TEXTDOMAIN); ?></option>
							<option <?php if($layout == 'gridview_onefifth'){ echo 'selected="selected"'; } ?> value="gridview_onefifth"><?php _e('Grid View (Five Columns)',GEODIRECTORY_TEXTDOMAIN); ?></option>
							<option <?php if($layout == 'list'){ echo 'selected="selected"'; } ?> value="list"><?php _e('List view',GEODIRECTORY_TEXTDOMAIN); ?></option>
								
            </select>    
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('listing_width'); ?>"><?php _e('Listing width:',GEODIRECTORY_TEXTDOMAIN);?>
            
            	<input class="widefat" id="<?php echo $this->get_field_id('listing_width'); ?>" name="<?php echo $this->get_field_name('listing_width'); ?>" type="text" value="<?php echo esc_attr($listing_width); ?>" />
            </label>
        </p>
				
				<p>
            <label for="<?php echo $this->get_field_id('character_count'); ?>"><?php _e('Post Content excerpt character count :',GEODIRECTORY_TEXTDOMAIN);?> 
            <input class="widefat" id="<?php echo $this->get_field_id('character_count'); ?>" name="<?php echo $this->get_field_name('character_count'); ?>" type="text" value="<?php echo esc_attr($character_count); ?>" />
            </label>
        </p>
        
         <p>
        	<label for="<?php echo $this->get_field_id('add_location_filter'); ?>">
			<?php _e('Enable Location Filter:',GEODIRECTORY_TEXTDOMAIN);?>
           	<input type="checkbox" id="<?php echo $this->get_field_id('add_location_filter'); ?>" name="<?php echo $this->get_field_name('add_location_filter'); ?>" <?php if($add_location_filter) echo 'checked="checked"';?>  value="1"  />
            </label>
        </p>
	    
	<?php  
	} 
}
register_widget('geodir_related_listing_postview');	

