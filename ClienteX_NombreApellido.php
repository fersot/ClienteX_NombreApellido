<?php

/**
 *
 * @link              http://hembercolmenares.info
 * @since             1.0.0
 * @package           ClienteX_NombreApellido
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

if (!defined('WPINC')) {
    die;
}
add_action("admin_menu", "crear_menu");
function crear_menu()
{
    add_menu_page('Listado', 'Leads ClienteX', 'manage_options', 'leads_cliente_x', 'listado');
    add_submenu_page('leads_cliente_x', 'Settings Leads ClienteX', 'Settings', 'manage_options', 'leads_cliente_x_settings', 'configuracion');

}

function listado()
{
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <br><br>
    <div class="col-md-12">
        <h3>Todos los registros obtenidos del formulario</h3>
    </div>
    <br><br>
    <div class="col-md-12">
        <table style="width: 100% !important;" class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Genero</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Hember Colmenares</td>
                <td>hemberfer@gmail.com</td>
                <td>Masculino</td>
            </tr>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <?php
}

function configuracion()
{
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <br><br>
    <div class="col-md-12">
        <h3>Configuración del Plugin</h3>
    </div>
    <br><br>
    <div class="col-md-12">

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <?php
}

define('PLUGIN_NAME_VERSION', '1.0.0');

function activate_ClienteX_NombreApellido()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-ClienteX_NombreApellido-activator.php';
    ClienteX_NombreApellido_Activator::activate();
}

function deactivate_ClienteX_NombreApellido()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-ClienteX_NombreApellido-deactivator.php';
    ClienteX_NombreApellido_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_ClienteX_NombreApellido');
register_deactivation_hook(__FILE__, 'deactivate_ClienteX_NombreApellido');

require plugin_dir_path(__FILE__) . 'includes/class-ClienteX_NombreApellido.php';

function run_ClienteX_NombreApellido()
{

    $plugin = new ClienteX_NombreApellido();
    $plugin->run();

}

run_ClienteX_NombreApellido();