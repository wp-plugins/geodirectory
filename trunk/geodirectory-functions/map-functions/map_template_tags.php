<?php
require_once('map_functions.php') ;
/*-------------------------------------------------*/
/* All map related templates
/*-------------------------------------------------*/


function geodir_draw_map($map_args = array())
{
	global $map_canvas_arr ;
	
	$map_canvas_name =  (!empty($map_args) && $map_args['map_canvas_name'] !='') ? $map_args['map_canvas_name'] : 'home_map_canvas' ;
	
	$default_location  = geodir_get_default_location();

	$map_default_lat 	=  	isset($default_location->city_latitude) ? $default_location->city_latitude : '';
	$map_default_lng 	=  	isset($default_location->city_longitude) ? $default_location->city_longitude : '';
	$map_default_zoom 	= 	12;//$default_location->city_zoom;
	// map options default values
	$width = 950;
	$height = 450;
	$child_collapse = '0' ;
	$sticky = '' ;
	$enable_cat_filters = false ;
	$enable_text_search = false ;
	$enable_post_type_filters = false;
	$enable_location_filters =  false;
	$enable_jason_on_load = false;
	$enable_map_direction = false;
	$enable_marker_cluster = false;
	$enable_map_resize_button = false;
	$maptype = 'ROADMAP';
	
	$geodir_map_options = array(
		'width' => $width,
		'height' => $height,
		'child_collapse' => $child_collapse,
		'sticky' => $sticky,
		'enable_map_resize_button' => $enable_map_resize_button,
		'enable_cat_filters' => $enable_cat_filters,
		'enable_text_search' => $enable_text_search,
		'enable_post_type_filters' => $enable_post_type_filters,
		'enable_location_filters' => $enable_location_filters,
		'enable_jason_on_load' => $enable_jason_on_load,
		'enable_map_direction' => $enable_map_direction,
		'enable_marker_cluster' =>$enable_marker_cluster,
		'ajax_url'=> geodir_get_ajax_url(),
		'map_canvas_name' => $map_canvas_name,
		'inputText'=> __('Title or Keyword',GEODIRECTORY_TEXTDOMAIN), 						
		'latitude'=> $map_default_lat, 
		'longitude'=> $map_default_lng, 
		'zoom'=> $map_default_zoom,
		'scrollwheel'=> true, 
		'streetViewControl'=> true, 
		'maptype'=> $maptype,  
		'showPreview'=> '0', 
		'maxZoom'=> 21, 
		'autozoom'=> true,
		'bubble_size'=> 'small',
		'token'=> '68f48005e256696074e1da9bf9f67f06' ,
		'navigationControlOptions'=> array( 'position'=> 'TOP_LEFT', 'style'=>'ZOOM_PAN')
	);
	
	if(!empty( $map_args))
	{
		foreach($map_args as $map_option_key=> $map_option_value)
		{
			$geodir_map_options[$map_option_key] = $map_option_value;
		}
	}	
	
	if (strpos($geodir_map_options['height'],'%') !== false || strpos($geodir_map_options['height'],'px') !== false) {
	}else{$geodir_map_options['height']= $geodir_map_options['height'].'px';}
	
	if (strpos($geodir_map_options['width'],'%') !== false || strpos($geodir_map_options['width'],'px') !== false) {
	}else{$geodir_map_options['width']= $geodir_map_options['width'].'px';}
	
	$geodir_map_options  = apply_filters('geodir_map_options_' . $map_canvas_name  , $geodir_map_options) ;
	
	
	$map_canvas_arr[$map_canvas_name] = array();
	
	
	$post_types = apply_filters('geodir_map_post_type_list_' .$map_canvas_name,  geodir_get_posttypes('object')); 
	$exclude_post_types = apply_filters('geodir_exclude_post_type_on_map_' .$map_canvas_name, get_option('geodir_exclude_post_type_on_map'));
	
	if( count((array)$post_types) != count($exclude_post_types)  || ($enable_jason_on_load)):
		// Set default map options
		
		wp_enqueue_script( 'geodir-map-widget', geodir_plugin_url().'/geodirectory-functions/map-functions/js/map.js');
		
		wp_localize_script( 'geodir-map-widget',  $map_canvas_name, $geodir_map_options );
		
		if($map_canvas_name=='detail_page_map_canvas' || $map_canvas_name=='preview_map_canvas'){$map_width = '100%';}
		else{$map_width = $geodir_map_options['width'];}
		
		$map_width = apply_filters('geodir_change_map_width', $map_width);
	?>
    <div id="catcher_<?php echo $map_canvas_name;?>"></div>
    <div class="stick_trigger_container" >
    <div class="trigger_sticky triggeroff_sticky" ></div>
     <div class="top_banner_section geodir_map_container"  id="sticky_map_<?php echo $map_canvas_name;?>"  style="height:<?php echo $geodir_map_options['height'];?>;width:<?php echo $map_width;?>;">
     
     	<div class="map_background">
            <div class="top_banner_section_in clearfix" >
                <div class="<?php echo $map_canvas_name;?>_TopLeft TopLeft"><span class="triggermap" id="<?php echo $map_canvas_name;?>_triggermap" <?php if(!$geodir_map_options['enable_map_resize_button']){ ?> <?php }?>><i class="fa fa-arrows-alt"></i></span></div>
                <div class="<?php echo $map_canvas_name;?>_TopRight TopRight"></div>
                <div id="<?php echo $map_canvas_name;?>_wrapper" class="main_map_wrapper" style="height:<?php echo $geodir_map_options['height'];?>;width:<?php echo $map_width;?>;">
                    <!-- new map start -->
                    <div class="iprelative">     
                        <div class="geodir_marker_cluster" id="<?php echo $map_canvas_name;?>" style="height:<?php echo $geodir_map_options['height'];?>;width:<?php echo $map_width;?>;"></div>  
                        <div id="<?php echo $map_canvas_name;?>_loading_div" class="loading_div" style=" height:<?php echo $geodir_map_options['height'];?>;width:<?php echo $map_width;?>;"></div> 
                        <!--<div id="home_map_counter"></div>        -->
                        <div id="<?php echo $map_canvas_name;?>_map_nofound" class="advmap_nofound"><?php echo MAP_NO_RESULTS; ?></div>     
                    </div>   
                    <!-- new map end -->
                </div>
                <div class="<?php echo $map_canvas_name;?>_BottomLeft BottomLeft"></div>
            </div>
        </div>
       <?php 
	   if($geodir_map_options['enable_jason_on_load']){ ?>
       	<input type="hidden" id="<?php echo $map_canvas_name;?>_jason_enabled" value="1" />
       <?php }else{?>
        <input type="hidden" id="<?php echo $map_canvas_name;?>_jason_enabled" value="0" />
       <?php }
	   
	   if(!$geodir_map_options['enable_text_search'] && !$geodir_map_options['enable_cat_filters'])
	   		$show_entire_cat_panel = "none" ;
		else
			$show_entire_cat_panel = "''" ;
	   ?>
		 
		<?php if($geodir_map_options['enable_map_direction']){?>
			
			<input type="text"  id="<?php echo $map_canvas_name;?>_fromAddress" name="from" class="textfield"  value="Enter Your Location"  onblur="if (this.value == '') {this.value = 'Enter Your Location';}" onfocus="if (this.value == 'Enter Your Location') {this.value = '';}" />
			<input type="button" value="<?php _e('Get Directions',GEODIRECTORY_TEXTDOMAIN);?>" class="<?php echo $map_canvas_name;?>_getdirection" id="directions" onclick="calcRoute('<?php echo $map_canvas_name;?>')" />
            
            <div id='directions-options' class="hidden">
                <select id="travel-mode" onchange="calcRoute('<?php echo $map_canvas_name;?>')">
                    <option value="driving" ><?php _e('Driving',GEODIRECTORY_TEXTDOMAIN); ?></option>
                    <option value="walking"><?php _e('Walking',GEODIRECTORY_TEXTDOMAIN); ?></option>
                    <option value="bicycling"><?php _e('Bicycling',GEODIRECTORY_TEXTDOMAIN); ?></option>
                    <option value="transit"><?php _e('Public Transport',GEODIRECTORY_TEXTDOMAIN); ?></option>
                </select>
                
                <select id="travel-units" onchange="calcRoute('<?php echo $map_canvas_name;?>')">
                    <option value="miles"><?php _e('Miles',GEODIRECTORY_TEXTDOMAIN); ?></option>
                    <option value="kilometers" ><?php _e('Kilometers',GEODIRECTORY_TEXTDOMAIN); ?></option>
                </select>
            </div>

			<div id="<?php echo $map_canvas_name;?>_directionsPanel" style="width:auto;"></div>
			
		<?php } ?>
      
        <div class="map-category-listing-main" style="display:<?php echo $show_entire_cat_panel;?>">
        <?php 
		$exclude_post_types = get_option('geodir_exclude_post_type_on_map');
		$geodir_available_pt_on_map =  count(geodir_get_posttypes('array')) - count($exclude_post_types ) ;
		?>
            <div class="map-category-listing <?php if($geodir_map_options['enable_post_type_filters'] && $geodir_available_pt_on_map <2){echo "map-cat-floor";}?>">                 
                  <div class="trigger triggeroff" ><i class="fa fa-compress"></i><i class="fa fa-expand"></i></div>
               		<div id="<?php echo $map_canvas_name;?>_cat" class="<?php echo $map_canvas_name;?>_map_category  map_category" <?php if($child_collapse){ ?>checked="checked" <?php }?>>
                        <input  onkeydown="if(event.keyCode == 13){build_map_ajax_search_param('<?php echo $map_canvas_name;?>' , false)}" type="<?php if($geodir_map_options['enable_text_search']) echo "text" ; else echo 'hidden' ;?>" class="inputbox" id="<?php echo $map_canvas_name;?>_search_string" name="search" value="<?php _e('Title or Keyword',GEODIRECTORY_TEXTDOMAIN);?>" onclick="this.value=''" />
                     <?php if($geodir_map_options['enable_cat_filters']){?>
                     			<?php if($geodir_map_options['child_collapse']){ ?>
                                	<input type="hidden" id="<?php echo $map_canvas_name;?>_child_collapse" value="1" />
                                <?php }else
									{
								 ?>
                                 	<input type="hidden" id="<?php echo $map_canvas_name;?>_child_collapse" value="0" />
                                 <?php }?>
                     <input type="hidden" id="<?php echo $map_canvas_name;?>_cat_enabled" value="1" />
                        <div class="toggle" >
                            <?php  //echo home_map_taxonomy_walker('gd_placecategory', $search_parent, true); ?>
                        </div>
                       <?php }else{ // end of cat filter ?>  
                          <input type="hidden" id="<?php echo $map_canvas_name;?>_cat_enabled" value="0" />
                          <input type="hidden" id="<?php echo $map_canvas_name;?>_child_collapse" value="0" />
                        <?php }?>  
                        <div class="BottomRight"></div><br />
                        
            	</div>
            </div>
        </div> <!-- map-category-listings-->
     
      <?php 
	  	if($geodir_map_options['enable_location_filters']){
			
			if( get_query_var('gd_city') ){
				if($city = get_query_var('gd_city')){}
			}
			
			if( get_query_var('gd_country') )
			{
			
				if($country = get_query_var('gd_country')){}
				if($region = get_query_var('gd_region')){}
				if($city = get_query_var('gd_city')){}
			
			}	
			
		//$gd_posttype = 'gd_place';
		
		?>
		<input type="hidden" id="<?php echo $map_canvas_name;?>_location_enabled" value="1" />
		<input type="hidden" id="<?php echo $map_canvas_name;?>_country" name="gd_country" value="<?php if(isset($country)){ echo $country;}?>" /> 
		<input type="hidden" id="<?php echo $map_canvas_name;?>_region" name="gd_region" value="<?php if(isset($region)){ echo $region;}?>" /> 
		<input type="hidden" id="<?php echo $map_canvas_name;?>_city" name="gd_city" value="<?php if(isset($city)){ echo $city;}?>" /> 
        <?php }else{ //end of location filter		?>
        	<input type="hidden" id="<?php echo $map_canvas_name;?>_location_enabled" value="0" />
        <?php }?>
        <?php 
			$geodir_default_map_search_pt = get_option('geodir_default_map_search_pt');
			if(empty($geodir_default_map_search_pt))
				$geodir_default_map_search_pt='gd_place' ;
			
		?>
		<input type="hidden" id="<?php echo $map_canvas_name;?>_posttype" name="gd_posttype" value="<?php echo apply_filters('geodir_default_map_search_pt', $geodir_default_map_search_pt);?>" /> 
		
		<input type="hidden" name="limitstart" value="" /> 
        
         <?php if($geodir_map_options['enable_post_type_filters']){
			 $post_types = geodir_get_posttypes('object'); 
			 if(count((array)($post_types))>1){?>
             <style>.map_category, .trigger {margin-bottom:30px;}</style>
        <div class="map-places-listing" id="<?php echo $map_canvas_name;?>_posttype_menu" style="max-width:<?php echo $map_width;?>!important;">        
          
            <ul class="clearfix place-list">
            	<?php 
				
				$exclude_post_types = get_option('geodir_exclude_post_type_on_map');
				
				foreach($post_types as $post_type => $args){
					if(!in_array($post_type,$exclude_post_types)){
						echo '<li id="'.$post_type.'"><a href="javascript:void(0);" onclick="jQuery(\'#'.  $map_canvas_name .'_posttype\').val(\''.$post_type.'\');build_map_ajax_search_param(\''.$map_canvas_name .'\', true)">'.__(ucfirst($args->labels->name)).'</a></li>';
					 }
				}?>
               
              
            </ul>
            <div class="geodir-map-navigation">
                <ul>
                   <li class="geodir-leftarrow"><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                   <li class="geodir-rightarrow"><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                </ul>
            </div>
          
        </div> <!-- map-places-listings-->
          <?php }} // end of post type filter if?>
          
    </div>
    </div> <!--end of stick trigger container-->
	<script type="text/javascript">
			
			jQuery(document).ready(function(){
				//initMap('<?php echo $map_canvas_name;?>'); // depreciated, no need to load this twice
				build_map_ajax_search_param('<?php echo $map_canvas_name;?>' , true);
				map_sticky('<?php echo $map_canvas_name;?>');
			});
			
    </script>
	<?php
	endif; // Exclude posttypes if end
}

?>