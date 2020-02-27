<?php
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

/**
 * Enqueue main stylesheet
 */
function uxmexico_scripts() {
	wp_enqueue_style( 'uxmexico-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'uxmexico_scripts' );

/**
 * Add support for featured image
 */
function uxmexico_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'uxmexico_setup' );

/**
 * Prompt install of required plugins.
 */
function uxmexico_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Advanced Custom Fields',
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
		),
		array(
			'name'      => 'ACF to Rest API',
			'slug'      => 'acf-to-rest-api',
			'required'  => true,
		),
	);

	$config = array(
		'id'           => 'uxmexico',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'uxmexico_register_required_plugins' );

/**
 * Register Custom Post Types
 */
function uxmexico_create_post_types() {
	register_post_type(
		'events',
		array(
			'labels' => array(
				'name' => 'Events',
				'singular_name' => 'Event',
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'menu_icon' => 'dashicons-calendar-alt',
			'hierarchical' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
			),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'uxmexico_create_post_types' );

/**
 * Add ACF Fields
 */
function uxmexico_acf_add_local_field_groups() {

	acf_add_local_field_group(
		array(
		'key' => 'group_5e575b6da93dc',
		'title' => 'Events',
		'fields' => array(
			array(
				'key' => 'field_5e575cdd97f9a',
				'label' => 'Date',
				'name' => 'date',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'm/d/Y',
				'return_format' => 'm/d/Y',
				'first_day' => 1,
			),
			array(
				'key' => 'field_5e575cf197f9b',
				'label' => 'Eventbrite URL',
				'name' => 'eventbrite_url',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_5e576a87ef8a8',
				'label' => 'Address',
				'name' => 'address',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
				'delay' => 0,
			),
			array(
				'key' => 'field_5e576a9aef8a9',
				'label' => 'Latitude',
				'name' => 'latitude',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5e576aabef8aa',
				'label' => 'Longitude',
				'name' => 'longitude',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'events',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		)
	);

}
add_action( 'acf/init', 'uxmexico_acf_add_local_field_groups' );


/**
 * Disable the emoji's
 * https://kinsta.com/knowledgebase/disable-emojis-wordpress/#disable-emojis-code
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
* Filter function used to remove the tinymce emoji plugin.
*
* @param array $plugins
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}
