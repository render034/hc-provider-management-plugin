<?php

class ACFManager
{
    public static function initialize()
    {
        if (!function_exists('acf_get_setting')) {
            return;
        }

        // Setup ACF JSON paths
        add_filter('acf/settings/save_json', array(__CLASS__, 'acf_json_save_point'));
        add_filter('acf/settings/load_json', array(__CLASS__, 'acf_json_load_point'));
    }

    /**
     * Set ACF JSON save point to plugin directory (if enabled)
     */
    public static function acf_json_save_point($path)
    {
        // Check if save point is disabled
        if (!get_option('hc_enable_acf_save', true)) {
            return $path; // Return original path (usually theme)
        }

        return HC_PROVIDER_MANAGEMENT_PATH . 'acf-json';
    }

    /**
     * Add plugin's ACF JSON directory to load paths
     */
    public static function acf_json_load_point($paths)
    {
        // Add plugin's acf-json directory
        $paths[] = HC_PROVIDER_MANAGEMENT_PATH . 'acf-json';
        return $paths;
    }
}