<?php

class MDFaqs
{
	// const POSTTYPE = 'hc_faq';
	const POSTTYPE = 'md-faqs';
	const SINGULAR = 'FAQ';
	const PLURAL = 'FAQs';

	public static function initialize() {
		add_action('init', array(__CLASS__, 'create_post_type'));
	}

	public static function create_post_type() {
		MDUtilities::create_post_type(
			self::POSTTYPE,
			self::SINGULAR,
			self::PLURAL,
			array(
				'menu_icon' => 'dashicons-editor-help',
				'menu_position' => 23,
				'supports' => array('title', 'editor', 'custom-fields')
			)
		);
	}
}
