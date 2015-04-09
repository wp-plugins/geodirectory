<?php
/**
 * Template for the locations page
 *
 * You can make most changes via hooks or see the link below for info on how to replace the template in your theme.
 *
 * @link http://docs.wpgeodirectory.com/customizing-geodirectory-templates/
 * @since 1.0.0
 * @package GeoDirectory
 */
// get header
get_header();

###### WRAPPER OPEN ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_open', 'home-page', 'geodir-wrapper', '');

###### TOP CONTENT ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_top_content', 'home-page');
/**
 * Calls the top section widget area and the breadcrumbs on the locations page.
 *
 * @since 1.1.0
 */
do_action('geodir_location_before_main_content');
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_before_main_content', 'home-page');

###### SIDEBAR ######
/**
 * Adds the location page left sidebar to the location template page if active.
 *
 * @since 1.1.0
 */
do_action('geodir_location_sidebar_left');

###### MAIN CONTENT WRAPPERS OPEN ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_content_open', 'home-page', 'geodir-wrapper-content', '');

###### MAIN CONTENT ######
/**
 * Calls the locations page main content area on the locations template page.
 *
 * @since 1.1.0
 */
do_action('geodir_location_content');

###### MAIN CONTENT WRAPPERS CLOSE ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_content_close', 'home-page');

###### SIDEBAR ######
/**
 * Adds the location page right sidebar to the location template page if active.
 *
 * @since 1.1.0
 */
do_action('geodir_location_sidebar_right');

###### BOTTOM SECTION WIDGET AREA ######
/**
 * Adds the location page bottom widget area to the location template page if active.
 *
 * @since 1.1.0
 */
do_action('geodir_sidebar_location_bottom_section');

# WRAPPER CLOSE ######	
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_close', 'home-page');

//get footer
get_footer();    