<?php

/**
 *
 * @link              http://hembercolmenares.info
 * @since             1.0.0
 * @package           ClienteX_NombreApellido
 *
 * @wordpress-plugin
 * Plugin Name:       ClienteX_NombreApellido
 * Plugin URI:        http://hembercolmenares.info
 * Description:       Este plugin es una prueba de la candidatura en el puesto de desarrollador en GradiWeb.
 * Version:           1.0.0
 * Author:            Hember Colmenares
 * Author URI:        http://hembercolmenares.info
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ClienteX_NombreApellido
 * Domain Path:       /
 */

// si el archivo es llamado directamente se aborta.

if ( ! defined( 'WPINC' ) ) {
	die;
}
add_action("admin_menu", "crear_menu");
function crear_menu() {
    add_menu_page('Listado', 'Leads ClienteX', 'manage_options', 'leads_cliente_x', 'output_menu');
    add_submenu_page('leads_cliente_x', 'Settings Leads ClienteX', 'Settings', 'manage_options', 'leads_cliente_x_settings', 'output_menu');

}
function output_menu() {
    ?>
    <h1>Aquí va el listado de registros</h1>
    <?php
}




/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_ClienteX_NombreApellido() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ClienteX_NombreApellido-activator.php';
    ClienteX_NombreApellido_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ClienteX_NombreApellido-deactivator.php
 */
function deactivate_ClienteX_NombreApellido() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ClienteX_NombreApellido-deactivator.php';
    ClienteX_NombreApellido_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ClienteX_NombreApellido' );
register_deactivation_hook( __FILE__, 'deactivate_ClienteX_NombreApellido' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ClienteX_NombreApellido.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ClienteX_NombreApellido() {

	$plugin = new ClienteX_NombreApellido();
	$plugin->run();

}
run_ClienteX_NombreApellido();
