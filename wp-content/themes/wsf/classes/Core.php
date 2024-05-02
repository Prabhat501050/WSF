<?php
namespace Pixelsmith;

require_once get_template_directory() . '/constants/CustomBlocks.php';
require_once get_template_directory() . '/constants/CustomPostTypes.php';
require_once get_template_directory() . '/constants/CustomTaxonomies.php';

class Core
{
	public static function setup_blocks_and_posts()
	{
		self::initialize_custom_post_types(PX_CUSTOM_POST_TYPES, PX_CUSTOM_TAXONOMIES);
	}

	public static function enqueue_assets()
	{
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');

		$manifestFile = json_decode(file_get_contents(get_template_directory() . '/mix-manifest.json'));

		foreach ($manifestFile as $key => $value) {
			if (strpos($key, 'app.css') !== false) {
				wp_enqueue_style('main', get_template_directory_uri() . $value, [], null);
			}

			if (strpos($key, 'manifest.js') !== false) {
				wp_enqueue_script('manifest', get_template_directory_uri() . $value, [], null, true);
			}

			if (strpos($key, 'vendor.js') !== false) {
				wp_enqueue_script('vendor', get_template_directory_uri() . $value, ['manifest'], null, true);
			}

			if (strpos($key, 'app.js') !== false) {
				wp_enqueue_script('main', get_template_directory_uri() . $value, ['vendor'], null, true);
			}
		}
	}

	public static function add_option_pages()
	{
		if (function_exists('acf_add_options_page')) {
			acf_add_options_page([
				'page_title' => 'Theme General Settings',
				'menu_title' => 'Theme Settings',
				'menu_slug' => 'theme-general-settings',
				'capability' => 'edit_posts',
				'redirect' => false
			]);

			acf_add_options_page([
				'page_title' => 'Modals',
				'menu_title' => 'Modals',
				'menu_slug' => 'theme-modals',
				'capability' => 'edit_posts',
				'icon_url' => 'dashicons-editor-expand',
				'redirect' => false
			]);
		}
	}

	public static function register_menu_areas()
	{
		register_nav_menus(
			[
				'main-menu' => __('Main Menu'),
				'footer-menu' => __('Footer Menu'),
				// 'main-menu-mobile'  => __( 'Main Mobile Menu'), // Use in case of emergency ;-)
				'footer-col-one' => __('Footer Column One'),
				'footer-col-two' => __('Footer Column Two'),
				'footer-col-three' => __('Footer Column Three'),
				// 'footer-mobile' 	=> __('Footer Mobile'),	// Use in case of emergency ;-)
			]
		);

		// Important for calling proper menus
		global $theme_locations;
		$theme_locations = get_nav_menu_locations();
	}

	public static function initialize_custom_post_types(array $customPostTypes = [], array $customTaxonomies = [])
	{
		foreach ($customPostTypes as $p) {
			$args = [
				'labels' => [
					'name' => _x($p['plural'], 'post type general name'),
					'singular_name' => _x($p['single'], 'post type singular name'),
					'add_new' => _x('Add New', $p['single']),
					'add_new_item' => __('Add New ' . $p['single']),
					'edit_item' => __('Edit ' . $p['single']),
					'new_item' => __('New ' . $p['single']),
					'view_item' => __('View ' . $p['single']),
					'search_items' => __('Search ' . $p['plural']),
					'not_found' => __('No ' . $p['plural'] . ' found'),
					'not_found_in_trash' => __('No ' . $p['plural'] . ' found in Trash'),
					'parent_item_colon' => ''
				],
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => $p['hierarchical'],
				'menu_position' => 5,
				'supports' => $p['supports'],
				'menu_icon' => $p['menu_icon'],
				'taxonomies' => $p['taxonomy']
			];

			register_post_type($p['slug'], $args);
		}

		foreach ($customTaxonomies as $t) {
			$args = [
				'labels' => [
					'name' => _x($t['plural'], 'taxonomy general name', 'textdomain'),
					'singular_name' => _x($t['single'], 'taxonomy singular name', 'textdomain'),
					'search_items' => __('Search ' . $t['plural'], 'textdomain'),
					'all_items' => __('All ' . $t['plural'], 'textdomain'),
					'parent_item' => __('Parent ' . $t['single'], 'textdomain'),
					'parent_item_colon' => __('Parent ' . $t['single'], 'textdomain'),
					'edit_item' => __('Edit ' . $t['single'], 'textdomain'),
					'update_item' => __('Update ' . $t['single'], 'textdomain'),
					'add_new_item' => __('Add New ' . $t['single'], 'textdomain'),
					'new_item_name' => __('New ' . $t['single'] . ' Name', 'textdomain'),
					'menu_name' => __($t['single'], 'textdomain')
				],
				'hierarchical' => $t['hierarchical'],
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'has_archive' => true,
				'rewrite' => ['slug' => $t['slug'], 'with_front' => false]
			];

			register_taxonomy($t['slug'], [$t['post_type']], $args);
		}
	}

