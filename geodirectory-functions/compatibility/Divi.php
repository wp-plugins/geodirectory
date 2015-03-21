<?php

// MODIFY BODY CLASSES ON SIGNUP PAGE
add_filter('body_class', 'geodir_divi_signup_body_class', 999);

// REPLACE DIVI BODY CLASS ON SIGNUP PAGE
function geodir_divi_signup_body_class($classes)
{
    if (isset($_GET['geodir_signup']) && $_GET['geodir_signup']) {
        $classes = str_replace('et_right_sidebar', 'et_full_width_page', $classes);
        $classes[] = 'divi-gd-signup';
    }
    return $classes;
}

// WRAPPER CLOSE FUNCTIONS
add_action('geodir_wrapper_close', 'geodir_divi_action_wrapper_close', 11);
function geodir_divi_action_wrapper_close()
{
    if (isset($_GET['geodir_signup']) && $_GET['geodir_signup']) {
        // We need to close extra divs generated by WRAPPER BEFORE MAIN CONTENT (below) because there is no sidebar on this page
        echo '</div></div>';
    }
}