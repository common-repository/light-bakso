<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.mahafuzur.tk
 * @since      1.0.0
 *
 * @package    Lightbakso
 * @subpackage Lightbakso/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Lightbakso
 * @subpackage Lightbakso/public
 * @author     Md. Mahafuzur Rahaman <mahafuzurrahama1986@gmail.com>
 */
class Lightbakso_Public
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version     = $version;
        add_shortcode('lightbakso_carousel', array($this, 'lightbakso_carousel_sortcode'));

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        wp_enqueue_style('owl.carousel', plugin_dir_url(__FILE__) . 'lib/owlcarousel/dist/assets/owl.carousel.css');
        wp_enqueue_style('owl.theme.default', plugin_dir_url(__FILE__) . 'lib/owlcarousel/dist/assets/owl.theme.default.css');
        wp_enqueue_style('lightbox', plugin_dir_url(__FILE__) . 'lib/lightbox2/dist/css/lightbox.css');

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/lightbakso-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        wp_enqueue_script('owl.carousel', plugin_dir_url(__FILE__) . 'lib/owlcarousel/dist/owl.carousel.js', array('jquery'), '', true);

        wp_enqueue_script('lightbox', plugin_dir_url(__FILE__) . 'lib/lightbox2/dist/js/lightbox.js', array('jquery', 'owl.carousel'), '', true);

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/lightbakso-public.js', array('jquery', 'owl.carousel', 'lightbox'), $this->version, true);

    }


    /**
     * Generate the shorcode for carousel
     *
     * @since    1.0.0
     */
    public function lightbakso_carousel_sortcode()
    {
        $lightbakso_options = get_option('lightbakso_options');

        $owl_option = array(
            'lightbakso_numberofitems'        => $lightbakso_options['lightbakso_numberofitems'],
            'lightbakso_numberofitems_tablet' => $lightbakso_options['lightbakso_numberofitems_tablet'],
            'lightbakso_numberofitems_mobile' => $lightbakso_options['lightbakso_numberofitems_mobile'],
            'lightbakso_margin'               => $lightbakso_options['lightbakso_margin'],
            'lightbakso_loop'                 => $lightbakso_options['lightbakso_loop'],
            'lightbakso_centeritems'          => $lightbakso_options['lightbakso_centeritems'],
            'lightbakso_navigation'           => $lightbakso_options['lightbakso_navigation'],
            'lightbakso_rewindtheslide'       => $lightbakso_options['lightbakso_rewindtheslide'],
            'lightbakso_dotnavigation'        => $lightbakso_options['lightbakso_dotnavigation'],
            'lightbakso_dotsforeachitem'      => $lightbakso_options['lightbakso_dotsforeachitem'],
            'lightbakso_autoplay'             => $lightbakso_options['lightbakso_autoplay'],
            'lightbakso_autopalyspeed'        => $lightbakso_options['lightbakso_autopalyspeed'],
        );

        $owl_option_data = array();

        // crate a data attribut for each owl option
        foreach ($owl_option as $name => $value) {
            array_push($owl_option_data, 'data-' . esc_attr($name) . '="' . esc_attr($value) . '"');
        }

        $options              = get_option('lightbakso_options');
        $lightbakso_fullwidth = ($options['lightbakso_fullwidth'] === 'true') ? 'full_width' : '';

        ?>

      <div id="lightbox_gallery" class="<?php echo esc_attr($lightbakso_fullwidth); ?>">

            <div <?php echo implode(' ', $owl_option_data); ?> class="lightbox_gallery_carousel owl-theme">

                <?php $lightbox_gallery = new WP_Query(array(
            'post_type' => 'lightbakso_carousel',
        ));?>


                <?php while ($lightbox_gallery->have_posts()): $lightbox_gallery->the_post();?>


                        <div class="item">
                            <a data-lightbox="image" href="<?php the_post_thumbnail_url('full');?>">
                                <img data-lightbox="image" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'lightbakso_feature_image')); ?>" alt="Image">
                            </a>
                        </div>

                    <?php endwhile;?>
        </div>
      </div>

    <?php
}


    /**
     * Custom css for carousel
     *
     * Generated for use selection
     *
     * @since    1.0.0
     */
    public function lightbakso_custom_css()
    {

        $options = get_option('lightbakso_options');

        $css = '';

        if (isset($options['lightbakso_margin_top'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                margin-top: %1$spx;
              }', $options['lightbakso_margin_top']);
        }

        if (isset($options['lightbakso_margin_right'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                margin-right: %1$spx;
              }', $options['lightbakso_margin_right']);
        }
        if (isset($options['lightbakso_margin_bottom'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                margin-bottom: %1$spx;
              }', $options['lightbakso_margin_bottom']);
        }
        if (isset($options['lightbakso_margin_left'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                margin-left: %1$spx;
              }', $options['lightbakso_margin_left']);
        }

        if (isset($options['lightbakso_padding_top'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                padding-top: %1$spx;
              }', $options['lightbakso_padding_top']);
        }

        if (isset($options['lightbakso_padding_right'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                padding-right: %1$spx;
              }', $options['lightbakso_padding_right']);
        }

        if (isset($options['lightbakso_padding_bottom'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                padding-bottom: %1$spx;
              }', $options['lightbakso_padding_bottom']);
        }

        if (isset($options['lightbakso_padding_left'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                padding-left: %1$spx;
              }', $options['lightbakso_padding_left']);
        }

        if (isset($options['lightbakso_background'])) {
            $css .= sprintf(
                '#lightbox_gallery
              {
                background-color: %1$s;
              }', $options['lightbakso_background']);
        }
        if (isset($options['lightbakso_custom_css'])) {
            $css .= $options['lightbakso_custom_css'];
        }

        $custom_css = $this->compress_css_lines($css);

        wp_add_inline_style('lightbakso', $custom_css);

    }

    /**
     * 
     *
     * Compress the css
     *
     * @since    1.0.0
     */
    public function compress_css_lines($css)
    {
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(': ', ':', $css);
        $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
        return $css;
    }

}