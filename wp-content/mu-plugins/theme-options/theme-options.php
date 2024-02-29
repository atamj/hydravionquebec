<?php
/*
Plugin Name: Theme Options
Description: Creates an options page for theme settings.
*/



add_action('acf/init', function() {

	// Check function exists.
	if( function_exists('acf_add_options_page') ) {

		// Register options page.
		$option_page = acf_add_options_page(array(
			'page_title'    => __('Theme General Settings'),
			'menu_title'    => __('Theme Settings'),
			'menu_slug'     => 'theme-general-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));
	}
});

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key' => 'group_64cbdc3d31b4d',
		'title' => 'Theme options',
		'fields' => array(
			array(
				'key' => 'field_64cbdc3d783d0',
				'label' => 'Logo light',
				'name' => 'logo_light',
				'aria-label' => '',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'preview_size' => 'medium',
			),
			array(
				'key' => 'field_64cbdc59783d1',
				'label' => 'Logo dark',
				'name' => 'logo_dark',
				'aria-label' => '',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'preview_size' => 'medium',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-general-settings',
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
		'show_in_rest' => 0,
	) );
} );

