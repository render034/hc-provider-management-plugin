<?php

class MDBanners
{
	// const POSTTYPE = 'hc_banner';
	const POSTTYPE = 'mdpa_notifications';
	const SINGULAR = 'Notification';
	const PLURAL = 'Notifications';

	public static function initialize() {
		add_action('init', array(__CLASS__, 'create_post_type'));
	}

	public static function create_post_type() {
		MDUtilities::create_post_type(
			self::POSTTYPE,
			self::SINGULAR,
			self::PLURAL,
			array(
				'menu_icon' => 'dashicons-megaphone',
				'menu_position' => 22,
				'supports' => array('title', 'editor', 'custom-fields')
			)
		);
	}
}
