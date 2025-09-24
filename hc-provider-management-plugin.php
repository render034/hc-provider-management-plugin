<?php

/**
 * Plugin Name: Medical Practice Management
 * Plugin URI: https://github.com/render034/hc-provider-management-plugin
 * Description: Comprehensive practice management including providers, locations, FAQs, notifications, and dynamic features
 * Version: 1.0.0
 * Author: Nathaniel Hoyt
 * License: GPL v2 or later
 * Text Domain: hc-provider-management-plugin
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('HC_PROVIDER_MANAGEMENT_VERSION', '1.0.0');
define('HC_PROVIDER_MANAGEMENT_PATH', plugin_dir_path(__FILE__));
define('HC_PROVIDER_MANAGEMENT_URL', plugin_dir_url(__FILE__));
define('HC_PROVIDER_MANAGEMENT_BASENAME', plugin_basename(__FILE__));

/**
 * Main plugin class
 */
class MDPAPracticeManagement
{

    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('init', array($this, 'init'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }

    /**
     * Initialize plugin
     */
    public function init()
    {
        // Plugin initialization code here
        load_plugin_textdomain('hc-provider-management-plugin', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * Plugin activation
     */
    public function activate()
    {
        // Activation code here
        flush_rewrite_rules();
    }

    /**
     * Plugin deactivation
     */
    public function deactivate()
    {
        // Deactivation code here
        flush_rewrite_rules();
    }
}

// Initialize the plugin
new MDPAPracticeManagement();
