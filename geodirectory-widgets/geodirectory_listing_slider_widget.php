<?php

/* ------------ Geodirectory listing slider widget */

class geodir_listing_slider_widget extends WP_Widget
{

    function geodir_listing_slider_widget()
    {
        //Constructor
        $widget_ops = array('classname' => 'geodir_listing_slider_view', 'description' => __('GD > Listing Slider', GEODIRECTORY_TEXTDOMAIN));
        $this->WP_Widget('listing_slider_view', __('GD > Listing Slider', GEODIRECTORY_TEXTDOMAIN), $widget_ops);
    }


    function widget($args, $instance)
    {
        geodir_listing_slider_widget_output($args, $instance);
    }

    function update($new_instance, $old_instance)
    {
        //save the widget
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_type'] = strip_tags($new_instance['post_type']);
        $instance['category'] = strip_tags($new_instance['category']);
        $instance['post_number'] = strip_tags($new_instance['post_number']);
        $instance['show_title'] = isset($new_instance['show_title']) ? $new_instance['show_title'] : '';
        $instance['slideshow'] = isset($new_instance['slideshow']) ? $new_instance['slideshow'] : '';
        $instance['animationLoop'] = isset($new_instance['animationLoop']) ? $new_instance['animationLoop'] : '';
        $instance['directionNav'] = isset($new_instance['directionNav']) ? $new_instance['directionNav'] : '';
        $instance['slideshowSpeed'] = $new_instance['slideshowSpeed'];
        $instance['animationSpeed'] = $new_instance['animationSpeed'];
        $instance['animation'] = $new_instance['animation'];
        $instance['list_sort'] = isset($new_instance['list_sort']) ? $new_instance['list_sort'] : '';
        $instance['show_featured_only'] = isset($new_instance['show_featured_only']) && $new_instance['show_featured_only'] ? 1 : 0;

        return $instance;
    }

