<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              http://www.mahafuzur.tk
 * @since             1.0.0
 * @package           Lightbakso
 *
 * @wordpress-plugin
 * Plugin Name:       Light Bakso
 * Plugin URI:        http://mahafuzur.tk/projects/lightbakso/lightbakso.html
 * Description:       This is a wordpress carousel slider with lightbox effect,
 * Version:           1.0.1
 * Author:            Md. Mahafuzur Rahaman
 * Author URI:        http://www.mahafuzur.tk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       light-bakso
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'LIGHTBAKSO_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lightbakso-activator.php
 */
function activate_lightbakso() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lightbakso-activator.php';
	Lightbakso_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lightbakso-deactivator.php
 */
function deactivate_lightbakso() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lightbakso-deactivator.php';
	Lightbakso_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lightbakso' );
register_deactivation_hook( __FILE__, 'deactivate_lightbakso' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lightbakso.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_lightbakso() {

	$plugin = new Lightbakso();
	$plugin->run();

}
run_lightbakso();
