<?php

class ClienteX_NombreApellido {

	protected $loader;

	protected $plugin_name;

	protected $version;


	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ClienteX_NombreApellido';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}


	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ClienteX_NombreApellido-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ClienteX_NombreApellido-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ClienteX_NombreApellido-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ClienteX_NombreApellido-public.php';
		$this->loader = new ClienteX_NombreApellido_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new ClienteX_NombreApellido_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new ClienteX_NombreApellido_Admin( $this->get_ClienteX_NombreApellido(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}


	private function define_public_hooks() {
		$plugin_public = new ClienteX_NombreApellido_Public( $this->get_ClienteX_NombreApellido(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	public function run() {
		$this->loader->run();
	}


	public function get_ClienteX_NombreApellido() {
		return $this->plugin_name;
	}


	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
