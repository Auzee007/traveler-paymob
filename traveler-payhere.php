<?php
/*
Plugin Name: Traveler Paymob
Description: Use Paymob with Traveler theme booking engine.
Version: 1.0.0
Author: Pixeleator Studio
Author URI: https://studio.pixeleator.com/?utm_source=traveler_paymob_plugin&utm_medium=link&utm_campaign=traveler_paymob_plugin
License: GPLv2 or later
Text Domain: traveler-payhere
*/

require 'vendor/autoload.php';

class Traveler_Payhere_Payment {
    public $pluginUrl = '';
    public $pluginPath = '';
    public $customFolder = 'traveler-payhere';

    public function __construct()
    {
        $this->pluginPath = trailingslashit(plugin_dir_path(__FILE__));
        $this->pluginUrl = trailingslashit(plugin_dir_url(__FILE__));

        add_action('plugins_loaded', [$this, '_pluginSetup']);
        add_action('init', [$this, '_token_validtion'], 20);
        add_action('wp_enqueue_scripts', [$this, '_pluginEnqueue']);
        add_action('admin_menu', [$this, '_plugin_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, '_plugin_admin_style']);
        add_action('admin_notices', [$this, '_admin_messages']);
    }

    public function _pluginSetup()
    {
        load_plugin_textdomain('traveler-payhere', false, basename(dirname(__FILE__)) . '/languages');
    }

    public function _plugin_admin_menu() {
        add_menu_page(
            __('Traveler Paymob', 'traveler-payhere'),
            __('Traveler Paymob', 'traveler-payhere'),
            'manage_options',
            'traveler-paymob',
            function () {
                echo $this->loadTemplate('license-activation');
            },
            $this::get_inst()->pluginUrl . 'assets/img/paymob.jpg',
            56
        );
    }

    public function _pluginLoader()
    {
        if (class_exists('STTravelCode') && class_exists('STAbstactPaymentGateway')) {
            require_once($this->pluginPath . 'inc/payhere.php');
        }
    }

    public function _pluginEnqueue()
    {
        wp_enqueue_style('traveler-payhere-bootstrap-css', $this->pluginUrl . 'assets/css/mdb.min.css', [], '1.0.0');
        wp_enqueue_style('traveler-payhere-style', $this->pluginUrl . 'assets/css/master.css', [], '1.0.0');
        wp_enqueue_script('traveler-payhere-bootstrap-js', $this->pluginUrl . 'assets/js/mdb.es.min.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('traveler-payhere-main', $this->pluginUrl . 'assets/js/main.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('traveler-payhere-general-js', $this->pluginUrl . 'assets/js/general.js', [], time(), true);
    }

    public function _plugin_admin_style ($hook_suffix) {
        if ($hook_suffix == 'toplevel_page_traveler-paymob') {
            wp_enqueue_style('traveler-payhere-admin', $this->pluginUrl . 'assets/css/admin.css', [], '1.0.0');
            wp_enqueue_style('traveler-payhere-bootstrap-css', $this->pluginUrl . 'assets/css/mdb.min.css', [], '1.0.0');
            wp_enqueue_script('traveler-payhere-bootstrap-js', $this->pluginUrl . 'assets/js/mdb.es.min.js', ['jquery'], '1.0.0', true);
            wp_enqueue_script('traveler-payhere-main', $this->pluginUrl . 'assets/js/main.js', ['jquery'], '1.0.0', true);
        }
        wp_enqueue_style('traveler-payhere-general', $this->pluginUrl . 'assets/css/general.css', [], '1.0.0');
        wp_enqueue_style('traveler-payhere-dashicons', $this->pluginUrl . 'assets/css/dashicons.css', [], '1.0.0');
        wp_enqueue_script('traveler-payhere-general-js', Traveler_Payhere_Payment::get_inst()->pluginUrl . 'assets/js/general.js', [], '2.0.0', true);
    }

    public function _token_validtion()
    {
        $token = get_option('traveler_paymob_token', false);

        if (!$token) {
            # Create token option
            update_option('traveler_paymob_token', '');
            return false;
        }

        // Here you can add your logic to verify the token with Envato API or your own server.
        if ($token !== 'your_valid_token') {
            return false; // Invalid token
        }

        $this->_pluginLoader(); // Ensure the plugin is loaded before checking the token.
        return true; // Return true if the token is valid, otherwise return false.
    }

    public function _admin_messages () {
        if (!$this->_token_validtion()) {
            echo '<div class="notice notice-warning" id="traveler-paymob-notice"><img src="'. Traveler_Payhere_Payment::get_inst()->pluginUrl .'assets/img/paymob.jpg" alt="Traveler Paymob"> You need to activate the plugin to register the payment gateway in your theme!</div>';
        }
    }

    public function loadTemplate($name, $data = null)
    {
        if (is_array($data))
            extract($data);

        $template = $this->pluginPath . 'views/' . $name . '.php';

        if (is_file($template)) {
            $templateCustom = locate_template($this->customFolder . '/views/' . $name . '.php');
            if (is_file($templateCustom)) {
                $template = $templateCustom;
            }
            ob_start();

            require($template);

            $html = @ob_get_clean();

            return $html;
        }
    }

    public static function get_inst()
    {
        static $instance;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}

Traveler_Payhere_Payment::get_inst();