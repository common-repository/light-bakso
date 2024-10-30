<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.mahafuzur.tk
 * @since      1.0.0
 *
 * @package    Lightbakso
 * @subpackage Lightbakso/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Lightbakso
 * @subpackage Lightbakso/admin
 * @author     Md. Mahafuzur Rahaman <mahafuzurrahama1986@gmail.com>
 */
class Lightbakso_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version     = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/lightbakso-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/lightbakso-admin.js', array('jquery'), $this->version, true);

    }

    /**
     * Register the custom post type
     *
     * @since    1.0.0
     */
    public function lightbakso_post_type()
    {

        $labels = array(
            'name'                  => _x('Light Bakso', 'Post Type General Name', 'light-bakso'),
            'singular_name'         => _x('Light Bakso', 'Post Type Singular Name', 'light-bakso'),
            'menu_name'             => __('LightBakso', 'light-bakso'),
            'name_admin_bar'        => __('LightBakso', 'light-bakso'),
            'archives'              => __('LightBakso Archives', 'light-bakso'),
            'attributes'            => __('LightBakso Attributes', 'light-bakso'),
            'parent_item_colon'     => __('Parent Item:', 'light-bakso'),
            'all_items'             => __('All Slides', 'light-bakso'),
            'add_new_item'          => __('Add New Slide', 'light-bakso'),
            'add_new'               => __('Add New Slide', 'light-bakso'),
            'new_item'              => __('New Carousel', 'light-bakso'),
            'edit_item'             => __('Edit Carousel', 'light-bakso'),
            'update_item'           => __('Update Carousel', 'light-bakso'),
            'view_item'             => __('View Carousel', 'light-bakso'),
            'view_items'            => __('View Carousel', 'light-bakso'),
            'search_items'          => __('Search Carousel', 'light-bakso'),
            'not_found'             => __('Not found', 'light-bakso'),
            'not_found_in_trash'    => __('Not found in Trash', 'light-bakso'),
            'featured_image'        => __('Carousel Image', 'light-bakso'),
            'set_featured_image'    => __('Set carousel image', 'light-bakso'),
            'remove_featured_image' => __('Remove carousel image', 'light-bakso'),
            'use_featured_image'    => __('Use as carousel image', 'light-bakso'),
            'insert_into_item'      => __('Insert into item', 'light-bakso'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'light-bakso'),
            'items_list'            => __('Items list', 'light-bakso'),
            'items_list_navigation' => __('Items list navigation', 'light-bakso'),
            'filter_items_list'     => __('Filter items list', 'light-bakso'),
        );
        $args = array(
            'label'               => __('LightBakso', 'light-bakso'),
            'description'         => __('LightBakso carousel with lightbox effect', 'light-bakso'),
            'labels'              => $labels,
            'supports'            => array('title', 'thumbnail'),
            'taxonomies'          => array('post_tag'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon'           => 'dashicons-laptop',
        );
        register_post_type('lightbakso_carousel', $args);

    }

    /**
     * Custom Post Feature Image Support for slide
     *
     * @since    1.0.0
     */
    public function lightbakso_image_size()
    {
        add_theme_support('post-thumbnails');
        add_image_size('lightbakso_feature_image', 800, 800, true);

    }

    /**
     * Generate the settings page menu item
     *
     * @since    1.0.0
     */
    public function lightbakso_create_menu()
    {

        $page_title = 'Lightbakso Settings';
        $menu_title = 'Settings';
        $capability = 'manage_options';
        $parent     = 'edit.php?post_type=lightbakso_carousel';
        $slug       = 'lightbakso_settings';
        $callback   = array($this, 'lightbakso_settings_page');
        add_submenu_page($parent, $page_title, $menu_title, $capability, $slug, $callback);
        add_action('admin_init', array($this, 'register_lightbakso_settings'));
    }
    /**
     * Register the settings for custom settings for plugin
     *
     * @since    1.0.0
     */
    public function register_lightbakso_settings()
    {
        register_setting('lightbakso-settings-group', 'lightbakso_options');

    }

    /**
     * Generate markup of settings page and it's field
     *
     * @since    1.0.0
     */
    public function lightbakso_settings_page()
    {
        ?>
        <div class="wrap">
            <h1>Lightbakso Settings</h1>
            <p>Manage your lightbakso carousel settings, from this page.</p>
            <?php settings_errors();?>
            <form id="lightbakso_settings_form" method="post" action="options.php">
                <h3>General Slider Settings</h3>
                <?php settings_fields('lightbakso-settings-group');?>
                <?php do_settings_sections('lightbakso-settings-group');?>

                <?php $options = get_option('lightbakso_options');?>

                <?php //print_r($options);?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_numberofitems"><?php echo __('Number of items (Default)', 'light-bakso') ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_numberofitems" type="number" name="lightbakso_options[lightbakso_numberofitems]" value="<?php echo esc_attr($options['lightbakso_numberofitems']); ?>" />
                            <p class="description">The number of items you want to see on the screen.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_numberofitems_tablet"><?php echo __('Number of items (Tablet)', 'light-bakso') ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_numberofitems_tablet" type="number" name="lightbakso_options[lightbakso_numberofitems_tablet]" value="<?php echo esc_attr($options['lightbakso_numberofitems_tablet']); ?>" />
                            <p class="description">The number of items you want to see on the tablet screen.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_numberofitems_mobile"><?php echo __('Number of items (Mobile)', 'light-bakso') ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_numberofitems_mobile" type="number" name="lightbakso_options[lightbakso_numberofitems_mobile]" value="<?php echo esc_attr($options['lightbakso_numberofitems_mobile']); ?>" />
                            <p class="description">The number of items you want to see on the mobile screen.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_margin"><?php echo __('Margin', 'light-bakso') ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_margin" type="number" name="lightbakso_options[lightbakso_margin]" value="<?php echo esc_attr($options['lightbakso_margin']); ?>" /> px
                            <p class="description">Right margin of each item</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_loop"><?php echo __('Loop', 'light-bakso') ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_loop" type="radio" name="lightbakso_options[lightbakso_loop]" <?php echo esc_attr($options['lightbakso_loop']) == 'true' ? 'checked' : ''; ?> value="true" >Yes
                            <input id="lightbakso_loop" type="radio" name="lightbakso_options[lightbakso_loop]" <?php echo esc_attr($options['lightbakso_loop']) == 'false' ? 'checked' : ''; ?> value="false" >No
                            <p class="description">Infinity loop. Duplicate last and first items to get loop illusion.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_centeritems"><?php echo __('Center Items', 'light-bakso'); ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_centeritems" type="radio" name="lightbakso_options[lightbakso_centeritems]" <?php echo esc_attr($options['lightbakso_centeritems']) == 'true' ? 'checked' : ''; ?> value="true" >Yes
                            <input id="lightbakso_centeritems" type="radio" name="lightbakso_options[lightbakso_centeritems]" <?php echo esc_attr($options['lightbakso_centeritems']) == 'false' ? 'checked' : ''; ?> value="false" >No
                            <p class="description">Center item. Works well with even an odd number of items.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_navigation"><?php echo __('Navigation', 'light-bakso'); ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_navigation" type="radio" name="lightbakso_options[lightbakso_navigation]" <?php echo esc_attr($options['lightbakso_navigation']) == 'true' ? 'checked' : ''; ?> value="true" >Yes
                            <input id="lightbakso_navigation" type="radio" name="lightbakso_options[lightbakso_navigation]" <?php echo esc_attr($options['lightbakso_navigation']) == 'false' ? 'checked' : ''; ?> value="false" >No
                            <p class="description">Show next/prev buttons.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_rewindtheslide"><?php echo __('Rewind the slide', 'light-bakso'); ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_rewindtheslide" type="radio" name="lightbakso_options[lightbakso_rewindtheslide]" <?php echo esc_attr($options['lightbakso_rewindtheslide']) == 'true' ? 'checked' : ''; ?> value="true" >Yes
                            <input id="lightbakso_rewindtheslide" type="radio" name="lightbakso_options[lightbakso_rewindtheslide]" <?php echo esc_attr($options['lightbakso_rewindtheslide']) == 'false' ? 'checked' : ''; ?> value="false" >No
                            <p class="description">Go backwards when the boundary has reached.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_dotnavigation"><?php echo __('Dot navigation', 'light-bakso'); ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_dotnavigation" type="radio" name="lightbakso_options[lightbakso_dotnavigation]" <?php echo esc_attr($options['lightbakso_dotnavigation']) == 'true' ? 'checked' : ''; ?> value="true" >Yes
                            <input id="lightbakso_dotnavigation" type="radio" name="lightbakso_options[lightbakso_dotnavigation]" <?php echo esc_attr($options['lightbakso_dotnavigation']) == 'false' ? 'checked' : ''; ?> value="false" >No
                            <p class="description">Show dots navigation.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_dotsforeachitem"><?php echo __('Dots for each item', 'light-bakso'); ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_dotsforeachitem" type="radio" name="lightbakso_options[lightbakso_dotsforeachitem]" <?php echo esc_attr($options['lightbakso_dotsforeachitem']) == 'true' ? 'checked' : ''; ?> value="true" >Yes
                            <input id="lightbakso_dotsforeachitem" type="radio" name="lightbakso_options[lightbakso_dotsforeachitem]" <?php echo esc_attr($options['lightbakso_dotsforeachitem']) == 'false' ? 'checked' : ''; ?> value="false" >No
                            <p class="description">Show dots each x item.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_autoplay"><?php echo __('Auto Play', 'light-bakso'); ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_autoplay" type="radio" name="lightbakso_options[lightbakso_autoplay]" <?php echo esc_attr($options['lightbakso_autoplay']) == 'true' ? 'checked' : ''; ?> value="true" >Yes
                            <input id="lightbakso_autoplay" type="radio" name="lightbakso_options[lightbakso_autoplay]" <?php echo esc_attr($options['lightbakso_autoplay']) == 'false' ? 'checked' : ''; ?> value="false" >No
                            <p class="description">Autoplay the slide.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_autopalyspeed"><?php echo __('Autoplay speed', 'light-bakso') ?></label>
                        </th>
                        <td>
                            <input id="lightbakso_autopalyspeed" type="number" name="lightbakso_options[lightbakso_autopalyspeed]" value="<?php echo esc_attr($options['lightbakso_autopalyspeed']); ?>" />
                            <p class="description">Autoplay Speed.</p>
                        </td>
                    </tr>
                </table>
                <hr>
                <h3>Custom CSS</h3>
                <table class="form-table custom_css">
                    <tr valign="top">
                        <th>
                            <label for="lightbakso_margin_top"><?php echo __('Container Margin', 'light-bakso') ?></label>
                        </th>
                        <td colspan="3">
                            <input id="lightbakso_margin_checkbox" type="checkbox" name="lightbakso_options[lightbakso_margin_checkbox]" <?php checked(1, empty($options['lightbakso_margin_checkbox']) ? 0 : 1);?> value="1" />
                            <label for="lightbakso_margin_checkbox"> All same value.</label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <input class="same_margin" id="lightbakso_margin_top" type="number" name="lightbakso_options[lightbakso_margin_top]" value="<?php echo esc_attr($options['lightbakso_margin_top']); ?>" /> px
                            <p class="description">margin Top.</p>
                        </td>
                        <td>
                            <input class="same_margin" id="lightbakso_margin_right" type="number" name="lightbakso_options[lightbakso_margin_right]" value="<?php echo esc_attr($options['lightbakso_margin_right']); ?>" /> px
                            <p class="description">margin Right.</p>
                        </td>
                        <td>
                            <input class="same_margin" id="lightbakso_margin_bottom" type="number" name="lightbakso_options[lightbakso_margin_bottom]" value="<?php echo esc_attr($options['lightbakso_margin_bottom']); ?>" /> px
                            <p class="description">margin Bottom.</p>
                        </td>
                        <td>
                            <input class="same_margin" id="lightbakso_margin_left" type="number" name="lightbakso_options[lightbakso_margin_left]" value="<?php echo esc_attr($options['lightbakso_margin_left']); ?>" /> px
                            <p class="description">margin Left.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>
                            <label for="lightbakso_padding_top"><?php echo __('Container Padding', 'light-bakso') ?></label>
                        </th>
                        <td colspan="3">
                            <input id="lightbakso_padding_checkbox" type="checkbox" name="lightbakso_options[lightbakso_padding_checkbox]" <?php checked(1, empty($options['lightbakso_padding_checkbox']) ? 0 : 1);?> value="1" />
                            <label for="lightbakso_padding_checkbox"> All same value.</label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <input class="same_padding" id="lightbakso_padding_top" type="number" name="lightbakso_options[lightbakso_padding_top]" value="<?php echo esc_attr($options['lightbakso_padding_top']); ?>" /> px
                            <p class="description">padding Top.</p>
                        </td>
                        <td>
                            <input class="same_padding" id="lightbakso_padding_right" type="number" name="lightbakso_options[lightbakso_padding_right]" value="<?php echo esc_attr($options['lightbakso_padding_right']); ?>" /> px
                            <p class="description">padding Right.</p>
                        </td>
                        <td>
                            <input class="same_padding" id="lightbakso_padding_bottom" type="number" name="lightbakso_options[lightbakso_padding_bottom]" value="<?php echo esc_attr($options['lightbakso_padding_bottom']); ?>" /> px
                            <p class="description">padding Bottom.</p>
                        </td>
                        <td>
                            <input class="same_padding" id="lightbakso_padding_left" type="number" name="lightbakso_options[lightbakso_padding_left]" value="<?php echo esc_attr($options['lightbakso_padding_left']); ?>" /> px
                            <p class="description">padding Left.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_background"><?php echo __('Container Background Color', 'light-bakso') ?></label>
                        </th>
                        <td scope="row" colspan="4">
                            <input id="lightbakso_background" type="color" name="lightbakso_options[lightbakso_background]" value="<?php echo esc_attr($options['lightbakso_background']); ?>" />
                            <p class="description">Choose your gallery background color.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="lightbakso_fullwidth"><?php echo __('Full Width', 'light-bakso') ?></label>
                        </th>
                        <td colspan="3">
                            <input id="lightbakso_fullwidth" type="radio" name="lightbakso_options[lightbakso_fullwidth]" <?php echo esc_attr($options['lightbakso_fullwidth']) == 'true' ? 'checked' : ''; ?> value="true" >Yes
                            <input id="lightbakso_fullwidth" type="radio" name="lightbakso_options[lightbakso_fullwidth]" <?php echo esc_attr($options['lightbakso_fullwidth']) == 'false' ? 'checked' : ''; ?> value="false" >No
                            <p class="description">If you want full width slider, then please choose 'Yes'.</p>
                        </td>
                    </tr>
                </table>
                <?php submit_button();?>
            </form>
        </div>
        <?php
}

    /**
     * Create a custom css field in theme customizer
     * This option give user to set custom css for lightbakso plugin
     *
     * @since    1.0.0
     */
    public function lightbakso_custom_css($wp_customize)
    {
        //Add custom css setting and control.
        $wp_customize->add_setting('lightbakso_options[lightbakso_custom_css]', array(
            'default'           => sprintf("/*\n%s\n*/", __("You can add your own lightbakso custom CSS here.", 'light-bakso')),
            'section'           => 'custom_css',
            'sanitize_callback' => 'sanitize_textarea_field',
            'type'              => 'option',
        ));

        //Add custom css setting and control.
        $wp_customize->add_control('lightbakso_custom_css', array(
            'label'       => esc_html__('Lightbakso Custom CSS', 'light-bakso'),
            'type'        => 'textarea',
            'section'     => 'custom_css',
            'settings'    => 'lightbakso_options[lightbakso_custom_css]',
            'input_attrs' => array(
                'class' => 'code',
            ),
        ));
    }

    /**
     * Sanitization for input field
     *
     * @since    1.0.0
     */
    public function lightbakso_sanitize_css($input)
    {
        return wp_strip_all_tags($input);
    }



}