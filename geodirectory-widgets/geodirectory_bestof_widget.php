<?php
/**
* Geodirectory bestof widget *
**/
class geodir_bestof_widget extends WP_Widget {
    function geodir_bestof_widget()
    {
        $widget_ops = array('classname' => 'geodir_bestof_widget', 'description' => __('GD > Displays the top rated posts category-wise',GEODIRECTORY_TEXTDOMAIN) );
        $this->WP_Widget('bestof_widget', __('GD > Best of widget',GEODIRECTORY_TEXTDOMAIN), $widget_ops);
    }

    function widget($args, $instance)
    {
        extract($args);

        $add_location_filter = ( $instance['add_location_filter'] == '') ? '1' : apply_filters( 'bestof_widget_location_filter', $instance['add_location_filter'] );
        $tab_layout = empty( $instance['tab_layout'] ) ? 'bestof-tabs-on-top' : apply_filters( 'bestof_widget_tab_layout', $instance['tab_layout'] );
        $post_type = empty( $instance['post_type'] ) ? 'gd_place' : apply_filters( 'bestof_widget_post_type', $instance['post_type'] );
        $post_limit = empty( $instance['post_limit'] ) ? '5' : apply_filters( 'bestof_widget_post_limit', $instance['post_limit'] );
        $categ_limit = empty( $instance['categ_limit'] ) ? '3' : apply_filters( 'bestof_widget_categ_limit', $instance['categ_limit'] );
        $use_viewing_post_type = !empty( $instance['use_viewing_post_type'] ) ? true : false;
        $loc_terms = geodir_get_current_location_terms();
        if ($add_location_filter && $loc_terms) {
            $cur_location = ' : '. ucwords(str_replace('-',' ',end($loc_terms)));
        } else {
            $cur_location = '';
        }
        $title = empty( $instance['title'] ) ? __( 'Best of '.get_bloginfo( 'name' ). $cur_location, GEODIRECTORY_TEXTDOMAIN ) : apply_filters( 'bestof_widget_title', __( $instance['title'],GEODIRECTORY_TEXTDOMAIN ) );

        // set post type to current viewing post type
        if ( $use_viewing_post_type ) {
            $current_post_type = geodir_get_current_posttype();
            if ( $current_post_type != '' && $current_post_type != $post_type ) {
                $post_type = $current_post_type;
            }
        }

        if ( isset( $instance['character_count'] ) ) {
            $character_count = apply_filters( 'bestof_widget_list_character_count', $instance['character_count'] );
        } else {
            $character_count = '';
        }

        $category_taxonomy = geodir_get_taxonomies( $post_type );

        $query_args = array(
            'posts_per_page' => $post_limit,
            'is_geodir_loop' => true,
            'post_type' => $post_type,
            'gd_location' => $add_location_filter ? true : false,
            'order_by' => 'high_rating'
        );
        if ( $character_count ) {
            $query_args['excerpt_length'] = $character_count;
        }

        $terms = get_terms( $category_taxonomy[0] );

        echo '<div class="'.$tab_layout.'">';
        echo $before_widget;
        echo $before_title . __( $title ) . $after_title;
        if ($tab_layout == 'bestof-tabs-as-dropdown') {
            $is_dropdown = true;
        } else {
            $is_dropdown = false;
        }
        echo '<div class="geodir-tabs gd-bestof-tabs" id="gd-bestof-tabs" style="position:relative;">';
        if ($is_dropdown) { ?>
            <select id="geodir_bestof_tab_dd" class="chosen_select" name="geodir_bestof_tab_dd" data-placeholder="<?php echo esc_attr( __( 'Select Category', GEODIRECTORY_TEXTDOMAIN ) );?>">
            <option value=""></option>
        <?php } else {
            echo '<dl class="geodir-tab-head geodir-bestof-cat-list">';
        }

        $cat_count = 0;

        foreach( $terms as $cat ) {
            $cat_count++;
            if ($cat_count > $categ_limit) {
                break;
            }
            if ($is_dropdown) { ?>
                <option id="<?php echo $cat->name; ?>" <?php if ($cat_count == 1) { echo 'selected="selected"'; } ?> value="<?php echo $cat->name; ?>"><?php echo ucwords( $cat->name ); ?></option>
            <?php
            } else {
                if ($cat_count == 1) {
                    echo '<dd class="geodir-tab-active">';
                } else {
                    echo '<dd class="">';
                }
                $term_icon_url = get_tax_meta($cat->term_id, 'ct_cat_icon', false, $post_type);
                echo '<a id="'.$cat->name.'" href="' . get_term_link( $cat, $cat->taxonomy ) . '">';
                echo '<img class="bestof-cat-icon" src="'.$term_icon_url["src"].'"/>';
                echo '<span>';
                echo ucwords( $cat->name );
                ?>
                <small>
                <?php
                $tax_query = array(
                                    'taxonomy' => $category_taxonomy[0],
                                    'field' => 'name',
                                    'terms' => $cat->name
                                );
                $query_args['tax_query'] = array( $tax_query );
                $num_reviews = geodir_bestof_term_reviews_count($query_args);
                if ( $num_reviews == 0 ) {
                    $reviews = __('No Reviews', GEODIRECTORY_TEXTDOMAIN);
                } elseif ( $num_reviews > 1 ) {
                    $reviews = $num_reviews . __(' Reviews', GEODIRECTORY_TEXTDOMAIN);
                } else {
                    $reviews = __('1 Review', GEODIRECTORY_TEXTDOMAIN);
                }
                echo $reviews;
                ?>
                </small>
                <?php
                echo '</span>';
                echo '</a>';
                echo '</dd>';
            }
        }
        if ($is_dropdown) {
            echo '</select>';
        } else {
            echo '</dl>';
        }
        $term = '';
        if ($terms) {
            $term = $terms[0]->name;
        }

        $tax_query = array(
            'taxonomy' => $category_taxonomy[0],
            'field' => 'name',
            'terms' => $term
        );
        $query_args['tax_query'] = array( $tax_query );
        ?>
        <input type="hidden" id="bestof_widget_post_type" name="bestof_widget_post_type" value="<?php echo $post_type; ?>">
        <input type="hidden" id="bestof_widget_post_limit" name="bestof_widget_post_limit" value="<?php echo $post_limit; ?>">
        <input type="hidden" id="bestof_widget_taxonomy" name="bestof_widget_taxonomy" value="<?php echo $category_taxonomy[0]; ?>">
        <input type="hidden" id="bestof_widget_location_filter" name="bestof_widget_location_filter" value="<?php if($add_location_filter) { echo 1; } else { echo 0; }  ?>">
        <input type="hidden" id="bestof_widget_char_count" name="bestof_widget_char_count" value="<?php echo $character_count;  ?>">
        <div class="geo-bestof-contentwrap geodir-tabs-content" style="position: relative; z-index: 0;">
        <p id="geodir-bestof-loading"><img src="<?php echo geodir_plugin_url().'/geodirectory-assets/images/ajax-loader.gif'; ?>" /></p>
        <?php
        echo '<div id="geodir-bestof-places">';
        if ($terms) {
            echo '<h3 class="bestof-cat-title">Best of '.$term.'<a href="' . get_term_link( $terms[0], $terms[0]->taxonomy ) . '">'.__( "View all", GEODIRECTORY_TEXTDOMAIN ).'</a></h3>';
        }
        geodir_bestof_places_by_term($query_args);
        echo "</div>";
        ?>
        </div>
        <?php echo $after_widget;
        echo "</div>";
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_type'] = strip_tags($new_instance['post_type']);
        $instance['post_limit'] = strip_tags($new_instance['post_limit']);
        $instance['categ_limit'] = strip_tags($new_instance['categ_limit']);
        $instance['character_count'] = $new_instance['character_count'];
        $instance['tab_layout'] = $new_instance['tab_layout'];
        if(isset($new_instance['add_location_filter']) && $new_instance['add_location_filter'] != '')
        $instance['add_location_filter']= strip_tags($new_instance['add_location_filter']);
        else
        $instance['add_location_filter'] = '0';
        $instance['use_viewing_post_type'] = isset($new_instance['use_viewing_post_type']) && $new_instance['use_viewing_post_type'] ? 1 : 0;
        return $instance;
    }

