<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;
$nombreTabla = $wpdb->prefix . "WPNombreAppellido_leads";
$wpdb->query( 'DROP TABLE IF EXISTS ' . $nombreTabla );
$nombreTabla = $wpdb->prefix . "WPNombreAppellido_settings";
$wpdb->query( 'DROP TABLE IF EXISTS ' . $nombreTabla );