    function form($instance)
    {

        //widgetform in backend
        $instance = wp_parse_args((array)$instance,
            array('title' => '',
                'post_type' => '',
                'category' => '',
                'post_number' => '5',
                'show_title' => '',
                'slideshow' => '',
                'animationLoop' => '',
                'directionNav' => '',
                'slideshowSpeed' => 5000,
                'animationSpeed' => 600,
                'animation' => '',
                'list_sort' => 'latest',
                'show_featured_only' => '',
            )
        );

        $title = strip_tags($instance['title']);

        $post_type = strip_tags($instance['post_type']);

        $category = strip_tags($instance['category']);

        $post_number = strip_tags($instance['post_number']);

        $show_title = $instance['show_title'];

        $slideshow = $instance['slideshow'];

        $animationLoop = $instance['animationLoop'];

        $directionNav = $instance['directionNav'];

        $slideshowSpeed = $instance['slideshowSpeed'];

        $animationSpeed = $instance['animationSpeed'];

        $animation = $instance['animation'];
        $list_sort = $instance['list_sort'];
        $show_featured_only = isset($instance['show_featured_only']) && $instance['show_featured_only'] ? true : false;

        $sort_fields = array();
        $sort_fields[] = array('field' => 'latest', 'label' => __('Latest', GEODIRECTORY_TEXTDOMAIN));
        $sort_fields[] = array('field' => 'featured', 'label' => __('Featured', GEODIRECTORY_TEXTDOMAIN));
        $sort_fields[] = array('field' => 'high_review', 'label' => __('Review', GEODIRECTORY_TEXTDOMAIN));
        $sort_fields[] = array('field' => 'high_rating', 'label' => __('Rating', GEODIRECTORY_TEXTDOMAIN));
        $sort_fields[] = array('field' => 'random', 'label' => __('Random', GEODIRECTORY_TEXTDOMAIN));
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', GEODIRECTORY_TEXTDOMAIN);?>

                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text"
                       value="<?php echo esc_attr($title); ?>"/>
            </label>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:', GEODIRECTORY_TEXTDOMAIN);?>

                <?php $postypes = geodir_get_posttypes(); ?>

                <select class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>"
                        name="<?php echo $this->get_field_name('post_type'); ?>"
                        onchange="geodir_change_category_list(this.value)">

                    <?php foreach ($postypes as $postypes_obj) { ?>

                        <option <?php if ($post_type == $postypes_obj) {
                            echo 'selected="selected"';
                        } ?> value="<?php echo $postypes_obj; ?>"><?php $extvalue = explode('_', $postypes_obj);
                            echo ucfirst($extvalue[1]); ?></option>

                    <?php } ?>

                </select>
            </label>
        </p>


        <p>
            <label
                for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Post Category:', GEODIRECTORY_TEXTDOMAIN);?>

                <?php
                $category_taxonomy = geodir_get_taxonomies('gd_place');
                $categories = get_terms($category_taxonomy, array('orderby' => 'count', 'order' => 'DESC'));
                ?>

                <select class="widefat" id="<?php echo $this->get_field_id('category'); ?>"
                        name="<?php echo $this->get_field_name('category'); ?>">
                    <option <?php if ($category == '0') {
                        echo 'selected="selected"';
                    } ?> value="0"><?php _e('All', GEODIRECTORY_TEXTDOMAIN); ?></option>
                    <?php foreach ($categories as $category_obj) { ?>

                        <option <?php if ($category == $category_obj->term_id) {
                            echo 'selected="selected"';
                        } ?>
                            value="<?php echo $category_obj->term_id; ?>"><?php echo ucfirst($category_obj->name); ?></option>

                    <?php } ?>

                </select>
            </label>
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('list_sort'); ?>"><?php _e('Sort by:', GEODIRECTORY_TEXTDOMAIN); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('list_sort'); ?>"
                    name="<?php echo $this->get_field_name('list_sort'); ?>">
                <?php foreach ($sort_fields as $sort_field) { ?>
                    <option
                        value="<?php echo $sort_field['field']; ?>" <?php echo($list_sort == $sort_field['field'] ? 'selected="selected"' : ''); ?>><?php echo $sort_field['label']; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('post_number'); ?>"><?php _e('Number of posts:', GEODIRECTORY_TEXTDOMAIN);?>
                <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>"
                       name="<?php echo $this->get_field_name('post_number'); ?>" type="text"
                       value="<?php echo esc_attr($post_number); ?>"/>
            </label>
        </p>


        <p>
            <label
                for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Animation:', GEODIRECTORY_TEXTDOMAIN);?>

                <select class="widefat" id="<?php echo $this->get_field_id('animation'); ?>"
                        name="<?php echo $this->get_field_name('animation'); ?>">
                    <option <?php if ($animation == 'slide') {
                        echo 'selected="selected"';
                    } ?> value="slide">Slide
                    </option>
                    <option <?php if ($animation == 'fade') {
                        echo 'selected="selected"';
                    } ?> value="fade">Fade
                    </option>
                </select>
            </label>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('slideshowSpeed'); ?>"><?php _e('Slide Show Speed: (milliseconds)', GEODIRECTORY_TEXTDOMAIN);?>

                <input class="widefat" id="<?php echo $this->get_field_id('slideshowSpeed'); ?>"
                       name="<?php echo $this->get_field_name('slideshowSpeed'); ?>" type="text"
                       value="<?php echo esc_attr($slideshowSpeed); ?>"/>
            </label>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('animationSpeed'); ?>"><?php _e('Animation Speed: (milliseconds)', GEODIRECTORY_TEXTDOMAIN);?>

                <input class="widefat" id="<?php echo $this->get_field_id('animationSpeed'); ?>"
                       name="<?php echo $this->get_field_name('animationSpeed'); ?>" type="text"
                       value="<?php echo esc_attr($animationSpeed); ?>"/>
            </label>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('slideshow'); ?>"><?php _e('SlideShow:', GEODIRECTORY_TEXTDOMAIN);?>

                <input type="checkbox" <?php if ($slideshow) {
                    echo 'checked="checked"';
                } ?> id="<?php echo $this->get_field_id('slideshow'); ?>" value="1"
                       name="<?php echo $this->get_field_name('slideshow'); ?>"/>

            </label>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('animationLoop'); ?>"><?php _e('AnimationLoop:', GEODIRECTORY_TEXTDOMAIN);?>

                <input type="checkbox" <?php if ($animationLoop) {
                    echo 'checked="checked"';
                } ?> id="<?php echo $this->get_field_id('animationLoop'); ?>" value="1"
                       name="<?php echo $this->get_field_name('animationLoop'); ?>"/>

            </label>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('directionNav'); ?>"><?php _e('DirectionNav:', GEODIRECTORY_TEXTDOMAIN);?>

                <input type="checkbox" <?php if ($directionNav) {
                    echo 'checked="checked"';
                } ?> id="<?php echo $this->get_field_id('directionNav'); ?>" value="1"
                       name="<?php echo $this->get_field_name('directionNav'); ?>"/>

            </label>
        </p>


        <p>
            <label
                for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show Title:', GEODIRECTORY_TEXTDOMAIN);?>

                <input type="checkbox" <?php if ($show_title) {
                    echo 'checked="checked"';
                } ?> id="<?php echo $this->get_field_id('show_title'); ?>" value="1"
                       name="<?php echo $this->get_field_name('show_title'); ?>"/>

            </label>
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('show_featured_only'); ?>"><?php _e('Show only featured listings:', GEODIRECTORY_TEXTDOMAIN); ?>
                <input type="checkbox" id="<?php echo $this->get_field_id('show_featured_only'); ?>"
                       name="<?php echo $this->get_field_name('show_featured_only'); ?>" <?php if ($show_featured_only) echo 'checked="checked"'; ?>
                       value="1"/>
            </label>
        </p>
        <script type="text/javascript">
            function geodir_change_category_list(post_type, selected) {

                var ajax_url = '<?php echo geodir_get_ajax_url(); ?>'

                var myurl = ajax_url + "&geodir_ajax=admin_ajax&ajax_action=get_cat_dl&post_type=" + post_type + "&selected=" + selected;

                jQuery.ajax({
                    type: "GET",
                    url: myurl,
                    success: function (data) {
                        jQuery('#<?php echo $this->get_field_id('category'); ?>').html(data);
                    }
                });

            }

            <?php if(is_active_widget( false, false, $this->id_base, true )){ ?>
            var post_type = jQuery('#<?php echo $this->get_field_id('post_type'); ?>').val();

            geodir_change_category_list(post_type, '<?php echo $category;?>');
            <?php } ?>

        </script>


    <?php
    }
}

register_widget('geodir_listing_slider_widget');
          
	