    function form($instance)
    {
        $instance = wp_parse_args( (array)$instance,
                             array(
                                'title' => '',
                                'post_type' => '',
                                'post_limit' => '5',
                                'categ_limit' => '3',
                                'character_count'=>'20',
                                'add_location_filter'=>'1',
                                'tab_layout' => 'bestof-tabs-on-top',
                                'use_viewing_post_type' => ''
                                )
                            );
        $title = strip_tags($instance['title']);
        $post_type = strip_tags($instance['post_type']);
        $post_limit = strip_tags($instance['post_limit']);
        $categ_limit = strip_tags($instance['categ_limit']);
        $character_count = strip_tags($instance['character_count']);
        $tab_layout = strip_tags($instance['tab_layout']);
        $add_location_filter = strip_tags($instance['add_location_filter']);
        $use_viewing_post_type = isset($instance['use_viewing_post_type']) && $instance['use_viewing_post_type'] ? true : false;

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',GEODIRECTORY_TEXTDOMAIN);?>

                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:',GEODIRECTORY_TEXTDOMAIN);?>

            <?php $postypes = geodir_get_posttypes();
            $postypes = apply_filters('geodir_post_type_list_in_p_widget' ,$postypes ); ?>

            <select class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" onchange="geodir_change_category_list(this)">

                <?php foreach($postypes as $postypes_obj){ ?>

                    <option <?php if($post_type == $postypes_obj){ echo 'selected="selected"'; } ?> value="<?php echo $postypes_obj; ?>"><?php $extvalue = explode('_',$postypes_obj); echo ucfirst($extvalue[1]); ?></option>

                <?php } ?>

            </select>
            </label>
        </p>

        <p>

            <label for="<?php echo $this->get_field_id('post_limit'); ?>"><?php _e('Number of posts:',GEODIRECTORY_TEXTDOMAIN);?>

            <input class="widefat" id="<?php echo $this->get_field_id('post_limit'); ?>" name="<?php echo $this->get_field_name('post_limit'); ?>" type="text" value="<?php echo esc_attr($post_limit); ?>" />
            </label>
        </p>

        <p>

            <label for="<?php echo $this->get_field_id('categ_limit'); ?>"><?php _e('Number of categories:',GEODIRECTORY_TEXTDOMAIN);?>

            <input class="widefat" id="<?php echo $this->get_field_id('categ_limit'); ?>" name="<?php echo $this->get_field_name('categ_limit'); ?>" type="text" value="<?php echo esc_attr($categ_limit); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('character_count'); ?>"><?php _e('Post Content excerpt character count :',GEODIRECTORY_TEXTDOMAIN);?>
            <input class="widefat" id="<?php echo $this->get_field_id('character_count'); ?>" name="<?php echo $this->get_field_name('character_count'); ?>" type="text" value="<?php echo esc_attr($character_count); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tab_layout'); ?>"><?php _e('Sort by:',GEODIRECTORY_TEXTDOMAIN);?>

           <select class="widefat" id="<?php echo $this->get_field_id('tab_layout'); ?>" name="<?php echo $this->get_field_name('tab_layout'); ?>">

                <option <?php if($tab_layout == 'bestof-tabs-on-top'){ echo 'selected="selected"'; } ?> value="bestof-tabs-on-top"><?php _e('Tabs on Top',GEODIRECTORY_TEXTDOMAIN); ?></option>
                <option <?php if($tab_layout == 'bestof-tabs-on-left'){ echo 'selected="selected"'; } ?> value="bestof-tabs-on-left"><?php _e('Tabs on Left',GEODIRECTORY_TEXTDOMAIN); ?></option>
                <option <?php if($tab_layout == 'bestof-tabs-as-dropdown'){ echo 'selected="selected"'; } ?> value="bestof-tabs-as-dropdown"><?php _e('Tabs as Dropdown',GEODIRECTORY_TEXTDOMAIN); ?></option>
            </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('add_location_filter'); ?>">
            <?php _e('Enable Location Filter:',GEODIRECTORY_TEXTDOMAIN);?>
            <input type="checkbox" id="<?php echo $this->get_field_id('add_location_filter'); ?>" name="<?php echo $this->get_field_name('add_location_filter'); ?>" <?php if($add_location_filter) echo 'checked="checked"';?>  value="1"  />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'use_viewing_post_type' ); ?>"><?php _e('Use current viewing post type:', GEODIRECTORY_TEXTDOMAIN ); ?> <input type="checkbox" id="<?php echo $this->get_field_id( 'use_viewing_post_type' ); ?>" name="<?php echo $this->get_field_name( 'use_viewing_post_type' ); ?>" <?php if( $use_viewing_post_type ) { echo 'checked="checked"'; } ?>  value="1" />
            </label>
        </p>
        <?php
    }
}
register_widget('geodir_bestof_widget');


