<?php
/**
 * Handles the filters we need to add to the query.
 *
 * @package AdvancedQueryLoop
 */

namespace AdvancedQueryLoop;

/**
 * Adds the custom query attributes to the Query Loop block.
 *
 * @param array $meta_query_data Post meta query data.
 * @return array
 */
function parse_meta_query( $meta_query_data ) {
	$meta_queries = array();
	if ( isset( $meta_query_data ) ) {
		$meta_queries = array(
			'relation' => isset( $meta_query_data['relation'] ) ? $meta_query_data['relation'] : '',
		);

		foreach ( $meta_query_data['queries'] as $query ) {
			$meta_queries[] = array_filter(
				array(
					'key'     => $query['meta_key'],
					'value'   => $query['meta_value'],
					'compare' => $query['meta_compare'],
				)
			);
		}
	}

	return array_filter( $meta_queries );
}

/**
 * Updates the query on the front end based on custom query attributes.
 */
\add_filter(
	'pre_render_block',
	function( $pre_render, $parsed_block ) {

		if ( isset( $parsed_block['attrs']['namespace'] ) && 'advanced-query-loop' === $parsed_block['attrs']['namespace'] ) {
			\add_filter(
				'query_loop_block_query_vars',
				function( $default_query ) use ( $parsed_block ) {
					$custom_query = $parsed_block['attrs']['query'];
					// Generate a new custom query will all potential query vars.
					$custom_args = array();

					// Check for meta queries.
					$custom_args['meta_query'] = parse_meta_query( $custom_query['meta_query'] ); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

                    if(!empty($custom_args['meta_query'])):
                        foreach ($custom_args['meta_query'] as $key => $meta_query) {
                            if(!empty($meta_query['value'])):
                                $custom_args['meta_query'][$key]['value'] = sanitize_meta_query_value($meta_query['value']);

                            endif;
                        }
                    endif;

					// Return the merged query.
					return array_merge(
						$default_query,
						$custom_args
					);
				},
				10,
				2
			);
		}

		return $pre_render;

	},
	10,
	2
);

/**
 * Updates the query vars for the Query Loop block in the block editor
 */

// Add a filter to each rest endpoint to add our custom query params.
\add_action(
	'init',
	function() {
		$registered_post_types = \get_post_types( array( 'public' => true ) );
		foreach ( $registered_post_types as $registered_post_type ) {
			\add_filter( 'rest_' . $registered_post_type . '_query', __NAMESPACE__ . '\add_custom_query_params', 10, 2 );
		}

	},
	PHP_INT_MAX
);

/**
 * Callback to handle the custom query params. Updates the block editor.
 *
 * @param array           $args    The query args.
 * @param WP_REST_Request $request The request object.
 */
function add_custom_query_params( $args, $request ) {
	// Generate a new custom query will all potential query vars.
	$custom_args = array();
	// Meta related.
	$meta_query                = $request->get_param( 'meta_query' );
	$custom_args['meta_query'] = parse_meta_query( $meta_query ); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query


    if(!empty($custom_args['meta_query'])):
        foreach ($custom_args['meta_query'] as $key => $meta_query) {
            if(!empty($meta_query['value'])):
                $custom_args['meta_query'][$key]['value'] = sanitize_meta_query_value($meta_query['value']);

            endif;
        }
    endif;

	// Merge all queries.
	return array_merge(
		$args,
		array_filter( $custom_args )
	);
}


function sanitize_meta_query_value($meta_query_value) {
    if (preg_match("/\[[^\]]*\]/", $meta_query_value, $matches)) {
        $bracket_content = $matches[0];
        $bracket_content = process_allowed_shortcodes($bracket_content);
        $value = str_replace($matches[0], $bracket_content, $meta_query_value);
        return wp_kses_post($value);
    } else {
        return $meta_query_value;
    }
}

function process_allowed_shortcodes($content) {
    // Define a whitelist of allowed shortcodes
    $allowed_shortcodes = [
        'today',
        // Add other allowed shortcodes here
    ];

    // Loop through allowed shortcodes and process them
    foreach ($allowed_shortcodes as $shortcode) {
        if (has_shortcode($content, $shortcode)) {
            $content = do_shortcode($content, false, $shortcode);
        }
    }

    // Remove any other shortcodes that are not allowed
    $content = strip_shortcodes($content);

    return $content;
}