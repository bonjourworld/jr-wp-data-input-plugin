<?php
/**
 * geoPins Custom Post Type
 * Plugin Name: geo-pins-data-input
 * Plugin URI:  http://github.com/bonjourworld/jr-wp-data-input-plugin
 * Description: Creates a custom post type and enables custom data input saving by creating WP metaboxes
 * Version:     1.0.0
 * Author:      James Roussel
 * Author URI:  http://github.com/bonjourworld
 * Text Domain: geoPin-post-type
 */

/**
 * Registration of CPT and related taxonomies.
 *
 * @since 0.1.0
 */
class Geopin_Post_Type {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since 0.1.0
	 *
	 * @var string VERSION Plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	const PLUGIN_SLUG = 'geopin-post-type';

	protected $registration_handler;

	/**
	 * Initialize the plugin by setting localization and new site activation hooks.
	 *
	 * @since 0.1.0
	 */
	public function __construct( $registration_handler ) {

		$this->registration_handler = $registration_handler;

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since 0.1.0
	 */
	public function activate() {

		$this->registration_handler->register();
		
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since 0.1.0
	 */
	public function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 0.1.0
	 */
	public function load_plugin_textdomain() {
		$domain = self::PLUGIN_SLUG;
		load_plugin_textdomain( $domain, FALSE, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}

}

/**
 * Register custom post type
 */
class GeoPin_Post_Type_Registrations {

	public $post_type = 'geopin';

	public $taxonomies = array( 'geopin-category' );

	public function init() {
		// Add geoPin post type
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of custom post type
	 *
	 * @uses GeoPin_Post_Type_Registrations::register_post_type()
	 * @uses GeoPin_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();

	}

	/**
	 * Register the custom post type.
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'geopin', 'geopin-post-type' ),
			'singular_name'      => __( 'geopin Member', 'geopin-post-type' ),
			'add_new'            => __( 'Add geopin', 'geopin-post-type' ),
			'add_new_item'       => __( 'Add geopin', 'geopin-post-type' ),
			'edit_item'          => __( 'Edit geopin', 'geopin-post-type' ),
			'new_item'           => __( 'New geopin', 'geopin-post-type' ),
			'view_item'          => __( 'View geopin', 'geopin-post-type' ),
			'search_items'       => __( 'Search geopin', 'geopin-post-type' ),
			'not_found'          => __( 'No geopins found', 'geopin-post-type' ),
			'not_found_in_trash' => __( 'No geopins in the trash', 'geopin-post-type' ),
		);

		$supports = array(
			'title',
			// 'editor',
			'thumbnail',
			// 'custom-fields',
			// 'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'geopin', ), 
			'menu_position'   => 5,
			'menu_icon'       => 'dashicons-admin-site',
		);

		$args = apply_filters( 'geoPin_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy the custom post type
	 ***@link http://codex.wordpress.org/Function_Reference/register_taxonomy ***
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'geopin Categories', 'geoPin-post-type' ),
			'singular_name'              => __( 'geopin Category', 'geopin-post-type' ),
			'menu_name'                  => __( 'geopin Categories', 'geopin-post-type' ),
			'edit_item'                  => __( 'Edit geopin Category', 'geopin-post-type' ),
			'update_item'                => __( 'Update geopin Category', 'geopin-post-type' ),
			'add_new_item'               => __( 'Add New geopin Category', 'geopin-post-type' ),
			'new_item_name'              => __( 'New geopin Category Name', 'geopin-post-type' ),
			'parent_item'                => __( 'Parent geopin Category', 'geopin-post-type' ),
			'parent_item_colon'          => __( 'Parent geopin Category:', 'geopin-post-type' ),
			'all_items'                  => __( 'All geopin Categories', 'geopin-post-type' ),
			'search_items'               => __( 'Search geopin Categories', 'geopin-post-type' ),
			'popular_items'              => __( 'Popular geopin Categories', 'geopin-post-type' ),
			'separate_items_with_commas' => __( 'Separate geopin categories with commas', 'geopin-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove geopin categories', 'geopin-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used geopins categories', 'geopin-post-type' ),
			'not_found'                  => __( 'No geopin categories found.', 'geopin-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'geopin-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'geopin_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}

