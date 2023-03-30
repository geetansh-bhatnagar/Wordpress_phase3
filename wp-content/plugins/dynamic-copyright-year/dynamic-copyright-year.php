<?php
/*
    Plugin name: Plugin for copyright year
    Description: This will change year automatically in our copyright section
    Version: 1.0
    Author: Geetansh bhatnagar
    Author URI: #
    License: #
    License URI: #
	 */
function dynamic_copyright_year() {
    $current_year = date('Y');

        echo $current_year;

}

function dynamic_copyright() {
    echo 'Copyright © ' ." ". dynamic_copyright_year() . ' - Indian Hip-Hop association (IHHA)';
}

add_action('wp_footer', 'dynamic_copyright');
add_filter('show_admin_bar', '__return_false');
