<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

class ClienteX_NombreApellido_Activator
{

    public static function activate()
    {
        self::create_leads_table();
        self::create_settings_table();
    }

    public static function create_leads_table()
    {

        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_leads";

        dbDelta(
            "CREATE TABLE $nombreTabla (
            ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            name varchar(60) NOT NULL DEFAULT '',
            email varchar(64) NOT NULL DEFAULT '',
            gender char(1) NOT NULL DEFAULT '',
            PRIMARY KEY (ID)
          ) CHARACTER SET utf8 COLLATE utf8_general_ci;"
        );
    }

    public static function create_settings_table()
    {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_settings";

        dbDelta("CREATE TABLE $nombreTabla (config varchar(60) NOT NULL DEFAULT '',
            value varchar(255) DEFAULT null ) CHARACTER SET utf8 COLLATE utf8_general_ci;");

        $wpdb->insert($nombreTabla, [
            'config' => 'logo',
            'value' => null
        ]);
        $wpdb->insert($nombreTabla, [
            'config' => 'intro_form',
            'value' => 'Por favor diligencia el siguiente formulario.'
        ]);
        $wpdb->insert($nombreTabla, [
            'config' => 'thankyou',
            'value' => 'Gracias por completar el formulario.'
        ]);
    }

}
