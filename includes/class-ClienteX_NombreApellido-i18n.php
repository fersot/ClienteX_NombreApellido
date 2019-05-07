<?php

class ClienteX_NombreApellido_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ClienteX_NombreApellido',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
