<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

class ClienteX_NombreApellido_Deactivator
{

    public static function deactivate()
    {
        self::drop_pages();
        self::drop_leads_table();
        self::drop_settings_table();

    }

    public static function drop_pages()
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_settings";
        $landing = $wpdb->get_results('SELECT * FROM ' . $nombreTabla . ' WHERE config = "landing_id"');
        $thankyou = $wpdb->get_results('SELECT * FROM ' . $nombreTabla . ' WHERE config = "thankyou_id"');
        wp_delete_post($thankyou[0]->value, true);
        wp_delete_post($landing[0]->value, true);
    }

    public static function drop_leads_table()
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_leads";
        $wpdb->query('DROP TABLE IF EXISTS ' . $nombreTabla);
    }

    public static function drop_settings_table()
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_settings";
        $wpdb->query('DROP TABLE IF EXISTS ' . $nombreTabla);
    }

}
