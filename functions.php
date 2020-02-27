<?php
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'uxmexico_register_required_plugins' );

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

add_theme_support( 'post-thumbnails' );

// Add ACF Fields
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

add_action('acf/init', 'uxmexico_acf_add_local_field_groups');
