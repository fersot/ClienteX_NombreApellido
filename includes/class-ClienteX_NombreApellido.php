<?php

class ClienteX_NombreApellido
{
    public static function get_plugin_option($option)
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_settings";
        $option = $wpdb->get_results('SELECT * FROM ' . $nombreTabla . ' WHERE config = "' . $option . '"');
        return $option[0]->value;
    }

    public static function get_leads()
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_leads";
        $leads = $wpdb->get_results('SELECT * FROM ' . $nombreTabla);
        return $leads;
    }

    public static function set_plugin_option($option, $value)
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_settings";
        $wpdb->update($nombreTabla, array('value' => $value), array('config' => $option), array('%s'), array('%s'));
    }
}
