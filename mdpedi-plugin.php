<?php
/**
 * Plugin Name: Mdpedi Provider Suite
 * Plugin URI: https://github.com/render034/mdpedi-plugin
 * Description: Provider management and related functionality for MD Pediatric Associates
 * Version: 1.0.0
 * Author: MD Pediatric Associates
 * License: GPL v2 or later
 * Text Domain: mdpedi-plugin
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('MDPEDI_PLUGIN_VERSION', '1.0.0');
define('MDPEDI_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MDPEDI_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MDPEDI_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main plugin class
 */
class MdpediProviderSuite {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'init'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }

    /**
     * Initialize plugin
     */
    public function init() {
        // Plugin initialization code here
        load_plugin_textdomain('mdpedi-plugin', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * Plugin activation
     */
    public function activate() {
        // Activation code here
        flush_rewrite_rules();
    }

    /**
     * Plugin deactivation
     */
    public function deactivate() {
        // Deactivation code here
        flush_rewrite_rules();
    }
}

// Initialize the plugin
new MdpediProviderSuite();