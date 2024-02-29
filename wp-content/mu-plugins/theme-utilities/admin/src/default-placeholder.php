<?php


add_settings_field(
	'theme_utilities_img_placeholder',
	__('Default Image Placeholder', self::SETTINGS_NAMESPACE),
	function () {
		render_image_field(
			[
				'field_id' => 'theme_utilities_img_placeholder',
				'field_value' => get_option('theme_utilities_img_placeholder')
			],
			'',
			'theme_utilities_img_placeholder'
		);
	},
	self::SETTINGS_MENU_SLUG,
	'theme_utilities_section'
);

register_setting(self::SETTINGS_MENU_SLUG, 'theme_utilities_img_placeholder');