<?php

define('PX_CUSTOM_BLOCKS', [
	/* PLOP_INJECT_EXPORT */
	array(
		'name'            => 'svg-map',
		'title'           => __('SvgMap'),
		'description'     => __('svg-map block (custom).'),
		'render_template' => get_template_directory() . '/blocks/svg-map/svg-map.php',
		'category'        => 'custom-blocks',
		'icon'            => 'format-image',
		'keywords'        => array('svg-map', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(
				
				)
	        ),
	    ),
	),

	array(
		'name'            => 'accordion-and-content-full-width',
		'title'           => __('AccordionAndContentFullWidth'),
		'description'     => __('accordion-and-content-full-width block (custom).'),
		'render_template' => get_template_directory() . '/blocks/accordion-and-content-full-width/accordion-and-content-full-width.php',
		'category'        => 'custom-blocks',
		'icon'            => 'format-image',
		'keywords'        => array('accordion-and-content-full-width', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(
				
				)
	        ),
	    ),
	),

	array(
		'name'            => 'events',
		'title'           => __('Events'),
		'description'     => __('events block (custom).'),
		'render_template' => get_template_directory() . '/blocks/events/events.php',
		'category'        => 'custom-blocks',
		'icon'            => 'format-image',
		'keywords'        => array('events', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(
				
				)
	        ),
	    ),
	),

	array(
		'name'            => 'accordion-and-content',
		'title'           => __('Accordion and Content'),
		'description'     => __(''),
		'render_template' => get_template_directory() . '/blocks/accordion-and-content/accordion-and-content.php',
		'category'        => 'custom-blocks',
		'icon'            => 'excerpt-view',
		'keywords'        => array('accordion-and-content', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(
					'content' => '<h2>Hello world</h2>',
					'items' => array(
						array(
							'title' => 'This is my question',
							'content' => 'This is my answer'
						),
						array(
							'title' => 'This is my question',
							'content' => 'This is my answer'
						),
						array(
							'title' => 'This is my question',
							'content' => 'This is my answer'
						)
					)
				)
	        ),
	    ),
	),

	[
		'name'            => 'banner',
		'title'           => __('Banner'),
		'description'     => __('A custom banner block.'),
		'render_template' => get_template_directory() . '/blocks/banner/banner.php',
		'category'        => 'custom-blocks',
		'icon'            => 'format-image',
		'keywords'        => ['banner', 'display'],
		'supports' => [
			'align' => false
		],
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(
					'content' => '<h1 class="h-display" style="text-align: center;"><span class="text-bronze">Working together</span><br>To improve the lives of the communities we serve</h1>',
				    'media_type' => 'image',
				    'layout' => 'media-background',
				    'image' => array(
			            'ID' => 79,
			            'id' => 79,
			            'title' => 'Homepage-Hero-Display-Desktop',
			            'filename' => 'Homepage-Hero-Display-Desktop.jpg',
			            'filesize' => 396738,
			            'url' => '/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop.jpg',
			            'link' => '/home/homepage-hero-display-desktop/',
			            'alt' => '',
			            'author' => 1,
			            'description' => '',
			            'name' => 'homepage-hero-display-desktop',
			            'status' => 'inherit',
			            'uploaded_to' => 4,
			            'date' => '2023-07-17 15:46:04',
			            'modified' => '2023-07-17 15:46:04',
			            'menu_order' => 0,
			            'mime_type' => 'image/jpeg',
			            'type' => 'image',
			            'subtype' => 'jpeg',
			            'icon' => '/wp-includes/images/media/default.png',
			            'width' => 1680,
			            'height' => 978,
			            'sizes' => array(
			                    'thumbnail' => '/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-150x150.jpg',
			                    'thumbnail-width' => 150,
			                    'thumbnail-height' => 150,
			                    'medium' => '/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-300x175.jpg',
			                    'medium-width' => 300,
			                    'medium-height' => 175,
			                    'medium_large' => '/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-768x447.jpg',
			                    'medium_large-width' => 768,
			                    'medium_large-height' => 447,
			                    'large' => '/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-1024x596.jpg',
			                    'large-width' => 1024,
			                    'large-height' => 596,
			                    '1536x1536' => '/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-1536x894.jpg',
			                    '1536x1536-width' => 1536,
			                    '1536x1536-height' => 894,
			                    '2048x2048' => '/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop.jpg',
			                    '2048x2048-width' => 1680,
			                    '2048x2048-height' => 978
			                ),

			           'html' => '<img width="1680" height="978" src="/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop.jpg" class="attachment-original size-original" alt="" decoding="async" loading="lazy" srcset="/wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop.jpg 1680w, /wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-300x175.jpg 300w, /wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-1024x596.jpg 1024w, /wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-768x447.jpg 768w, /wp-content/uploads/2023/07/Homepage-Hero-Display-Desktop-1536x894.jpg 1536w" sizes="(max-width: 1680px) 100vw, 1680px" />'
        			)
				)
	        ),
	    ),
	],

	array(
		'name'            => 'brand-slider',
		'title'           => __('Brand Slider'),
		'description'     => __('brand-slider block (custom).'),
		'render_template' => get_template_directory() . '/blocks/brand-slider/brand-slider.php',
		'category'        => 'custom-blocks',
		'icon'            => 'format-gallery',
		'keywords'        => array('brand-slider', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'cards',
		'title'           => __('Cards'),
		'description'     => __('A simple block to feature content in a card format.'),
		'render_template' => get_template_directory() . '/blocks/cards/cards.php',
		'category'        => 'custom-blocks',
		'icon'            => 'table-row-before',
		'keywords'        => array('cards', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'carousel',
		'title'           => __('Carousel'),
		'description'     => __('carousel block (custom).'),
		'render_template' => get_template_directory() . '/blocks/carousel/carousel.php',
		'category'        => 'custom-blocks',
		'icon'            => 'format-image',
		'keywords'        => array('carousel', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'cta',
		'title'           => __('CTA'),
		'description'     => __('A CTA block to direct visitors.'),
		'render_template' => get_template_directory() . '/blocks/cta/cta.php',
		'category'        => 'custom-blocks',
		'icon'            => 'migrate',
		'keywords'        => array('cta', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'columns',
		'title'           => __('Columns'),
		'description'     => __('columns block (custom).'),
		'render_template' => get_template_directory() . '/blocks/columns/columns.php',
		'category'        => 'custom-blocks',
		'icon'            => 'schedule',
		'keywords'        => array('columns', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'feature-and-content',
		'title'           => __('Feature and Content'),
		'description'     => __('A block with a rich text editor and images or stats.'),
		'render_template' => get_template_directory() . '/blocks/feature-and-content/feature-and-content.php',
		'category'        => 'custom-blocks',
		'icon'            => 'welcome-widgets-menus',
		'keywords'        => array('feature-and-content', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'form',
		'title'           => __('Form'),
		'description'     => __('form block (custom).'),
		'render_template' => get_template_directory() . '/blocks/form/form.php',
		'category'        => 'custom-blocks',
		'icon'            => 'forms',
		'keywords'        => array('form', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),
	
	array(
		'name'            => 'hiring-events',
		'title'           => __('Hiring Events'),
		'description'     => __('hiring-events block (custom).'),
		'render_template' => get_template_directory() . '/blocks/hiring-events/hiring-events.php',
		'category'        => 'custom-blocks',
		'icon'            => 'editor-ul',
		'keywords'        => array('hiring-events', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(
				
				)
	        ),
	    ),
	),	

	array(
		'name'            => 'locations',
		'title'           => __('Locations'),
		'description'     => __('locations block (custom).'),
		'render_template' => get_template_directory() . '/blocks/locations/locations.php',
		'category'        => 'custom-blocks',
		'icon'            => 'location',
		'keywords'        => array('locations', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'media',
		'title'           => __('Media'),
		'description'     => __('media block (custom).'),
		'render_template' => get_template_directory() . '/blocks/media/media.php',
		'category'        => 'custom-blocks',
		'icon'            => 'format-image',
		'keywords'        => array('media', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'news',
		'title'           => __('News'),
		'description'     => __('news block (custom).'),
		'render_template' => get_template_directory() . '/blocks/news/news.php',
		'category'        => 'custom-blocks',
		'icon'            => 'text',
		'keywords'        => array('news', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'stat',
		'title'           => __('Stat'),
		'description'     => __('stat block (custom).'),
		'render_template' => get_template_directory() . '/blocks/stat/stat.php',
		'category'        => 'custom-blocks',
		'icon'            => 'info',
		'keywords'        => array('stat', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	array(
		'name'            => 'team',
		'title'           => __('Team'),
		'description'     => __('team block (custom).'),
		'render_template' => get_template_directory() . '/blocks/team/team.php',
		'category'        => 'custom-blocks',
		'icon'            => 'id',
		'keywords'        => array('team', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),

	[
		'name'            => 'text',
		'title'           => __('Text'),
		'description'     => __('A custom text block.'),
		'render_template' => get_template_directory() . '/blocks/text/text.php',
		'category'        => 'custom-blocks',
		'icon'            => 'editor-textcolor',
		'keywords'        => ['text', 'editor', 'heading', 'paragraph', 'content'],
		'supports' => [
			'align' => false
		],
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	],

	array(
		'name'            => 'quote',
		'title'           => __('Quote'),
		'description'     => __('quote block (custom).'),
		'render_template' => get_template_directory() . '/blocks/quote/quote.php',
		'category'        => 'custom-blocks',
		'icon'            => 'format-image',
		'keywords'        => array('quote', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),
	
	array(
		'name'            => 'wrapped-headline',
		'title'           => __('Wrapped Headline'),
		'description'     => __('Custom wrapped headlines predominantely for the homepage with limited editability.'),
		'render_template' => get_template_directory() . '/blocks/wrapped-headline/wrapped-headline.php',
		'category'        => 'custom-blocks',
		'icon'            => 'analytics',
		'keywords'        => array('wrapped-headline', 'display'),
		'supports'        => array('align' => false),
		'example'         => array(
	        'attributes' => array(
	            'mode' => 'preview',
				'data' => array(

				)
	        ),
	    ),
	),
]);
