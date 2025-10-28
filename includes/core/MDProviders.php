<?php

class MDProviders
{
	// const POSTTYPE = 'hc_provider';
	const POSTTYPE = 'md-providers';
	const SINGULAR = 'Provider';
	const PLURAL = 'Providers';

	public static function initialize() {
		add_action('init', array(__CLASS__, 'create_post_type'));
	}

	public static function create_post_type() {
		MDUtilities::create_post_type(
			self::POSTTYPE,
			self::SINGULAR,
			self::PLURAL,
			array(
				'menu_icon' => 'dashicons-businessman',
				'menu_position' => 21,
				'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
			)
		);
	}
}
