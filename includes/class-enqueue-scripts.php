<?php
if (!defined('ABSPATH')) exit;

class CHI_Enqueue_Scripts
{
    private static $instance = null;

    private function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts_and_styles']);
    }

    public function enqueue_scripts_and_styles()
    {
        // Enqueue stylesheet
        wp_enqueue_style('storefront-child', get_stylesheet_uri(), [], '1.0.0');

        // Enqueue JavaScript
        wp_enqueue_script(
            'toggle-dropdown',
            CHI_THEME_DIR_URI . '/js/toggle_dropdown.js',
            ['jquery'],
            '1.0.0',
            true
        );


        wp_enqueue_script(
            'active-navlinks',
            CHI_THEME_DIR_URI . '/js/active-navlinks.js',
            ['jquery'],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'fullscreen-navbar-categories',
            CHI_THEME_DIR_URI . '/js/fullscreen-navbar-categories.js',
            ['jquery'],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'hero-video',
            CHI_THEME_DIR_URI . '/js/hero-video.js',
            ['jquery'],
            '1.0.0',
            true
        );
    }

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
