<?php

class MDUtilities
{
    public static function initialize() {}

    /**
     * Generate labels for custom post types
     *
     * @param string $singular The singular name
     * @param string $plural The plural name (optional, will add 's' to singular if not provided)
     * @return array Labels array for register_post_type
     */
    public static function generate_post_type_labels($singular, $plural = null)
    {
        if ($plural === null) {
            $plural = $singular . 's';
        }

        return array(
            'name'               => $plural,
            'singular_name'      => $singular,
            'menu_name'          => $plural,
            'name_admin_bar'     => $singular,
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New ' . $singular,
            'new_item'           => 'New ' . $singular,
            'edit_item'          => 'Edit ' . $singular,
            'view_item'          => 'View ' . $singular,
            'all_items'          => 'All ' . $plural,
            'search_items'       => 'Search ' . $plural,
            'parent_item_colon'  => 'Parent ' . $plural . ':',
            'not_found'          => 'No ' . strtolower($plural) . ' found.',
            'not_found_in_trash' => 'No ' . strtolower($plural) . ' found in Trash.'
        );
    }

    /**
     * Create a custom post type with standard arguments
     *
     * @param string $post_type The post type name
     * @param string $singular The singular display name
     * @param string $plural The plural display name (optional)
     * @param array $args Additional arguments to override defaults
     */
    public static function create_post_type($post_type, $singular, $plural = null, $args = array())
    {
        $labels = self::generate_post_type_labels($singular, $plural);

        $defaults = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => sanitize_title($singular)),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields')
        );

        $final_args = wp_parse_args($args, $defaults);

        register_post_type($post_type, $final_args);
    }

    /**
     * Register multiple post types at once
     *
     * @param array $post_types Array of post type configurations
     */
    public static function register_post_types($post_types)
    {
        foreach ($post_types as $config) {
            $post_type = $config['post_type'];
            $singular = $config['singular'];
            $plural = isset($config['plural']) ? $config['plural'] : null;
            $args = isset($config['args']) ? $config['args'] : array();

            self::create_post_type($post_type, $singular, $plural, $args);
        }
    }
}
