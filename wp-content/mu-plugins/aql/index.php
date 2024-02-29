<?php
namespace AdvancedQueryLoop;

// Some helpful constants.
define( 'BUILD_DIR_PATH', plugin_dir_path( __FILE__ ) . 'build/' );
define( 'BUILD_DIR_URL', plugin_dir_url( __FILE__ ) . 'build/' );

// Require some files.
require_once __DIR__ . '/includes/enqueues.php';
require_once __DIR__ . '/includes/query-loop.php';

