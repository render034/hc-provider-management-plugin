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

// Load core classes
require_once HC_PROVIDER_MANAGEMENT_PATH . 'includes/core/ACFManager.php';
require_once HC_PROVIDER_MANAGEMENT_PATH . 'includes/core/MDUtilities.php';
require_once HC_PROVIDER_MANAGEMENT_PATH . 'includes/core/MDLocations.php';
require_once HC_PROVIDER_MANAGEMENT_PATH . 'includes/core/MDProviders.php';
require_once HC_PROVIDER_MANAGEMENT_PATH . 'includes/core/MDBanners.php';
require_once HC_PROVIDER_MANAGEMENT_PATH . 'includes/core/MDFaqs.php';

// Load optional modules
require_once HC_PROVIDER_MANAGEMENT_PATH . 'includes/modules/MDReviews.php';

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
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'settings_init'));
        add_action('admin_notices', array($this, 'check_dependencies'));
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

        // Initialize ACF manager first
        ACFManager::initialize();

        // Initialize core classes
        MDUtilities::initialize();
        MDLocations::initialize();
        MDProviders::initialize();
        MDBanners::initialize();
        MDFaqs::initialize();

        // Initialize optional modules
        if (get_option('hc_enable_reviews', true)) {
            MDReviews::initialize();
        }
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

    /**
     * Add admin menu
     */
    public function add_admin_menu()
    {
        add_options_page(
            'MDPA Practice Management',
            'Practice Management',
            'manage_options',
            'hc-practice-management',
            array($this, 'options_page')
        );
    }

    /**
     * Initialize settings
     */
    public function settings_init()
    {
        register_setting('hc_practice_management', 'hc_enable_reviews');
        register_setting('hc_practice_management', 'hc_enable_acf_save');

        add_settings_section(
            'hc_practice_management_modules',
            'Module Settings',
            array($this, 'settings_section_callback'),
            'hc_practice_management'
        );

        add_settings_field(
            'hc_enable_reviews',
            'Enable Reviews',
            array($this, 'reviews_render'),
            'hc_practice_management',
            'hc_practice_management_modules'
        );

        add_settings_section(
            'hc_practice_management_acf',
            'ACF Settings',
            array($this, 'acf_settings_section_callback'),
            'hc_practice_management'
        );

        add_settings_field(
            'hc_enable_acf_save',
            'Enable ACF Save Point',
            array($this, 'acf_save_render'),
            'hc_practice_management',
            'hc_practice_management_acf'
        );
    }

    /**
     * Settings section callback
     */
    public function settings_section_callback()
    {
        echo 'Enable or disable optional modules for your practice management system.';
    }

    /**
     * Reviews field render
     */
    public function reviews_render()
    {
        $options = get_option('hc_enable_reviews', true);
?>
        <input type='checkbox' name='hc_enable_reviews' <?php checked($options, 1); ?> value='1'>
        <label>Enable Reviews module (manages patient reviews and testimonials)</label>
    <?php
    }

    /**
     * ACF settings section callback
     */
    public function acf_settings_section_callback()
    {
        echo 'Configure ACF (Advanced Custom Fields) integration settings.';
    }

    /**
     * ACF save point field render
     */
    public function acf_save_render()
    {
        $options = get_option('hc_enable_acf_save', true);
?>
        <input type='checkbox' name='hc_enable_acf_save' <?php checked($options, 1); ?> value='1'>
        <label>Save ACF field groups to plugin directory (when disabled, saves to theme)</label>
    <?php
    }

    /**
     * Options page
     */
    public function options_page()
    {
    ?>
        <div class="wrap">
            <h1>MDPA Practice Management Settings</h1>
            <form action='options.php' method='post'>
                <?php
                settings_fields('hc_practice_management');
                do_settings_sections('hc_practice_management');
                submit_button();
                ?>
            </form>
        </div>
<?php
    }

    /**
     * Check plugin dependencies
     */
    public function check_dependencies()
    {
        if (!function_exists('acf_add_local_field_group')) {
            echo '<div class="notice notice-error"><p>';
            echo '<strong>HC Provider Management Plugin</strong> requires Advanced Custom Fields (ACF) to be installed and activated.';
            echo '</p></div>';
        }
    }

    /**
     * Check if ACF is available
     */
    public function is_acf_available()
    {
        return function_exists('acf_add_local_field_group');
    }
}

// Initialize the plugin
new MDPAPracticeManagement();