	public static function initialize_custom_blocks()
	{
		if (!function_exists('acf_register_block_type') || !is_array(PX_CUSTOM_BLOCKS)) {
			return;
		}

		$customBlockCategories = [
			[
				'slug' => 'custom-blocks',
				'title' => __('Custom Blocks', 'custom-blocks')
			]]
		;

		add_action('acf/init', function () {
			foreach (PX_CUSTOM_BLOCKS as $block) {
				acf_register_block_type($block);
			}
		});

		add_filter('allowed_block_types_all', fn () => [
			'core/block',
			'gravityforms/form',
			...array_map(fn ($block) => 'acf/' . $block['name'], PX_CUSTOM_BLOCKS)
		]);

		add_filter('block_categories', fn ($categories) => [...$categories, ...$customBlockCategories], 10, 2);
	}

	public static function theme_setup()
	{
		add_post_type_support('page', 'excerpt');
		add_theme_support('menus');
		add_theme_support('post-thumbnails');
	}

	public static function wsf_disable_gutenberg($current_status, $post_type)
	{
		if (in_array($post_type, ['location', 'post'])) {
			return false;
		}
		return $current_status;
	}

	public static function posts_link_attributes()
	{
		return 'class="btn-primary w-auto my-0"';
	}

	public static function acf_google_maps_api($api)
	{
		$api['key'] = 'AIzaSyAw73Y1iq1OAfaE4SzudVqp8d8_qLNg3B4';
		return $api;
	}

	public static function custom_shortcodes()
	{
		add_shortcode('year', fn () => date('Y'));

		add_shortcode('phone_number', function () {
			if (function_exists('get_field')) {
				$phone_number = get_field('phone_number', 'option');
				$blog_title = get_bloginfo('title');

				if ($phone_number) {
					return '<a href="tel:' . esc_attr($phone_number) . '" aria-label="Call ' . $blog_title . '">' . esc_html($phone_number) . '</a>';
				}
			}
			return '';
		});

		add_shortcode('secondary_number', function () {
			if (function_exists('get_field')) {
				$phone_number = get_field('phone_number', 'option');
				$secondary_phone_number = get_field('secondary_phone_number', 'option');
				$blog_title = get_bloginfo('title');

				if ($secondary_phone_number) {
					return '<a href="tel:' . esc_attr($secondary_phone_number) . '" aria-label="f Call ' . $blog_title . '">' . esc_html($secondary_phone_number) . '</a>';
				} else {
					return '<a href="tel:' . esc_attr($phone_number) . '" aria-label="Call ' . $blog_title . '">' . esc_html($phone_number) . '</a>';
				}
			}
			return '';
		});

		add_shortcode('address', function () {
			$address = get_field('address', 'option');
			$address_url = get_field('address_url', 'option');
			$blog_title = get_bloginfo('title');

			if ($address) {
				return '<a href="' . $address_url . '" aria-label="Visit ' . $blog_title . '">' . $address . '</a>';
			}

			return '';
		});

		add_shortcode('searchform', function () {
			$searchForm = '';
			$searchForm .= '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ) .'" class="news-search-form search-form w-[400px] p-5 pr-10 pl-10 rounded-full bg-white m-10 ml-auto mr-auto" >';
				$searchForm .= '<label class="search-label" for="search-news">';
					$searchForm .= '<input type="search" id="search-news" placeholder="Search" value="'. get_search_query().'" name="s" class="p-2" />';
				$searchForm .= '</label>';

				$searchForm .= '<input type="hidden" name="post_type" value="post" />';

				$searchForm .= '<input type="submit" value="Search" class="w-[50px] h-[50px] rounded-full p-0" />';
			$searchForm .= '</form>';
			return $searchForm;
		});

		add_shortcode('careersearchform', function () {
			$searchForm = '<form role="search" method="get" target="_blank" action="https://waynefarms.wd1.myworkdayjobs.com/WayneFarms" class="careers-search-form search-form w-[400px] p-5 pr-10 pl-10 rounded-full bg-white mt-10 mb-10" >';
				$searchForm .= '<label class="search-label" for="search-jobs">';
					$searchForm .= '<input type="search" id="search-jobs" placeholder="Search Positions" value="'. get_search_query().'" name="q" class="p-2" />';
				$searchForm .= '</label>';

				$searchForm .= '<input type="hidden" name="post_type" value="post" />';

				$searchForm .= '<input type="submit" value="Search" class="w-[50px] h-[50px] rounded-full p-0" />';
			$searchForm .= '</form>';
			return $searchForm;
		});

	}

	public static function add_custom_admin_css()
	{
		echo '
			<style type="text/css">
				.wp-admin .editor-styles-wrapper
				{padding: 0;}
				.wp-admin .editor-styles-wrapper .wp-block {
					position: relative;
					display: block;
					overflow: hidden;
					margin: 0;
					padding: 0;
				}
				.wp-admin .block-list-appender {
					margin: 0;
				}
				.wp-admin .block-list-appender button {
					background-color: #fff;
					border: 1px solid #000;
				}
			</style>';
	}
}
