<?php

define('PX_CUSTOM_POST_TYPES', [
	[
		'slug' => 'location',
		'single' => 'Location',
		'plural' => 'Locations',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-location',
		'supports' => ['title', 'thumbnail', 'editor'],
		'taxonomy' => []
	],
	[
		'slug' => 'brand',
		'single' => 'Brand',
		'plural' => 'Brands',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-buddicons-groups',
		'supports' => ['title', 'thumbnail', 'editor'],
		'taxonomy' => []
	],
	[
		'slug' => 'product',
		'single' => 'Product',
		'plural' => 'Products',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-products',
		'supports' => ['title', 'thumbnail', 'editor'],
		'taxonomy' => []
	],
	[
		'slug' => 'hiring-events',
		'single' => 'Hiring Event',
		'plural' => 'Hiring Events',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-calendar',
		'supports' => ['title'],
		'taxonomy' => []
	]
]);
