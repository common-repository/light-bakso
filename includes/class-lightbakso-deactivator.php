<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.mahafuzur.tk
 * @since      1.0.0
 *
 * @package    Lightbakso
 * @subpackage Lightbakso/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Lightbakso
 * @subpackage Lightbakso/includes
 * @author     Md. Mahafuzur Rahaman <mahafuzurrahama1986@gmail.com>
 */
class Lightbakso_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		  flush_rewrite_rules();

	}

}
