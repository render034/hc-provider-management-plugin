<?php

class MDLocations
{
	// const POSTTYPE = 'hc_location';
	const POSTTYPE = 'md-locations';
	const SINGULAR = 'Location';
	const PLURAL = 'Locations';

	public static function initialize() {
		add_action('init', array(__CLASS__, 'create_post_type'));
	}

	public static function create_post_type() {
		MDUtilities::create_post_type(
			self::POSTTYPE,
			self::SINGULAR,
			self::PLURAL,
			array(
				'menu_icon' => 'dashicons-location-alt',
				'menu_position' => 20,
				'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
			)
		);
	}
}
