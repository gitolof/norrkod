<?php

define( 'DOING_AJAX', true );
if ( ! defined( 'WP_ADMIN' ) ) {
	define( 'WP_ADMIN', true );
}

/** Load WordPress Bootstrap */
require_once 'wp-load.php';

/** Allow for cross-domain requests (from the front end). */
send_origin_headers();

header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
header( 'X-Robots-Tag: noindex' );

// Require an action parameter.
if ( empty( $_REQUEST['action'] ) ) {
	wp_die( '0', 400 );
}

$action = ( isset( $_REQUEST['action'] ) ) ? $_REQUEST['action'] : '';

require_once get_template_directory() . '/vendor/core/class-loader.php';

$process_file = PQ_Loader::load_process_file( $action );

if ( !file_exists( $process_file ) )
{
  wp_die( '0', 400 );
}

include_once $process_file;

wp_die( '0' );
