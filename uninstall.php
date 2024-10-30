<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://www.mahafuzur.tk
 * @since      1.0.0
 *
 * @package    Lightbakso
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'lightbakso_carousel'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
delete_option( 'lightbakso_options' );

