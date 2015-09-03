<?php
/**
 * Design tab settings.
 *
 * @since 1.0.0
 * @package GeoDirectory
 * @global array $geodir_settings Geodirectory settings array.
 */
global $geodir_settings;


/**
 * function for post type settings.
 *
 * @since 1.0.0
 * @package GeoDirectory
 */
function geodir_post_type_setting_fun()
{
    $post_type_arr = array();

    $post_types = geodir_get_posttypes('object');

    foreach ($post_types as $key => $post_types_obj) {
        $post_type_arr[$key] = $post_types_obj->labels->singular_name;
    }
    return $post_type_arr;
}

/**
 * function for theme location settings.
 *
 * @since 1.0.0
 * @package GeoDirectory
 */
function geodir_theme_location_setting_fun()
{
    $post_type_arr = array();
    $geodir_all_nav_locations = get_registered_nav_menus();
    $geodir_active_nav_locations = get_nav_menu_locations();
    if (!empty($geodir_active_nav_locations) && is_array($geodir_active_nav_locations)) {
        foreach ($geodir_active_nav_locations as $key => $theme_location) {
            if (!empty($geodir_all_nav_locations) && is_array($geodir_all_nav_locations) && array_key_exists($key, $geodir_all_nav_locations))
                $post_type_arr[$key] = $geodir_all_nav_locations[$key];
        }
    }

    return $post_type_arr;
}
/**
 * Filter GD design settings array.
 *
 * @since 1.0.0
 * @package GeoDirectory
 */