function geodir_bestof_places_by_term($query_args) {
    $widget_listings = geodir_get_widget_listings( $query_args );

    $character_count = $query_args['excerpt_length'];
    if ( !isset( $character_count ) ) {
        $character_count = $character_count == '' ? 50 : apply_filters( 'bestof_widget_character_count', $character_count );
    }
    $template = apply_filters( "geodir_template_part-widget-listing-listview", geodir_plugin_path() . '/geodirectory-templates/widget-listing-listview.php' );


    global $post, $map_jason, $map_canvas_arr;
    $current_post = $post;
    $current_map_jason = $map_jason;
    $current_map_canvas_arr = $map_canvas_arr;
    $geodir_is_widget_listing = true;

    include( $template );

    $geodir_is_widget_listing = false;

    $GLOBALS['post'] = $current_post;
    setup_postdata( $current_post );
    $map_jason = $current_map_jason;
    $map_canvas_arr = $current_map_canvas_arr;

}

//Ajax functions
add_action( 'wp_ajax_geodir_bestof', 'geodir_bestof_callback' );
add_action( 'wp_ajax_nopriv_geodir_bestof', 'geodir_bestof_callback' );
function geodir_bestof_callback() {
    $post_type = strip_tags($_POST['post_type']);
    $post_limit = strip_tags($_POST['post_limit']);
    $character_count = strip_tags($_POST['char_count']);
    $taxonomy = strip_tags($_POST['taxonomy']);
    $add_location_filter = strip_tags($_POST['add_location_filter']);
    $term = strip_tags($_POST['term']);

    $query_args = array(
        'posts_per_page' => $post_limit,
        'is_geodir_loop' => true,
        'post_type' => $post_type,
        'gd_location' => $add_location_filter ? true : false,
        'order_by' => 'high_rating'
    );

    if ( $character_count ) {
        $query_args['excerpt_length'] = $character_count;
    }

    $tax_query = array(
        'taxonomy' => $taxonomy,
        'field' => 'name',
        'terms' => $term
    );

    $query_args['tax_query'] = array( $tax_query );
    if ($term && $taxonomy) {
        echo '<h3 class="bestof-cat-title">Best of '.$term.'<a href="' . get_term_link( $term, $taxonomy ) . '">'.__( "View all", GEODIRECTORY_TEXTDOMAIN ).'</a></h3>';
    }
    geodir_bestof_places_by_term($query_args);
    wp_die();
}

