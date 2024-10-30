<?php

/**
 *
 * @link       http://www.mahafuzur.tk
 * @since      1.0.0
 *
 * @package    Lightbakso
 * @subpackage Lightbakso/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Lightbakso
 * @subpackage Lightbakso/includes
 * @author     Md. Mahafuzur Rahaman <mahafuzurrahama1986@gmail.com>
 */
class Lightbakso_i18n
{

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'light-bakso',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );

    }

}
