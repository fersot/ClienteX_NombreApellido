<?php

// informacion que obtiene wordpress para mostrar

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
// instanciar la clase
require plugin_dir_path(__FILE__) . 'includes/class-ClienteX_NombreApellido.php';

add_action("admin_menu", "crear_menu");

add_action('wp_loaded', 'submit_form');

function submit_form()
{
    if (isset($_POST['cf-submitted'])) {
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "WPNombreAppellido_leads";
        $wpdb->insert($nombreTabla, [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'gender' => $_POST['gender'],
            'year' => $_POST['year']
        ]);
        wp_redirect('/gracias-cliente-x');
        exit;
    }
}

function html_form()
{
    echo '<img id="image-preview" src="' . wp_get_attachment_url(ClienteX_NombreApellido::get_plugin_option('logo')) . '" style="width: 100px; align-content: center">';
    echo '<h4>' . ClienteX_NombreApellido::get_plugin_option('intro_form') . '</h4>';
    echo '<style>
            .own-input-text {
                height: 47px !important;
                border: #f5eff0 1px solid !important;
                border-radius: 15px !important;
                margin: 10px !important;
                font-family: Bahnschrift;
             }
          </style>';
    echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">';
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nombre Completo</label>
                <input type="text" name="name" required class="form-control" placeholder="Ingrese su Nombre Completo">
                <label>Correo Electrónico</label>
                <input type="email" name="email" required class="form-control" placeholder="Ingrese su Correo">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Genero</label>
                <select class="form-control" required name="gender">
                    <option value="">Selecciona un género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <label for="">Edad</label>
                <input type="number" name="year" required class="form-control" placeholder="Ingrese su Edad">
            </div>
        </div>
    </div>


    <p><input type="submit" class="btn btn-primary" name="cf-submitted" value="Enviar"></p>
    </form>
    <?php
}

function html_gracias()
{
    echo '<h2>' . ClienteX_NombreApellido::get_plugin_option('thankyou') . '</h2>';
}

function form_shortcode()
{
    ob_start();
    submit_form();
    html_form();
    return ob_get_clean();
}

function gracias_shortcode()
{
    ob_start();
    html_gracias();
    return ob_get_clean();
}

add_shortcode('form_cliente_x', 'form_shortcode');

add_shortcode('gracias_cliente_x', 'gracias_shortcode');

function crear_menu()
{
    add_menu_page('Listado', 'Leads ClienteX', 'manage_options', 'leads_cliente_x', 'listado');
    add_submenu_page('leads_cliente_x', 'Settings Leads ClienteX', 'Settings', 'manage_options', 'leads_cliente_x_settings', 'configuracion');
}

function listado()
{
    $leads = ClienteX_NombreApellido::get_leads();
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <div class="card col-md-11">
        <div class="card-heading">Todos los registros obtenidos del formulario</div>
        <div class="card-body">
            <div class="col-md-12">
                <table style="width: 100% !important;" class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Genero</th>
                        <th>Edad</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($leads as $lead) {
                        echo '<tr>';
                        echo '<td>' . $lead->name . '</td>';
                        echo '<td>' . $lead->email . '</td>';
                        if ($lead->gender === "M") {
                            echo '<td>Masculino</td>';
                        } else {
                            echo '<td>Femenino</td>';
                        }
                        echo '<td>' . $lead->year . ' Años</td>';
                        echo '</tr>';
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    if (isset($_POST['submit_image_selector']) && isset($_POST['image_attachment_id'])) {
        update_option('media_selector_attachment_id', absint($_POST['image_attachment_id']));
        ClienteX_NombreApellido::set_plugin_option('logo', absint($_POST['image_attachment_id']));
        ClienteX_NombreApellido::set_plugin_option('intro_form', $_POST['intro_form']);
        ClienteX_NombreApellido::set_plugin_option('thankyou', $_POST['thankyou']);
    }
    wp_enqueue_media();

    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <div class="card col-md-11">
        <div class="card-heading">Configuracion del Plugin</div>

        <div class="card-body">
            <form method="post">
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="intro">Texto de introducción del formulario</label>
                                <input type="text" class="form-control" id="intro"
                                       value="<?php echo ClienteX_NombreApellido::get_plugin_option('intro_form') ?>"
                                       name="intro_form" placeholder="texto de introducción del formulario">
                            </div>
                            <div class="form-group">
                                <label for="thanks">Texto de Agradecimiento</label>
                                <input type="text" class="form-control" id="thanks"
                                       value="<?php echo ClienteX_NombreApellido::get_plugin_option('thankyou') ?>"
                                       name="thankyou" placeholder="texto de agradecimiento">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Logo que se mostrará en el formulario</label>
                            <div class='image-preview-wrapper'>
                                <img id='image-preview'
                                     src='<?php echo wp_get_attachment_url(ClienteX_NombreApellido::get_plugin_option('logo')); ?>'
                                     style="width: 100px; align-content: center">
                            </div>
                            <input id="upload_image_button" type="button" class="button" value="Subir Imagen"/>
                            <input type='hidden' name='image_attachment_id' id='image_attachment_id'
                                   value='<?php echo ClienteX_NombreApellido::get_plugin_option('logo'); ?>'>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="submit_image_selector" value="Guardar Cambios"
                                   style="float: right"
                                   class="button-primary">
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <?php
}

add_action('admin_footer', 'media_selector_print_scripts');

function media_selector_print_scripts()
{
    $my_saved_attachment_post_id = get_option('media_selector_attachment_id', 0);
    ?>
    <script type='text/javascript'>
        jQuery(document).ready(function ($) {
            // Uploading files
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
            var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
            jQuery('#upload_image_button').on('click', function (event) {
                event.preventDefault();
                // If the media frame already exists, reopen it.
                if (file_frame) {
                    // Set the post ID to what we want
                    file_frame.uploader.uploader.param('post_id', set_to_post_id);
                    // Open frame
                    file_frame.open();
                    return;
                } else {
                    // Set the wp.media post id so the uploader grabs the ID we want when initialised
                    wp.media.model.settings.post.id = set_to_post_id;
                }
                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Select a image to upload',
                    button: {
                        text: 'Use this image',
                    },
                    multiple: false	// Set to true to allow multiple files to be selected
                });
                // When an image is selected, run a callback.
                file_frame.on('select', function () {
                    // We set multiple to false so only get one image from the uploader
                    attachment = file_frame.state().get('selection').first().toJSON();
                    // Do something with attachment.id and/or attachment.url here
                    $('#image-preview').attr('src', attachment.url).css('width', 'auto');
                    $('#image_attachment_id').val(attachment.id);
                    // Restore the main post ID
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
                // Finally, open the modal
                file_frame.open();
            });
            // Restore the main ID when the add media button is pressed
            jQuery('a.add_media').on('click', function () {
                wp.media.model.settings.post.id = wp_media_post_id;
            });
        });
    </script><?php
}

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
