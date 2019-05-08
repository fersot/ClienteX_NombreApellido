<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

class ClienteX_NombreApellido_Activator
{
    public static $landigID;
    public static $thanksID;

    public static function activate()
    {
        self::create_landing();
        self::create_thankyou();
        self::create_leads_table();
        self::create_settings_table();
    }

    public static function create_landing()
    {
        $landing = array(
            'post_name' => 'leads-cliente-x',
            'post_title' => 'leads',
            'post_content' => '[form_cliente_x]',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'page',
        );
        self::$landigID = wp_insert_post($landing);
    }

    public static function create_thankyou()
    {
        $landing = array(
            'post_name' => 'gracias-cliente-x',
            'post_title' => 'gracias',
            'post_content' => 'content',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'page',
        );
        self::$thanksID = wp_insert_post($landing);
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
        $wpdb->insert($nombreTabla, [
            'config' => 'thankyou_id',
            'value' => self::$thanksID
        ]);
        $wpdb->insert($nombreTabla, [
            'config' => 'landing_id',
            'value' => self::$landigID
        ]);
    }

}
