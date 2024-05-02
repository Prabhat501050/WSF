<?php

use Pixelsmith\Core;

require_once __DIR__ . '/Core.php';
require_once __DIR__ . '/PXUtils.php';
require_once __DIR__ . '/WSFUtils.php';
require_once __DIR__ . '/WYSIWYG.php';
require_once __DIR__ . '/MenuWalker.php';
require_once __DIR__ . '/MobileMenuWalker.php';
require_once __DIR__ . '/PXEditor.php';

class PXGutenbergTheme
{
	public static function init()
	{
		Core::initialize_custom_blocks();
		self::register_actions();
		self::register_filters();
	}

	public static function register_actions()
	{
		add_action('init', [Core::class, 'setup_blocks_and_posts']);
		add_action('wp_enqueue_scripts', [Core::class, 'enqueue_assets']);
		add_action('enqueue_block_editor_assets', [Core::class, 'enqueue_assets']);
		add_action('after_setup_theme', [Core::class, 'theme_setup']);
		add_filter('use_block_editor_for_post_type', [Core::class, 'wsf_disable_gutenberg'], 10, 2);
		add_action('init', [Core::class, 'register_menu_areas']);
		add_action('acf/init', [Core::class, 'add_option_pages']);
		add_filter('next_posts_link_attributes', [Core::class, 'posts_link_attributes']);
		add_filter('previous_posts_link_attributes', [Core::class, 'posts_link_attributes']);
		add_filter('acf/fields/google_map/api', [Core::class, 'acf_google_maps_api']);
		add_action('wp_head', [PXUtils::class, 'add_google_analytics']);
		add_action('login_enqueue_scripts', [PXUtils::class, 'set_login_page_styles']);
		add_action('admin_init', [WYSIWYG::class, 'add_tinymce_editor_styles']);
		add_action('init', [Core::class, 'custom_shortcodes']);
		add_action('admin_head', [Core::class, 'add_custom_admin_css']);

		// add_action('show_user_profile', [USERS::class, 'extra_user_profile_fields']);
		// add_action('edit_user_profile', [USERS::class, 'extra_user_profile_fields']);
		// add_action('personal_options_update', [USERS::class, 'save_extra_user_profile_fields']);
		// add_action('edit_user_profile_update', [USERS::class, 'save_extra_user_profile_fields']);
	}

	public static function register_filters()
	{
		add_filter('acf/format_value/type=image', [PXUtils::class, 'format_acf_images'], 100, 3);
		add_filter('acf/format_value/type=gallery', [PXUtils::class, 'format_acf_gallery_images'], 100, 3);
		add_filter('relevanssi_excerpt_part', [PXUtils::class, 'rlv_excerpt_part_source'], 10, 2);
		add_filter('acf/fields/wysiwyg/toolbars', [WYSIWYG::class, 'modify_acf_wysiwyg_toolbars'], 10, 1);
		add_filter('tiny_mce_before_init', [WYSIWYG::class, 'modify_tiny_mce_format_options'], 10, 1);
		add_filter('upload_mimes', fn ($mimeTypes) => ['svg' => 'image/svg+xml', ...$mimeTypes]);
		add_filter('relevanssi_live_search_base_styles', '__return_false');
		add_filter('pre_get_posts', [PXUtils::class, 'filterSearchResults'], 10, 1);

		add_action('wp_enqueue_scripts', function () {
			wp_dequeue_style('relevanssi-live-search');
		}, 99);
	}
}
