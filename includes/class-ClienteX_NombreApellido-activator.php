<?php
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

class ClienteX_NombreApellido_Activator {

	public static function activate() {
        self::db_plugin_sample();
	}

   public static function db_plugin_sample() {

        global $wpdb;
        $nombreTabla = $wpdb->prefix . "demotabla";

        $created = dbDelta(
            "CREATE TABLE $nombreTabla (
      ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      nombre varchar(60) NOT NULL DEFAULT '',
      email varchar(64) NOT NULL DEFAULT '',
      url varchar(100) NOT NULL DEFAULT '',
      PRIMARY KEY (ID),
      KEY email (email)
    ) CHARACTER SET utf8 COLLATE utf8_general_ci;"
        );
    }

}
