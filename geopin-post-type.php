<?php
/**
 * geoPins Custom Post Type
 * Plugin Name: geo-pins-data-input
 * Plugin URI:  http://github.com/bonjourworld/geo-pins-data-input
 * Description: Creates a custom post type and enables custom data input saving by creating WP metaboxes
 * Version:     1.0.0
 * Author:      James Roussel
 * Author URI:  http://github.com/bonjourworld
 * Text Domain: geoPin-post-type
 */

// If this file is called directly, die!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/geopins-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$post_type_registrations = new Geopin_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$post_type = new Geopin_Post_Type( $post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$post_type_registrations->init();

// Initialize metaboxes
$post_type_metaboxes = new Geopin_Post_Type_Metaboxes;
$post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds geoPin posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/class-post-type-admin.php';

	$post_type_admin = new Geopin_Post_Type_Admin( $post_type_registrations );
	$post_type_admin->init();

}