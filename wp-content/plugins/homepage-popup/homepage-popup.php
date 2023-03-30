<?php
/*
Plugin Name: Popup On Load
Plugin URI: https://www.example.com/
Description: This plugin displays a popup with an image on the home page load.
Version: 1.0
Author: Your Name
Author URI: https://www.example.com/
License: GPL2
*/

function popup_image_on_homepage()
{
    if (is_front_page()) { // Check if the current page is the home page
        echo '<div id="popup-container">';
        echo '<div id="popup">';
        echo '<img src="https://m.media-amazon.com/images/I/51cyzZDGcaL._UF1000,1000_QL80_.jpg" alt="Popup Image">';
        echo '<a href="#" id="close-popup">&times;</a>';
        echo '</div>';
        echo '</div>';
        echo '<style>';
        echo '#popup-container { position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: none; z-index: 999; backdrop-filter: blur(5px); }';
        echo '#popup { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: 90%; max-height: 90%; }';
        echo '#popup img { display: block; width: 100%; height: 500px; }';
        echo '#close-popup { position: absolute; top: 10px; right: 10px; font-size: 24px; text-decoration: none; color: white; }';
        echo '</style>';
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'document.getElementById("popup-container").style.display = "block";';
        echo 'document.body.style.overflow = "hidden";';
        echo '});';
        echo 'document.getElementById("close-popup").addEventListener("click", function(event) {';
        echo 'event.preventDefault();';
        echo 'document.getElementById("popup-container").style.display = "none";';
        echo 'document.body.style.overflow = "auto";';
        echo '});';
        echo '</script>';
    }
}

add_action('wp_footer', 'popup_image_on_homepage');

