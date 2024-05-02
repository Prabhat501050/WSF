<?php

class WYSIWYG
{
	public static function add_tinymce_editor_styles()
	{
		add_editor_style('dist/app.css');
	}

	public static function modify_acf_wysiwyg_toolbars($toolbars)
	{
		$fullToolbar = [
			'formatselect',
			'styleselect',
			'removeformat',
			'|',
			'bold',
			'italic',
			'blockquote',
			'hr',
			'|',
			'numlist',
			'bullist',
			'|',
			'link',
			'unlink',
			'|',
			'outdent',
			'indent'
		];

		$basicToolbar = [
			'bold',
			'italic',
			'link',
			'unlink',
			'forecolor',
			'removeformat'
		];

		$statToolbar = [
			'subscript',
			'superscript'
		];

		unset($toolbars['Full'], $toolbars['Basic']);

		$toolbars['Full'] = [];
		$toolbars['Full'][1] = $fullToolbar;

		$toolbars['Basic'] = [];
		$toolbars['Basic'][1] = $basicToolbar;

		$toolbars['Stat'] = [];
		$toolbars['Stat'][1] = $statToolbar;

		return $toolbars;
	}

	public static function modify_tiny_mce_format_options($initArray)
	{
		$styleFormats = [];
		$header_formats = [];
		$body_formats = [];
		$text_colors = [];
		$custom_colors = '';
		$tailwindColors = [
			'transparent' => 'transparent',
			'current' => 'currentColor',
			'white' => '#ffffff',
			'beige' => '#f8f4ea',
			'dark-beige' => '#F1ECE0',
			'olive' => '#8a9747',
			'bronze' => '#ab8241',
			'charcoal' => '#363c48',
			'tan' => '#DCC6A3',
			'red' => '#b11f28',
			'red-accent' => '#69101d'
		];

		for ($i = 1; $i < 7; $i++) {
			$header_formats[] = [
				'title' => 'Header' . $i,
				'selector' => 'h1, h2, h3, h4, h5, p, a, li, blockquote',
				'inline' => 'span',
				'classes' => 'h' . $i
			];
		}

		$header_formats[] = [
			'title' => 'Header Display',
			'selector' => 'h1, h2, h3, h4, h5, p, a, li, blockquote',
			'inline' => 'span',
			'classes' => 'h-display'
		];

		$header_formats[] = [
			'title' => 'Headline',
			'selector' => 'h1, h2, h3, h4, h5, p, a, li, blockquote',
			'inline' => 'span',
			'classes' => 'headline'
		];

		$header_formats[] = [
			'title' => 'No Margin Heading',
			'selector' => 'h1, h2, h3, h4, h5',
			'classes' => '!my-0'
		];

		$body_formats[] = [
			'title' => 'Body 1',
			'selector' => 'p, a, li, blockquote',
			'classes' => 'p1'
		];

		$body_formats[] = [
			'title' => 'Lead',
			'selector' => 'p, a, li, blockquote',
			'classes' => 'lead'
		];

		$body_formats[] = [
			'title' => 'Quote 1',
			'selector' => 'p, a, li, blockquote',
			'classes' => 'quote'
		];

		$body_formats[] = [
			'title' => 'Quote 2',
			'selector' => 'p, a, li, blockquote',
			'classes' => 'quote-2'
		];

		$body_formats[] = [
			'title' => 'Stat',
			'selector' => 'p, a, li, blockquote',
			'classes' => 'stat'
		];

		$body_formats[] = [
			'title' => 'Button group',
			'selector' => 'p, li',
			'classes' => 'flex items-center space-x-4 mt-8'
		];
		$body_formats[] = [
			'title' => 'Bottom Margin 0',
			'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
			'classes' => 'mb-0'
		];
		$body_formats[] = [
			'title' => 'Left Align Text',
			'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
			'classes' => 'text-left'
		];

		$body_formats[] = [
			'title' => 'Right Align Text',
			'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
			'classes' => 'text-right'
		];

		$body_formats[] = [
			'title' => 'Center Align Text',
			'selector' => 'p, span, h1, h2, h3, h4, h5, h6',
			'classes' => 'text-center'
		];

		$body_formats[] = [
			'title' => 'Center Align List',
			'selector' => 'ul, ol',
			'classes' => 'flex flex-col items-center'
		];

		foreach ($tailwindColors as $key => $value) {
			$text_colors[] = [
				'title' => ucfirst($key),
				'selector' => 'span, p, h1, h2, h3, h4, h5, a, ul, li, blockquote',
				'inline' => 'span',
				'classes' => 'text-' . $key,
			];

			$custom_colors .= "'" . $value . "', '" . $key . "', ";
		}

		$styleFormats = array_merge($styleFormats, [
			[
				'title' => 'Header Formats',
				'items' => $header_formats
			],
			[
				'title' => 'Body Formats',
				'items' => $body_formats
			],
			[
				'title' => 'Text Color',
				'items' => $text_colors
			],
			[
				'title' => 'Button (Primary)',
				'inline' => 'a',
				'classes' => 'btn-primary',
				'selector' => 'a'
			],
			[
				'title' => 'Button (Primary reversed)',
				'inline' => 'a',
				'classes' => 'btn-primary-reversed',
				'selector' => 'a'
			],
			[
				'title' => 'Button (Secondary)',
				'inline' => 'a',
				'classes' => 'btn-secondary',
				'selector' => 'a'
			],
			[
				'title' => 'Button (finger)',
				'inline' => 'a',
				'classes' => 'btn-finger-white',
				'selector' => 'a'
			],
			[
				'title' => 'Color Block',
				'selector' => 'span, p, h1, h2, h3, h4, h5, a, ul, li, blockquote',
				'inline' => 'span',
				'classes' => 'color-block'
			]
		]);

		$initArray['block_formats'] = 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3; Header 4=h4; Header 5=h5; Header 6=h6';
		$initArray['body_class'] = 'wysiwyg';
		$initArray['style_formats_autohide'] = true;
		$initArray['relative_urls'] = true;
		$initArray['textcolor_map'] = '[' . $custom_colors . ']';
		$initArray['textcolor_rows'] = 1;
		$initArray['style_formats'] = json_encode($styleFormats);

		return $initArray;
	}
}