//Javascript
add_action( 'wp_footer', 'geodir_bestof_js' );
function geodir_bestof_js() { ?>
    <script type="text/javascript" >
    jQuery(document).ready(function($) {
        var loading = $("#geodir-bestof-loading");
        var container = $('#geodir-bestof-places');
        $('.geodir-bestof-cat-list a, #geodir_bestof_tab_dd').on("click change", function(e){
            $(document).ajaxStart(function() {
                container.hide();
                loading.show();
            }).ajaxStop(function() {
                loading.hide();
                container.show();
            });
            e.preventDefault();
            var activeTab = $(this).closest('dl').find('dd.geodir-tab-active');
            activeTab.removeClass('geodir-tab-active');
            $(this).parent().addClass('geodir-tab-active');
            if(e.type === "change"){
               var term = $(this).val();
            }
            else if(e.type === "click") {
               var term = $(this).attr('id');
            }
            var post_type = $('#bestof_widget_post_type').val();
            var post_limit = $('#bestof_widget_post_limit').val();
            var taxonomy = $('#bestof_widget_taxonomy').val();
            var char_count = $('#bestof_widget_char_count').val();
            var add_location_filter = $('#bestof_widget_location_filter').val();
            var ajax_url = '<?php echo geodir_get_ajax_url(); ?>'
            var data = {
                'action': 'geodir_bestof',
                'post_type': post_type,
                'post_limit': post_limit,
                'taxonomy': taxonomy,
                'geodir_ajax': true,
                'term': term,
                'char_count': char_count,
                'add_location_filter': add_location_filter
            };

            $.post(ajax_url, data, function(response) {
                container.html(response);
                $('.geodir_category_list_view li .geodir-post-img .geodir_thumbnail img').css('display','block');
            });
        })
    });
    </script>
    <style type="text/css">
    #geodir-bestof-places {
        padding:10px;
        clear: both;
    }
    #geodir-bestof-loading {
        text-align: center;
        padding: 50px 0;
        display: none;
    }
    .geodir-bestof-cat-list a {
        text-decoration: none;
    }
    .geodir-bestof-cat-list a:active, .geodir-bestof-cat-list a:focus {
        outline: 0;
        outline-style:none;
        outline-width:0;
    }
    .geodir-bestof-cat-list a span{
        display: block;
        overflow: hidden;
        line-height: 33px;
        padding-bottom: 5px;
    }
    .geodir-bestof-cat-list a small{
        color: #757575;
        line-height: 1px;
        display: block;
    }
    #geodir-bestof-places h3.bestof-cat-title a {
        float: right;
        font-size: 13px;
    }
    .geo-bestof-contentwrap {
        border: 1px #e1e1e1 solid;
        border-top: none;
    }
    .bestof-tabs-on-top section.widget.geodir_bestof_widget,
    .bestof-tabs-on-left section.widget.geodir_bestof_widget,
    .bestof-tabs-as-dropdown section.widget.geodir_bestof_widget {
        clear: both;
        background-color: #fff;
        padding:10px;
        margin-bottom: 10px;
    }
    .bestof-tabs-on-left .gd-bestof-tabs {
        width: 100%;
        overflow: hidden;
    }
    .bestof-tabs-on-left .geodir-bestof-cat-list {
        width: 20%;
        float: left;
    }
    .bestof-tabs-on-left .geo-bestof-contentwrap {
        width: 80%;
        float: right;
        border-top: 1px #e1e1e1 solid;
        border-left: none;
    }
    .bestof-tabs-on-left dl.geodir-tab-head dd {
        float: none;
    }
    .bestof-tabs-on-left dl.geodir-tab-head dd:last-child {
        border-right: none;
    }
    .bestof-tabs-on-left dl.geodir-tab-head dd a {
        border-bottom: none;
    }
    .bestof-tabs-on-left dl.geodir-tab-head dd a {
        border-right: 1px #e1e1e1 solid;
    }
    .bestof-tabs-on-left dl.geodir-tab-head dd.geodir-tab-active a {
        border-top: 1px #e1e1e1 solid !important;
        border-left:1px #45B8F2 solid !important;
        border-right: none !important;
    }
    .bestof-tabs-on-left #geodir-bestof-places {
        padding: 15px;
    }
    .bestof-tabs-on-left #geodir-bestof-places h3 {
        margin: 0;
    }
    #geodir_bestof_tab_dd {
        margin-bottom: 10px;
    }
    .bestof-cat-icon {
        float: left;
        position: relative;
        margin: 8px;
        height: 30px;
        margin-left: 0;
    }
    </style>

    <?php
}

function geodir_bestof_term_reviews_count($query_args) {

    $widget_listings = geodir_get_widget_listings( $query_args );
    $comments_count = 0;
    foreach ( $widget_listings as $widget_listing ) {
                $post = $widget_listing;
                $GLOBALS['post'] = $post;
                setup_postdata( $post );
                $comments_count = $comments_count + geodir_get_review_count_total(get_the_ID());
    }
    return $comments_count;
}