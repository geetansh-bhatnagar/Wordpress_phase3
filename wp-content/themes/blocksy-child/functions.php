<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'ct-main-styles','ct-admin-frontend-styles' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

// writing short code to show twitter and facebook button based on parameter

function wpb_follow_us(){

    $content= '<h3 class="follow-us">If you like this article, then please follow us on 
  <a href="https://twitter.com/hip_hop_india12?lang=en" title="Hip-Hop gang" target="_blank" rel="nofollow">
    <button type="button" style="background-color: #1DA1F2; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor:pointer;">
      Twitter
    </button>
  </a>
  and
  <a href="https://www.facebook.com/HipHopIndiaCom/" title="Hip-Hop gang on facebook" target="_blank" rel="nofollow">
    <button type="button" style="background-color: #1877F2; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor:pointer;">
      Facebook
    </button>
  </a>.
</h3>';

    return $content;
    }
add_shortcode('buttons', 'wpb_follow_us');



/**
 *	Register Movie Type
 *
 */

add_action( 'init', 'rv_movie_cpt' );
function rv_movie_cpt() {

    $labels = array(
        'name'               => _x( 'Movie', 'post type general name', 'engwp' ),
        'singular_name'      => _x( 'Movie', 'post type singular name', 'engwp' ),
        'menu_name'          => _x( 'Movies', 'admin menu', 'engwp' ),
        'name_admin_bar'     => _x( 'Movie', 'add new on admin bar', 'engwp' ),
        'add_new'            => _x( 'Add New', 'Movie', 'engwp' ),
        'add_new_item'       => __( 'Add New Movie', 'engwp' ),
        'new_item'           => __( 'New Movie', 'engwp' ),
        'edit_item'          => __( 'Edit Movie', 'engwp' ),
        'view_item'          => __( 'View Movie', 'engwp' ),
        'all_items'          => __( 'All Movies', 'engwp' ),
        'search_items'       => __( 'Search Movies', 'engwp' ),
        'parent_item_colon'  => __( 'Parent Movie:', 'engwp' ),
        'not_found'          => __( 'No Movies found.', 'engwp' ),
        'not_found_in_trash' => __( 'No Movies found in Trash.', 'engwp' )
    );

    $args = array(
        'description'	      => __( 'Movie', 'engwp' ),
        'labels'	      => $labels,
        'supports'	      => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions' ),
        'hierarchical'	      	=> false,
        'public'	      	=> true,
        'publicly_queryable'  	=> true,
        'query_var'	      	=> true,
        'rewrite'	      	=> array( 'slug' => 'filmer' ), /* changed from movies to filmer */
        'show_ui'	      	=> true,
        'menu_icon'	      	=> 'dashicons-format-video',
        'show_in_menu'	      	=> true,
        'show_in_nav_menus'	=> true,
        'show_in_admin_bar'	=> true,
        // 'menu_position'	=> 5,
        'can_export'		=> true,
        'has_archive'		=> true,
        'exclude_from_search'	=> false,
        'capability_type'	=> 'post',
    );

    register_post_type( 'movie', $args );

}

add_action( 'init', 'rv_create_movie_taxonomies' );
function rv_create_movie_taxonomies() {

    // Add new taxonomy, make it non-hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Year Made', 'taxonomy general name' ),
        'singular_name'              => _x( 'Year', 'taxonomy singular name' ),
        'search_items'               => __( 'Search Years' ),
        'all_items'                  => __( 'All Years' ),
        'parent_item'                => __( 'Parent Year' ),
        'parent_item_colon'          => __( 'Parent Year:' ),
        'edit_item'                  => __( 'Edit Year' ),
        'update_item'                => __( 'Update Year' ),
        'add_new_item'               => __( 'Add New Year' ),
        'new_item_name'              => __( 'New Year Name' ),
        'separate_items_with_commas' => __( 'Separate Years with commas' ),
        'add_or_remove_items'        => __( 'Add or remove Years' ),
        'choose_from_most_used'      => __( 'Choose from the most used Years' ),
        'not_found'                  => __( 'No Years found.' ),
        'menu_name'                  => __( 'Year Made' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        // 'query_var'          => true,
        // 'show_in_nav_menus'	=> false,
        'public'		=> true,
        'publicly_queryable'	=> true,
        'has_archive'		=> true,
    );

    $years = array( 'rewrite' => array( 'slug' => 'movie-year' ) );

    $movie_args = array_merge( $args, $years );

    register_taxonomy( 'movie_years', 'movie', $movie_args );

}

//* Add post type support within the Genesis Framework
if ( 'genesis' == basename( TEMPLATEPATH ) )
    add_post_type_support( 'movie', 'genesis-cpt-archives-settings' );



//* Create Moive Type custom taxonomy (category)
add_action( 'init', 'custom_type_taxonomy' );
function custom_type_taxonomy() {

    register_taxonomy( 'movie-type', 'movie',
        array(
            'labels' => array(
                'name'          => _x( 'Movie Category', 'taxonomy general name', 'text_domain' ),
                'add_new_item'  => __( 'Add New Movie Category', 'text_domain' ),
                'new_item_name' => __( 'New Movie Type', 'text_domain' ),
            ),
            'exclude_from_search' => true,
            'has_archive'         => true,
            'hierarchical'        => true,
            'rewrite'             => array( 'slug' => 'movie-type', 'with_front' => false ),
            'show_ui'             => true,
            'show_tagcloud'       => false,
        )
    );

}

//function to generate shortcode to display the posts present in  movie
function custom_taxonomy_shortcode( $atts ) {
    // Extract shortcode attributes
    extract( shortcode_atts( array(
        'taxonomy' => 'movie-type',
        'post_type' => 'movie',
    ), $atts ) );

    // Check if a specific term has been selected
    if ( isset( $_GET['term'] ) ) {
        // Retrieve the selected term
        $selected_term = get_term_by( 'slug', $_GET['term'], $taxonomy );

        // Build a WP_Query to retrieve all movies assigned to the selected term
        $query_args = array(
            'post_type' => $post_type,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $_GET['term'],
                ),
            ),
        );
        $movies_query = new WP_Query( $query_args );

        // Output the list of movies assigned to the selected term
        $output = '<h2>' . esc_html( $selected_term->name ) . '</h2>';
        $output .= '<ul>';

        while ( $movies_query->have_posts() ) {
            $movies_query->the_post();

            // Build the link to the movie
            $link = get_permalink();
            $output .= '<li>';
            $output .= '<a href="' . esc_url( $link ) . '">' . get_the_title() . '</a>';
            $output .= '<div>' . get_the_post_thumbnail() . '</div>';
            $output .= '<div>' . get_the_excerpt() . '</div>';
            $output .= '</li>';
        }

        $output .= '</ul>';

        // Reset the post data
        wp_reset_postdata();
    } else {
        // Retrieve all terms in the specified taxonomy
        $terms = get_terms( array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            // Output the list of terms
            $output = '<h2>Select ' . esc_html( $taxonomy ) . ':</h2>';
            $output .= '<ul>';

            foreach ( $terms as $term ) {
                // Build the link to the term
                $link = add_query_arg( 'term', $term->slug );
                $output .= '<li><h3><a href="' . esc_url( $link ) . '">' . esc_html( $term->name ) . '</a></h3></li>';
            }

            $output .= '</ul>';
        } else {
            // Output a message if no terms are found
            $output = '<p>No ' . esc_html( $taxonomy ) . ' found.</p>';
        }
    }

    return $output;
}

add_shortcode( 'custom-taxonomy', 'custom_taxonomy_shortcode' );