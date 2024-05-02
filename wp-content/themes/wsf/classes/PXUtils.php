<?php

class PXUtils
{
	public static function add_google_analytics()
	{
		$code_type = (!empty(get_field('tracking_id_option', 'option'))) ? get_field('tracking_id_option', 'option') : null;
		$hostBlacklist = ['pixelsmith.co', 'wpengine.com', '.test', 'localhost'];

		$code = get_field('tracking_ga4', 'option');
		$initActive = !empty($code) && $_COOKIE['acceptedCookiePrompt'] !== 'no';

		$analyticsActive = array_reduce($hostBlacklist, function ($carry, $item) {
			return $carry && (strpos($_SERVER['HTTP_HOST'], $item) === false);
		}, $initActive);

		echo $code;
	}

	public static function include_svg_markup($value, $post_id, $field)
	{
		$url = parse_url($value['url']);
		$pathInfo = pathinfo($url['path']);

		if (!isset($pathInfo['extension'])) {
			return $value;
		}

		if ($pathInfo['extension'] === 'svg') {
			$svg = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $url['path']);
			$value['svg'] = $svg;
		}

		return $value;
	}

	public static function format_acf_images($value, $post_id, $field)
	{
		if (isset($value['url'])) {
			$url = parse_url($value['url']);
			$pathInfo = pathinfo($url['path']);
		}

		// add inline svg to image array
		if (isset($pathInfo['extension']) && $pathInfo['extension'] === 'svg') {
			$svg = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $url['path']);
			$value['svg'] = $svg;
		}

		if (isset($value['ID'])) {
			$value['html'] = wp_get_attachment_image($value['ID'], 'original');
		}

		return $value;
	}

	public static function filterSearchResults($query)
	{
		if (isset($_GET['post_type']) && $_GET['post_type'] == 'post') {
			if ($query->is_search) {
				$query->set('post_type', 'post');
			}
		}

		return $query;
	}

	public static function format_acf_gallery_images($value, $post_id, $field)
	{
		if (!is_iterable($value)) {
			return;
		}

		foreach ($value as $i => $image) {
			if (isset($image['ID'])) {
				$value[$i]['html'] = wp_get_attachment_image($image['ID'], 'original');
			}
		}

		return $value;
	}

	public static function set_login_page_styles()
	{
		wp_enqueue_style('custom-login', get_template_directory_uri() . '/dist/login-page.min.css');

		$style = '';
		$logo = get_field('admin_logo', 'options');
		$background_color = get_field('background_color', 'options');
		$background_image = get_field('background_image', 'options');
		$background_image_position = get_field('background_image_position', 'options');
		$background_size = get_field('background_size', 'options');

		if (!empty($logo)) {
			$width = ((int) $logo['width'] > 320) ? 'auto' : $logo['width'] . 'px';
			$style .= '#login h1 a,
					.login h1 a {
						background-image: url(' . $logo['url'] . ');
						width: ' . $width . ';
						background-size: contain;
					}';
		}

		if (!empty($background_color)) {
			$style .= 'body.login {
				background-color: ' . $background_color . ';
			}';
		}

		if (!empty($background_image)) {
			$style .= 'body.login {
				background-image: url(' . $background_image['url'] . ');
				background-repeat: no-repeat;
			}';
		}

		if (!empty($background_image_position)) {
			$style .= 'body.login {
				background-position: ' . $background_image_position . ';
			}';
		}

		if (!empty($background_size)) {
			$style .= 'body.login {
				background-size: ' . $background_size . ';
			}';
		}

		echo '<style>' . $style . '</style>';
	}

	//
	// Pagination (Alter as needed)
	//
	public static function pagination_bar($query, $args_array = null)
	{
		$total_pages = $query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		$paginate = '';

		if ($total_pages > 1) {
			$paginate = paginate_links([
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'total' => $query->max_num_pages,
				'current' => max(1, get_query_var('paged')),
				'format' => '?paged=%#%',
				'show_all' => false,
				'type' => 'plain',
				'end_size' => 1,
				'mid_size' => 2,
				'prev_next' => true,
				'prev_text' => sprintf('<i></i> %1$s', __('<', 'text-domain')),
				'next_text' => sprintf('%1$s <i></i>', __('>', 'text-domain')),
				'add_args' => $args_array, //add query string array( 'category' => $_GET['cat'] ) OR false
				'add_fragment' => '',
			]);
		}

		return $paginate;
	}

	public static function parse_custom_block(array $block, array|bool $blockFields): object
	{
		$b = new stdClass();

		$extraClasses = [];

		$b->title = $block['title'];
		$b->name = $block['name'];
		$b->id = is_array($blockFields) && !empty($blockFields['block_id']) ? str_replace(' ', '-', strtolower($blockFields['block_id'])) : $block['name'] . '-' . $block['id'];
		$b->classes = array_filter([...$extraClasses, ...explode(' ', 'pxblock pxblock--' . str_replace('acf/', '', $block['name'])), $block['className'] ?? '', !empty($block['align']) ? ' align' . $block['align'] : '']);
		$b->classesString = implode(' ', $b->classes);
		$b->anchorLabel = isset($blockFields['anchor_label']) ? $blockFields['anchor_label'] : '';

		/* Width */
		$widthStyle = '';
		$width = isset($blockFields['width']) ? $blockFields['width'] : null;

		if ($width) {
			if ($width == 'w-full ') {
				$widthStyle .= 'w-full';
			} elseif ($width == 'w-1/2') {
				$widthStyle .= 'w-full lg:w-3/4';
			} else {
				$widthStyle .= 'w-full lg:w-3/4';
			}
		}
		$b->widthStyle = $widthStyle;

		/* Padding Styles */
		$paddingStyle = '';
		$padding = isset($blockFields['padding']) ? $blockFields['padding'] : null;

		if ($padding) {
			if ($padding !== 'custom') {
				$paddingStyle .= 'py-[' . $padding . 'px]';
			} else {
				$padding_top = isset($blockFields['padding_top']) ? $blockFields['padding_top'] : null;
				$padding_bottom = isset($blockFields['padding_bottom']) ? $blockFields['padding_bottom'] : null;

				$paddingStyle .= 'pt-[' . $padding_top . 'px] pb-[' . $padding_bottom . 'px]';
			}
		}
		$b->paddingStyle = $paddingStyle;

		/* Background */
		$background_type = isset($blockFields['background_type']) ? $blockFields['background_type'] : null;

		$bgColor = '';
		$bgImg = '';
		$bgContent = '';
		$bgContainer = '';
		$bgClass = '';

		if ($background_type == 'image') {
			$background_image = isset($blockFields['background_image']) ? $blockFields['background_image'] : null;

			$bgImg = '';
			$bgImg .= '' . $background_image['html'] . '';

			$bgClass = '';
			$bgClass .= 'h-screen lg:h-auto lg:aspect-video bg-cover bg-no-repeat bg-center relative flex flex-col justify-center image-bg';

			$bgColor .= '';
			$bgContainer .= 'container relative z-10 flex items-center';
		} elseif ($background_type == 'both') {
			$background_image = isset($blockFields['background_image']) ? $blockFields['background_image'] : null;
			$color = isset($blockFields['background_color']) ? $blockFields['background_color'] : null;

			$bgImg = '';
			$bgImg .= '' . $background_image['html'] . '';

			$bgClass = '';
			$bgClass .= 'h-screen lg:h-auto lg:aspect-video bg-cover bg-no-repeat bg-center relative flex flex-col justify-center image-bg';

			$bgColor .= 'bg-' . $color . '';

			$bgContainer .= 'bg--cont-img absolute h-1/2 z-[1] flex items-center bottom-[-20px] left-0 w-full overflow-hidden';
		} else {
			$color = isset($blockFields['background_color']) ? $blockFields['background_color'] : null;

			$bgColor .= 'bg-' . $color . '';
			$bgContainer .= 'container';

			$bgImg .= '';
			$bgClass .= '';
		}

		$b->bgColor = $bgColor;
		$b->bgContainer = $bgContainer;
		$b->bgContent = $bgContent;
		$b->bgImg = $bgImg;
		$b->bgClass = $bgClass;
		return $b;
	}

	public static function rlv_excerpt_part_source(string $excerpt_text, array $excerpt) : string
	{
		return '<span class="line-clamp-3">' . $excerpt['text'] . '</span>';
	}
}
