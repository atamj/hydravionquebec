<?php

add_filter('post_thumbnail_id', 'filter_thumbnail_id', 10, 2);

function filter_thumbnail_id($thumbnail_id, $post)
{
	if ($thumbnail_id):
		return $thumbnail_id;
	endif;

	if (get_option('theme_utilities_img_placeholder')):
		return get_option('theme_utilities_img_placeholder');
	endif;

	return false;
}




