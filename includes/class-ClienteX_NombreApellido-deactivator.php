<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

class ClienteX_NombreApellido_Deactivator {

    public static function deactivate()
    {
        self::drop_leads_table();
        self::drop_settings_table();
    }

    public static function drop_leads_table()
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_leads";
        $wpdb->query( 'DROP TABLE IF EXISTS ' . $nombreTabla );
    }
    public static function drop_settings_table()
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_settings";
        $wpdb->query( 'DROP TABLE IF EXISTS ' . $nombreTabla );
    }

}