$geodir_settings['design_settings'] = apply_filters('geodir_design_settings', array(

    /* Home Layout Settings start */
    array('name' => __('Home', 'geodirectory'), 'type' => 'title', 'desc' => 'Setting to set home page layout', 'id' => 'home_page_settings '),


    array('name' => __('Home Top Section Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_home_top_section'),

    array(
        'name' => __('Geodirectory home page', 'geodirectory'),
        'desc' => __('Set geodirectory home page as your home', 'geodirectory'),
        'id' => 'geodir_set_as_home',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),

    array(
        'name' => __('Home top section', 'geodirectory'),
        'desc' => __('Show the top section of home page', 'geodirectory'),
        'id' => 'geodir_show_home_top_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),


    array('type' => 'sectionend', 'id' => 'geodir_home_top_section'),


    array('name' => __('Home Page Layout Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_home_layout'),

    array(
        'name' => __('Home right section', 'geodirectory'),
        'desc' => __('Show the right section of home page', 'geodirectory'),
        'id' => 'geodir_show_home_right_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Width of home right section', 'geodirectory'),
        'desc' => __('Enter the width of right section of home page in %', 'geodirectory'),
        'id' => 'geodir_width_home_right_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value to show home top section
    ),

    array(
        'name' => __('Home content section', 'geodirectory'),
        'desc' => __('Show the content section of home page', 'geodirectory'),
        'id' => 'geodir_show_home_contant_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Width of home content section', 'geodirectory'),
        'desc' => __('Enter the width of content section of home page in %', 'geodirectory'),
        'id' => 'geodir_width_home_contant_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '63' // Default value to show home top section
    ),

    array(
        'name' => __('Home left section', 'geodirectory'),
        'desc' => __('Show the left section of home page', 'geodirectory'),
        'id' => 'geodir_show_home_left_section',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),

    array(
        'name' => __('Width of home left section', 'geodirectory'),
        'desc' => __('Enter the width of left section of home page in %', 'geodirectory'),
        'id' => 'geodir_width_home_left_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value to show home top section
    ),

    array(
        'name' => __('Home bottom section', 'geodirectory'),
        'desc' => __('Show the bottom section of home page', 'geodirectory'),
        'id' => 'geodir_show_home_bottom_section',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),
    array(
        'name' => __('Resize image large size', 'geodirectory'),
        'desc' => sprintf(__('Use default wordpress media image large size ( %s ) for featured image upload. If unchecked then default geodirectory image large size ( 800x800 ) will be used.', 'geodirectory'), get_option('large_size_w') . 'x' . get_option('large_size_h')),
        'id' => 'geodir_use_wp_media_large_size',
        'type' => 'checkbox',
        'std' => '0'
    ),

    array('type' => 'sectionend', 'id' => 'geodir_home_layout'),


    /* Home Layout Settings end */


    /* Listing Layout Settings end */

    array('name' => __('Listings', 'geodirectory'), 'type' => 'title', 'desc' => '', 'id' => 'geodir_listing_settings '),


    array('name' => __('Listing Page Layout Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_listing_layout'),

    array(
        'name' => __('Listing top section', 'geodirectory'),
        'desc' => __('Show the top section of listing page', 'geodirectory'),
        'id' => 'geodir_show_listing_top_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Listing right section', 'geodirectory'),
        'desc' => __('Show the right section of listing page', 'geodirectory'),
        'id' => 'geodir_show_listing_right_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Width of listing right section', 'geodirectory'),
        'desc' => __('Enter the width of right section of listing page in %', 'geodirectory'),
        'id' => 'geodir_width_listing_right_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value to show home top section
    ),


    array(
        'name' => __('Listing content section view', 'geodirectory'),
        'desc' => __('Set the listing view of listing page', 'geodirectory'),
        'id' => 'geodir_listing_view',
        'css' => 'min-width:300px;',
        'std' => 'gridview_onehalf',
        'type' => 'select',
        'class' => 'chosen_select',
        'options' => array_unique(array(
            'gridview_onehalf' => __('Grid View (Two Columns)', 'geodirectory'),
            'gridview_onethird' => __('Grid View (Three Columns)', 'geodirectory'),
            'gridview_onefourth' => __('Grid View (Four Columns)', 'geodirectory'),
            'gridview_onefifth' => __('Grid View (Five Columns)', 'geodirectory'),
            'listview' => __('List view', 'geodirectory'),
        ))
    ),

    array(
        'name' => __('Width of listing content section', 'geodirectory'),
        'desc' => __('Enter the width of content section of listing page in %', 'geodirectory'),
        'id' => 'geodir_width_listing_contant_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '63' // Default value to show home top section
    ),

    array(
        'name' => __('Listing left section', 'geodirectory'),
        'desc' => __('Show the left section of listing page', 'geodirectory'),
        'id' => 'geodir_show_listing_left_section',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),

    array(
        'name' => __('Width of listing left section', 'geodirectory'),
        'desc' => __('Enter the width of left section of listing in %', 'geodirectory'),
        'id' => 'geodir_width_listing_left_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value to show home top section
    ),

    array(
        'name' => __('Listing bottom section', 'geodirectory'),
        'desc' => __('Show the bottom section of listing page', 'geodirectory'),
        'id' => 'geodir_show_listing_bottom_section',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),

    array(
        'name' => __('Upload listing no image', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_listing_no_img',
        'type' => 'file',
        'std' => '0' // Default value to show home top section
    ),

    array(
        'name' => __('Description word limit', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_desc_word_limit',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '50' // Default value to show home top section
    ),

    array('type' => 'sectionend', 'id' => 'geodir_listing_layout'),


    array('name' => __('Listing General Settings', 'geodirectory'), 'type' => 'sectionstart', 'desc' => '', 'id' => 'geodir_listing_gen_settings '),

    array(
        'name' => __('New listing default status', 'geodirectory'),
        'desc' => __('Select new listing default status.', 'geodirectory'),
        'tip' => '',
        'id' => 'geodir_new_post_default_status',
        'css' => 'min-width:300px;',
        'std' => 'publish',
        'type' => 'select',
        'class' => 'chosen_select',
        'options' => array_unique(array(
            'publish' => __('publish', 'geodirectory'),
            'draft' => __('draft', 'geodirectory'),
        ))
    ),

    array(
        'name' => __('New listings settings', 'geodirectory'),
        'desc' => __('Enter number of days a listing will appear new.(enter 0 to disable feature)', 'geodirectory'),
        'id' => 'geodir_listing_new_days',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value for the page title - changed in settings
    ),

    array('type' => 'sectionend', 'id' => 'geodir_listing_gen_settings'),


    array('name' => __('Add Listing Form Settings', 'geodirectory'), 'type' => 'sectionstart', 'desc' => '', 'id' => 'geodir_add_listing_gen_settings'),

    array(
        'name' => __('Enable "Accept Terms and Conditions"', 'geodirectory'),
        'desc' => __('Show the "Accept Terms and Conditions" field on add listing.', 'geodirectory'),
        'id' => 'geodir_accept_term_condition',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),


    array(
        'name' => __('Show description field as editor', 'geodirectory'),
        'desc' => __('Select post types to show advanced editor on add listing page.', 'geodirectory'),
        'tip' => '',
        'id' => 'geodir_tiny_editor_on_add_listing',
        'css' => 'min-width:300px;',
        'std' => array(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array('type' => 'sectionend', 'id' => 'geodir_add_listing_gen_settings'),
    /* Listing Layout Settings end */


    /* Search Layout Settings end */

    array('name' => __('Search', 'geodirectory'), 'type' => 'title', 'desc' => '', 'id' => 'geodir_search_settings '),


    array('name' => __('Search Page Layout Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_search_layout'),

    array(
        'name' => __('Search top section', 'geodirectory'),
        'desc' => __('Show the top section of search page', 'geodirectory'),
        'id' => 'geodir_show_search_top_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Search right section', 'geodirectory'),
        'desc' => __('Show the right section of search page', 'geodirectory'),
        'id' => 'geodir_show_search_right_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Width of search right section', 'geodirectory'),
        'desc' => __('Enter the width of right section of search page in %', 'geodirectory'),
        'id' => 'geodir_width_search_right_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value to show home top section
    ),


    array(
        'name' => __('Search content section view', 'geodirectory'),
        'desc' => __('Set the listing view of search page', 'geodirectory'),
        'id' => 'geodir_search_view',
        'css' => 'min-width:300px;',
        'std' => 'gridview_onehalf',
        'type' => 'select',
        'class' => 'chosen_select',
        'options' => array_unique(array(
            'gridview_onehalf' => __('Grid View (Two Columns)', 'geodirectory'),
            'gridview_onethird' => __('Grid View (Three Columns)', 'geodirectory'),
            'gridview_onefourth' => __('Grid View (Four Columns)', 'geodirectory'),
            'gridview_onefifth' => __('Grid View (Five Columns)', 'geodirectory'),
            'listview' => __('List view', 'geodirectory'),
        ))
    ),

    array(
        'name' => __('Width of search content section', 'geodirectory'),
        'desc' => __('Enter the width of content section of search page in %', 'geodirectory'),
        'id' => 'geodir_width_search_contant_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '63' // Default value to show home top section
    ),

    array(
        'name' => __('Search left section', 'geodirectory'),
        'desc' => __('Show the left section of search page', 'geodirectory'),
        'id' => 'geodir_show_search_left_section',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),

    array(
        'name' => __('Width of search left section', 'geodirectory'),
        'desc' => __('Enter the width of left section of search in %', 'geodirectory'),
        'id' => 'geodir_width_search_left_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value to show home top section
    ),

    array(
        'name' => __('Search bottom section', 'geodirectory'),
        'desc' => __('Show the bottom section of search page', 'geodirectory'),
        'id' => 'geodir_show_search_bottom_section',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),
	
	array(
        'name' => __('Show advanced pagination details', 'geodirectory'),
        'desc' => __('This will add extra pagination info like "Showing listings x-y of z" aftre/before pagination.', 'geodirectory'),
        'id' => 'geodir_pagination_advance_info',
        'css' => 'min-width:300px;',
        'std' => '',
        'type' => 'select',
        'class' => 'chosen_select',
        'options' => array(
						'' => __('Never Display', 'geodirectory'),
						'after' => __('After Pagination', 'geodirectory'),
						'before' => __('Before Pagination', 'geodirectory')
					)
    ),

    array('type' => 'sectionend', 'id' => 'geodir_search_layout'),


    array('name' => __('Search form default text settings', 'geodirectory'), 'type' => 'sectionstart', 'desc' => '', 'id' => 'geodir_search_form_default_text_settings'),

    array(
        'name' => __('Search field default value', 'geodirectory'),
        'desc' => __('Show the search text box \'placeholder\' value on search form.', 'geodirectory'),
        'id' => 'geodir_search_field_default_text',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => 'Search for' // show on the listing page.
    ),

    array(
        'name' => __('Near field default value', 'geodirectory'),
        'desc' => __('Show the near text box \'placeholder\' value on search form.', 'geodirectory'),
        'id' => 'geodir_near_field_default_text',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => 'Near' // show on the listing page.
    ),

    array(
        'name' => __('Search button label', 'geodirectory'),
        'desc' => __('Show the search button label on search form.', 'geodirectory'),
        'id' => 'geodir_search_button_label',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => 'Search' // show on the listing page.
    ),

    array('type' => 'sectionend', 'id' => 'geodir_search_form_default_text_settings'),

    /* Listing Layout Settings end */


    /* Detail Layout Settings end */

    array('name' => __('Detail', 'geodirectory'), 'type' => 'title', 'desc' => '', 'id' => 'geodir_detail_settings '),

    array('name' => __('Detail/Single Page Settings', 'geodirectory'), 'type' => 'sectionstart', 'desc' => '', 'id' => 'detail_page_settings '),

    array(
        'name' => __('Detail top section', 'geodirectory'),
        'desc' => __('Show the top section of listing page', 'geodirectory'),
        'id' => 'geodir_show_detail_top_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Detail bottom section', 'geodirectory'),
        'desc' => __('Show the bottom section of listing page', 'geodirectory'),
        'id' => 'geodir_show_detail_bottom_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),
    array(
        'name' => __('Detail sidebar section on left side', 'geodirectory'),
        'desc' => __('Display detail sidebar section on left side of the detail page', 'geodirectory'),
        'id' => 'geodir_detail_sidebar_left_section',
        'type' => 'checkbox',
        'std' => '0'
    ),
    array(
        'name' => __('Disable GD modal', 'geodirectory'),
        'desc' => __('Disable GD modal that displays slideshow images in popup', 'geodirectory'),
        'id' => 'geodir_disable_gb_modal',
        'type' => 'checkbox',
        'std' => '0'
    ),
    array(
        'name' => __('Disable Tweet, Fb Like, Google+ buttons section', 'geodirectory'),
        'desc' => __('Disable Tweet, Fb Like, Google+ buttons section that displays on Detail page sidebar', 'geodirectory'),
        'id' => 'geodir_disable_tfg_buttons_section',
        'type' => 'checkbox',
        'std' => '0'
    ),
    array(
        'name' => __('Disable share this button section', 'geodirectory'),
        'desc' => __('Disable share this button section that displays on Detail page sidebar', 'geodirectory'),
        'id' => 'geodir_disable_sharethis_button_section',
        'type' => 'checkbox',
        'std' => '0'
    ),
    array(
        'name' => __('Disable Google Analytics section', 'geodirectory'),
        'desc' => __('Disable Google Analytics section that displays on Detail page sidebar', 'geodirectory'),
        'id' => 'geodir_disable_google_analytics_section',
        'type' => 'checkbox',
        'std' => '0'
    ),
    array(
        'name' => __('Disable User Links section', 'geodirectory'),
        'desc' => __('Disable User Links section (Edit post, Favorite etc..) that displays on Detail page sidebar', 'geodirectory'),
        'id' => 'geodir_disable_user_links_section',
        'type' => 'checkbox',
        'std' => '0'
    ),
    array(
        'name' => __('Disable Rating Info section', 'geodirectory'),
        'desc' => __('Disable Rating Info section that displays on Detail page sidebar', 'geodirectory'),
        'id' => 'geodir_disable_rating_info_section',
        'type' => 'checkbox',
        'std' => '0'
    ),
    array(
        'name' => __('Disable Listing Info section', 'geodirectory'),
        'desc' => __('Disable Listing Info section that displays on Detail page sidebar', 'geodirectory'),
        'id' => 'geodir_disable_listing_info_section',
        'type' => 'checkbox',
        'std' => '0'
    ),

    array('type' => 'sectionend', 'id' => 'detail_page_settings'),


    /* ---------- DETAIL PAGE TAB SETTING START*/

    array('name' => __('Detail Page Tab Settings', 'geodirectory'), 'type' => 'sectionstart', 'desc' => '', 'id' => 'geodir_detail_page_tab_settings '),

    array(
        'name' => __('Exclude selected tabs from detail page', 'geodirectory'),
        'desc' => __('Select tabs to exclude from the list of all appearing tabs on detail page.', 'geodirectory'),
        'tip' => '',
        'id' => 'geodir_detail_page_tabs_excluded',
        'css' => 'min-width:300px;',
        'std' => geodir_get_posttypes(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select tabs', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_detail_page_tabs_key_value_array())
    ),


    array('type' => 'sectionend', 'id' => 'geodir_detail_page_tab_settings'),
    /* ---------- DETAIL PAGE TAB SETTING END*/

    /* START DEFAULT STAR IMAGE*/
    array('name' => __('Default Rating Settings', 'geodirectory'), 'type' => 'sectionstart', 'desc' => '', 'id' => 'geodir_rating_settings '),

    array(
        'name' => __('Upload default rating star icon', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_default_rating_star_icon',
        'type' => 'file',
        'std' => '0',
        'value' => geodir_plugin_url() . '/geodirectory-assets/images/stars.png'// Default value to show home top section
    ),

    array('type' => 'sectionend', 'id' => 'geodir_detail_page_tab_settings'),

    /* END DEFAULT STAR IMAGE*/

    /* Detail related post settings start */

    array('name' => __('Related Post Settings', 'geodirectory'), 'type' => 'sectionstart', 'desc' => '', 'id' => 'detail_page_related_post_settings '),

    array(
        'name' => __('Show related post listing on', 'geodirectory'),
        'desc' => __('Select the post types to display related listing on detail page.', 'geodirectory'),
        'tip' => '',
        'id' => 'geodir_add_related_listing_posttypes',
        'css' => 'min-width:300px;',
        'std' => geodir_get_posttypes(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array(
        'name' => __('Relate to', 'geodirectory'),
        'desc' => __('Set the relation between current post to related posts.', 'geodirectory'),
        'id' => 'geodir_related_post_relate_to',
        'css' => 'min-width:300px;',
        'std' => 'category',
        'type' => 'select',
        'class' => 'chosen_select',
        'options' => array_unique(array(
            'category' => __('Categories', 'geodirectory'),
            'tags' => __('Tags', 'geodirectory'),
        ))
    ),

    array(
        'name' => __('Layout', 'geodirectory'),
        'desc' => __('Set the listing view of relate post on detail page', 'geodirectory'),
        'id' => 'geodir_related_post_listing_view',
        'css' => 'min-width:300px;',
        'std' => 'gridview_onehalf',
        'type' => 'select',
        'class' => 'chosen_select',
        'options' => array_unique(array(
            'gridview_onehalf' => __('Grid View (Two Columns)', 'geodirectory'),
            'gridview_onethird' => __('Grid View (Three Columns)', 'geodirectory'),
            'gridview_onefourth' => __('Grid View (Four Columns)', 'geodirectory'),
            'gridview_onefifth' => __('Grid View (Five Columns)', 'geodirectory'),
            'listview' => __('List view', 'geodirectory'),
        ))
    ),

    array(
        'name' => __('Sort by', 'geodirectory'),
        'desc' => __('Set the related post listing sort by view', 'geodirectory'),
        'id' => 'geodir_related_post_sortby',
        'css' => 'min-width:300px;',
        'std' => 'latest',
        'type' => 'select',
        'class' => 'chosen_select',
        'options' => array_unique(array(
            'latest' => __('Latest', 'geodirectory'),
            'featured' => __('Featured', 'geodirectory'),
            'high_review' => __('Review', 'geodirectory'),
            'high_rating' => __('Rating', 'geodirectory'),
            'random' => __('Random', 'geodirectory'),
        ))
    ),

    array(
        'name' => __('Number of posts:', 'geodirectory'),
        'desc' => __('Enter number of posts to display on related posts listing', 'geodirectory'),
        'id' => 'geodir_related_post_count',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '5' // Default value to show home top section
    ),

    array(
        'name' => __('Post excerpt', 'geodirectory'),
        'desc' => __('Post content excerpt character count', 'geodirectory'),
        'id' => 'geodir_related_post_excerpt',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '20' // Default value to show home top section
    ),


    array('type' => 'sectionend', 'id' => 'detail_page_related_post_settings'),
    /* Detail Layout Settings end */

    /* Author Layout Settings Start */

    array('name' => __('Author', 'geodirectory'), 'type' => 'title', 'desc' => '', 'id' => 'geodir_author_settings '),


    array('name' => __('Author Page Layout Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_author_layout'),

    array(
        'name' => __('Author top section', 'geodirectory'),
        'desc' => __('Show the top section of author page', 'geodirectory'),
        'id' => 'geodir_show_author_top_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Author right section', 'geodirectory'),
        'desc' => __('Show the right section of author page', 'geodirectory'),
        'id' => 'geodir_show_author_right_section',
        'type' => 'checkbox',
        'std' => '1' // Default value to show home top section
    ),

    array(
        'name' => __('Width of author right section', 'geodirectory'),
        'desc' => __('Enter the width of right section of author page in %', 'geodirectory'),
        'id' => 'geodir_width_author_right_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value to show home top section
    ),

    array(
        'name' => __('Author content section view', 'geodirectory'),
        'desc' => __('Set the listing view of author page', 'geodirectory'),
        'id' => 'geodir_author_view',
        'css' => 'min-width:300px;',
        'std' => 'gridview_onehalf',
        'type' => 'select',
        'class' => 'chosen_select',
        'options' => array_unique(array(
            'gridview_onehalf' => __('Grid View (Two Columns)', 'geodirectory'),
            'gridview_onethird' => __('Grid View (Three Columns)', 'geodirectory'),
            'gridview_onefourth' => __('Grid View (Four Columns)', 'geodirectory'),
            'gridview_onefifth' => __('Grid View (Five Columns)', 'geodirectory'),
            'listview' => __('List view', 'geodirectory'),
        ))
    ),

    array(
        'name' => __('Width of author content section', 'geodirectory'),
        'desc' => __('Enter the width of content section of author page in %', 'geodirectory'),
        'id' => 'geodir_width_author_contant_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '63' // Default value to show home top section
    ),

    array(
        'name' => __('Author left section', 'geodirectory'),
        'desc' => __('Show the left section of author page', 'geodirectory'),
        'id' => 'geodir_show_author_left_section',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),

    array(
        'name' => __('Width of author left section', 'geodirectory'),
        'desc' => __('Enter the width of left section of home page in %', 'geodirectory'),
        'id' => 'geodir_width_author_left_section',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '30' // Default value to show home top section
    ),

    array(
        'name' => __('Author bottom section', 'geodirectory'),
        'desc' => __('Show the bottom section of author page', 'geodirectory'),
        'id' => 'geodir_show_author_bottom_section',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),


    array(
        'name' => __('Description word limit', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_author_desc_word_limit',
        'type' => 'text',
        'css' => 'min-width:300px;',
        'std' => '50' // Default value to show home top section
    ),

    array('type' => 'sectionend', 'id' => 'geodir_author_layout'),
    /* Author Layout Settings end */


    /* Post Type Navigation Settings Start */
    array('name' => __('Navigation', 'geodirectory'), 'type' => 'title', 'desc' => '', 'id' => 'geodir_navigation_settings'),


    /* Post Type Navigation Settings Start */

    array('name' => __('Navigation Locations', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_navigation_locations'),

    array(
        'name' => __('Show geodirectory navigation in selected menu locations', 'geodirectory'),
        'desc' => '',
        'tip' => '',
        'id' => 'geodir_theme_location_nav',
        'css' => 'min-width:300px;',
        'std' => array(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select menu locations', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_theme_location_setting_fun())
    ),
    array('type' => 'sectionend', 'id' => 'geodir_navigation_options'),


    array('name' => __('Navigation Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_navigation_options'),


    array(
        'name' => __('Show add listing navigation in menu', 'geodirectory'),
        'desc' => sprintf(__('Show add listing navigation in main menu? (untick to disable) If you disable this option, none of the add listing link will appear in main navigation.', 'geodirectory')),
        'id' => 'geodir_show_addlisting_nav',
        'std' => '1',
        'type' => 'checkbox'
    ),

    array(
        'name' => __('Show listings navigation in menu', 'geodirectory'),
        'desc' => sprintf(__('Show listing navigation in main menu? (untick to disable) If you disable this option, none of the listing link will appear in main navigation.', 'geodirectory')),
        'id' => 'geodir_show_listing_nav',
        'std' => '1',
        'type' => 'checkbox'
    ),

    array('type' => 'sectionend', 'id' => 'geodir_navigation_options'),


    array('name' => __('Post Type Navigation Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_post_type_navigation_layout'),
    array(
        'name' => __('Show listing link in main navigation', 'geodirectory'),
        'desc' => '',
        'tip' => '',
        'id' => 'geodir_add_posttype_in_main_nav',
        'css' => 'min-width:300px;',
        'std' => array(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array(
        'name' => __('Show listing link in listing navigation', 'geodirectory'),
        'desc' => '',
        'tip' => '',
        'id' => 'geodir_add_posttype_in_listing_nav',
        'css' => 'min-width:300px;',
        'std' => geodir_get_posttypes(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array(
        'name' => __('Allow post type to add from frontend', 'geodirectory'),
        'desc' => '',
        'tip' => '',
        'id' => 'geodir_allow_posttype_frontend',
        'css' => 'min-width:300px;',
        'std' => geodir_get_posttypes(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array(
        'name' => __('Show add listing link in main navigation', 'geodirectory'),
        'desc' => '',
        'tip' => '',
        'id' => 'geodir_add_listing_link_main_nav',
        'css' => 'min-width:300px;',
        'std' => array(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array(
        'name' => __('Show add listing link in add listing navigation', 'geodirectory'),
        'desc' => '',
        'tip' => '',
        'id' => 'geodir_add_listing_link_add_listing_nav',
        'css' => 'min-width:300px;',
        'std' => geodir_get_posttypes(),
        'type' => 'multiselect',
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array('type' => 'sectionend', 'id' => 'geodir_post_type_navigation_layout'),


    array('name' => __('User Dashboard Post Type Navigation Settings', 'geodirectory'), 'type' => 'sectionstart', 'desc' => '', 'id' => 'geodir_user_dashboard_post_type '),


    array(
        'name' => __('Show add listing link in user dashboard', 'geodirectory'),
        'desc' => '',
        'tip' => '',
        'id' => 'geodir_add_listing_link_user_dashboard',
        'css' => 'min-width:300px;',
        'std' => geodir_get_posttypes(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array(
        'name' => __('Show favorite link in user dashboard', 'geodirectory'),
        'desc' => __('Option will not appear if user does not have a favorite of that post type', 'geodirectory'),
        'tip' => '',
        'id' => 'geodir_favorite_link_user_dashboard',
        'css' => 'min-width:300px;',
        'std' => geodir_get_posttypes(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array(
        'name' => __('Show listing link in user dashboard', 'geodirectory'),
        'desc' => __('Option will not appear if user does not have his/her own listing of that post type', 'geodirectory'),
        'tip' => '',
        'id' => 'geodir_listing_link_user_dashboard',
        'css' => 'min-width:300px;',
        'std' => geodir_get_posttypes(),
        'type' => 'multiselect',
        'placeholder_text' => __('Select post types', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => array_unique(geodir_post_type_setting_fun())
    ),

    array('type' => 'sectionend', 'id' => 'geodir_user_dashboard_post_type'),
    /* Post Type Navigation Settings End */

    /* Script Settings Start */
    array('name' => __('Scripts', 'geodirectory'), 'type' => 'title', 'desc' => '', 'id' => 'geodir_script_settings '),

    /*
    array( 	'name' => __( 'Add/Remove Scripts', 'geodirectory' ),
                'type' => 'sectionstart',
                'desc' => '',
                'id' => 'geodir_script_enqueue_settings' ),

    array(
            'name' => __( 'Google Api script', 'geodirectory' ),
            'desc' 		=> __( 'Include Google Api script', 'geodirectory' ),
            'id' 		=> 'geodir_enqueue_google_api_script',
            'type' 		=> 'checkbox',
            'std' 		=> '1' // Default value for the page title - changed in settings
        ),

    array(
            'name' => __( 'Flexslider script', 'geodirectory' ),
            'desc' 		=> __( 'include flexslider script', 'geodirectory' ),
            'id' 		=> 'geodir_enqueue_flexslider_script',
            'type' 		=> 'checkbox',
            'std' 		=> '1' // Default value for the page title - changed in settings
        ),

        array( 'type' => 'sectionend', 'id' => 'geodir_script_enqueue_settings'),

    */

    array('name' => __('SCSS Settings (CSS combine and minify)', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_scss_settings'),

    array(
        'name' => __('Disable Core SCSS', 'geodirectory'),
        'desc' => __('Stops the CSS files being minified and output as one.', 'geodirectory'),
        'id' => 'geodir_scss_core',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),

    array('type' => 'sectionend', 'id' => 'geodir_scss_settings'),

    array('name' => __('Script Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_script_settings'),

    array(
        'name' => __('Custom style css code', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_coustem_css',
        'type' => 'textarea',
        'css' => 'min-width:300px;',
        'std' => '' // Default value for the page title - changed in settings
    ),

    array(
        'name' => __('Header script code', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_header_scripts',
        'type' => 'textarea',
        'css' => 'min-width:300px;',
        'std' => '' // Default value for the page title - changed in settings
    ),

    array(
        'name' => __('Footer script code', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_footer_scripts',
        'type' => 'textarea',
        'css' => 'min-width:300px;',
        'std' => '' // Default value for the page title - changed in settings
    ),

    array('type' => 'sectionend', 'id' => 'geodir_script_settings'),
    /* Script Settings End */

    /* Map Settings Start */
    array('name' => __('Map', 'geodirectory'), 'type' => 'title', 'desc' => '', 'id' => 'geodir_map_settings '),

    /* Untick the category by default on home map */
    array(
        'name' => __('Home Map Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_home_map_section'
    ),
    array(
        'name' => __('Select category to untick by default on map', 'geodirectory'),
        'desc' => __('Select category to untick by default on the home map.', 'geodirectory'),
        'tip' => '',
        'id' => 'geodir_home_map_untick',
        'css' => 'min-width:300px;',
        'std' => '',
        'type' => 'multiselect',
        'placeholder_text' => __('Select category', 'geodirectory'),
        'class' => 'chosen_select',
        'options' => geodir_home_map_cats_key_value_array()
    ),
    array(
        'type' => 'sectionend',
        'id' => 'geodir_home_map_section'
    ),

    array(
        'name' => __('Add Listing Map Settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_add_listing_map_section'
    ),
    array(
        'name' => __('Disable mouse scroll', 'geodirectory'),
        'desc' => __('Stops the mouse scroll zooming the map', 'geodirectory'),
        'id' => 'geodir_add_listing_mouse_scroll',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),
    array(
        'type' => 'sectionend',
        'id' => 'geodir_add_listing_map_section'
    ),


    array('name' => __('Default map settings', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_map_default_settings'),

    array(
        'name' => '',
        'desc' => '',
        'id' => 'map_default_settings',
        'type' => 'map_default_settings',
        'css' => 'min-width:300px;',
        'std' => '' // Default value for the page title - changed in settings
    ),

    array(
        'name' => __('Upload map default marker icon', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_default_marker_icon',
        'type' => 'file',
        'std' => '0',
        'value' => geodir_plugin_url() . '/geodirectory-functions/map-functions/icons/pin.png'// Default value to show home top section
    ),
    // add option that allows enable/disable map dragging to phone devices
    array(
        'name' => __('Show button control on map to enable/disable dragging', 'geodirectory'),
        'desc' => __('If checked, it displays button control to enable/disable dragging on google maps for phone devices', 'geodirectory'),
        'id' => 'geodir_map_onoff_dragging',
        'type' => 'checkbox',
        'std' => '0' // Default value to show home top section
    ),

    array('type' => 'sectionend', 'id' => 'geodir_map_default_settings'),

    array('name' => __('Show / hide post type and category on map', 'geodirectory'),
        'type' => 'sectionstart',
        'desc' => '',
        'id' => 'geodir_map_settings'),

    array(
        'name' => __('Select Map Category', 'geodirectory'),
        'desc' => '',
        'id' => 'geodir_map_settings',
        'type' => 'map',
        'css' => 'min-width:300px;',
        'std' => '' // Default value for the page title - changed in settings
    ),

    array('type' => 'sectionend', 'id' => 'geodir_map_settings'),
    /* Map Settings End */

)); // End Design settings


//$_SESSION['geodir_settings']['design_settings'] = $geodir_settings['design_settings'] ;