<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.mahafuzur.tk
 * @since      1.0.0
 *
 * @package    Lightbakso
 * @subpackage Lightbakso/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lightbakso
 * @subpackage Lightbakso/includes
 * @author     Md. Mahafuzur Rahaman <mahafuzurrahama1986@gmail.com>
 */
class Lightbakso_Activator
{

    /**
     * Set all the default option when user first time active the plugin
     *
     * @since    1.0.0
     */
    public static function activate()
    {

        // Plugin all default options
        $options = array(

            array(
                'name'          => 'lightbakso_numberofitems',
                'default_value' => 4,
            ),
            array(
                'name'          => 'lightbakso_numberofitems_tablet',
                'default_value' => 3,
            ),
            array(
                'name'          => 'lightbakso_numberofitems_mobile',
                'default_value' => 1,
            ),
            array(
                'name'          => 'lightbakso_margin',
                'default_value' => 0,
            ),
            array(
                'name'          => 'lightbakso_loop',
                'default_value' => 'true',
            ),
            array(
                'name'          => 'lightbakso_centeritems',
                'default_value' => 'true',
            ),
            array(
                'name'          => 'lightbakso_navigation',
                'default_value' => 'false',
            ),
            array(
                'name'          => 'lightbakso_rewindtheslide',
                'default_value' => 'true',
            ),
            array(
                'name'          => 'lightbakso_dotnavigation',
                'default_value' => 'true',
            ),
            array(
                'name'          => 'lightbakso_dotsforeachitem',
                'default_value' => 'true',
            ),
            array(
                'name'          => 'lightbakso_autoplay',
                'default_value' => 'true',
            ),
            array(
                'name'          => 'lightbakso_autopalyspeed',
                'default_value' => 250,
            ),
            array(
                'name'          => 'lightbakso_margin_checkbox',
                'default_value' => 0,
            ),
            array(
                'name'          => 'lightbakso_margin_top',
                'default_value' => '',
            ),
            array(
                'name'          => 'lightbakso_margin_right',
                'default_value' => '',
            ),
            array(
                'name'          => 'lightbakso_margin_bottom',
                'default_value' => '',
            ),
            array(
                'name'          => 'lightbakso_margin_left',
                'default_value' => '',
            ),
            array(
                'name'          => 'lightbakso_padding_top',
                'default_value' => '',
            ),
            array(
                'name'          => 'lightbakso_padding_right',
                'default_value' => '',
            ),
            array(
                'name'          => 'lightbakso_padding_bottom',
                'default_value' => '',
            ),
            array(
                'name'          => 'lightbakso_padding_left',
                'default_value' => '',
            ),
            array(
                'name'          => 'lightbakso_background',
                'default_value' => '#ffffff',
            ),
            array(
                'name'          => 'lightbakso_fullwidth',
                'default_value' => 'false',
            ),
            array(
                'name'          => 'lightbakso_custom_css',
                'default_value' => '',
            ),

        );

        $lightbakso_options = get_option('lightbakso_options');

        if ($lightbakso_options == false) {

            $defaults = array();

            foreach ($options as $options_data) {

                $defaults[$options_data['name']] = $options_data['default_value'];

            }

            update_option('lightbakso_options', $defaults, true);

        }

        flush_rewrite_rules();
    }

}
