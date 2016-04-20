<?php
/*
  Plugin Name: Donations Gallery
  Plugin URI: http://open-ecommerce.org/
  Description: Declares a plugin that will create a custom post type donations-gallery.
  Version: 1.0
  Author: Eduardo G. Silva
  Author URI: http://open-ecommerce.org/
  License: GPLv2
 */

add_action('init', 'create_donation_gallery');

function create_donation_gallery() {
    register_post_type('donation-gallery', array(
        'labels' => array(
            'name' => 'Donation Gallery',
            'singular_name' => 'Donation',
            'add_new' => 'Add New Gallery',
            'add_new_item' => 'Add New Gallery',
            'edit' => 'Edit',
            'edit_item' => 'Edit Gallerys',
            'new_item' => 'New Gallery',
            'view' => 'View',
            'view_item' => 'View Gallery',
            'search_items' => 'Search Gallery',
            'not_found' => 'No Gallery found',
            'not_found_in_trash' => 'No Gallery found in Trash',
            'parent' => 'Parent Gallery'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => plugins_url('images/oe-donations.png', __FILE__),
        'query_var' => true,
        'rewrite' => array('slug' => 'donations'),
        'has_archive' => true,
        'captability_type' => 'post',
        'hierarchical' => 'false'
            )
    );
}


add_filter('template_include', 'include_template_donation', 1);

function include_template_donation($template_path) {
    if (get_post_type() == 'donation-gallery') {
        if (is_single()) {
            if ($theme_file = locate_template(array
                ('single-donation-gallery.php'))) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path(__FILE__) . '/single-donation-gallery.php';
            }
        }
    }
    return $template_path;
}

function donations_rewrite_flush() {
    create_donation-gallery();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'donations_rewrite_flush')
?>
