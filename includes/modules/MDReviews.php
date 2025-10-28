<?php

class MDReviews
{
	// const POSTTYPE = 'hc_review';
	const POSTTYPE = 'reviews';
	const SINGULAR = 'Review';
	const PLURAL = 'Reviews';

	public static function initialize() {
		add_action('init', array(__CLASS__, 'create_post_type'));
	}

	public static function create_post_type() {
		MDUtilities::create_post_type(
			self::POSTTYPE,
			self::SINGULAR,
			self::PLURAL,
			array(
				'menu_icon' => 'dashicons-star-filled',
				'menu_position' => 24,
				'supports' => array('title', 'editor', 'custom-fields'),
				'public' => false,
				'show_ui' => true,
				'show_in_menu' => true
			)
		);
	}
}
