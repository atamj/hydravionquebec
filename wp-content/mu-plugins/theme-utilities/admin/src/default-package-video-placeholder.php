<?php


add_settings_field(
	'theme_utilities_package_video_placeholder',
	__('Default Package Video Placeholder (Vimeo ID)', self::SETTINGS_NAMESPACE),
	function () {
		render_text_field(
			[
				'field_id' => 'theme_utilities_package_video_placeholder',
				'field_value' => get_option('theme_utilities_package_video_placeholder')
			],
			'',
			'theme_utilities_package_video_placeholder'
		);
	},
	self::SETTINGS_MENU_SLUG,
	'theme_utilities_section'
);

register_setting(self::SETTINGS_MENU_SLUG, 'theme_utilities_package_video_placeholder');