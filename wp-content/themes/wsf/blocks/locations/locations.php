<?php

	$blockFields = get_fields();
	$customBlock = PXUtils::parse_custom_block($block, $blockFields);

	if (is_array($blockFields)) {
		extract($blockFields);
	} else {
		extract($block['data']);
	}

	$locations = array_filter(array_map(function ($p) {
		return [
			'title' => $p->post_title,
			'image' => get_the_post_thumbnail($p, 'post-thumbnail', ['class' => 'w-full h-full object-cover']),
			'map' => get_field('map', $p->ID),
			'link' => get_permalink($p),
			'content' => $p->post_content,
			'location' => get_field('location', $p->ID),
			'map_link' => get_field('map_card_link', $p->ID),
		];
	}, get_posts([
		'post_type' => 'location',
		'posts_per_page' => -1
	])), fn ($el) => isset($el['map']));
?>

<script>
	const wsfLocations = <?= json_encode($locations) ?> ;
	const templateDirURI = '<?= get_template_directory_uri() ?>';
</script>

<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>" data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class=" <?= $customBlock->classesString ?>  pt-10 pb-10 lg:pt-[144px] lg:pb-[144px] <?= $customBlock->bgColor; ?>">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

	<div class="container pb-10 lg:pb-16">
		<div class="content">
			<?= $content; ?>
		</div>
		<!-- /.content -->
	</div>
	<!-- /.container -->

	<div class="container">
		<div class="lg:grid lg:grid-cols-10 lg:gap-12">
			<div id="locations-map" class="bg-white col-span-6 h-[515px] mb-10 lg:mb-0"></div>
			<div id="location-data" class="col-span-4">
			</div>
		</div>
	</div>

	<template id="location-template">
		<div class="bg-white px-5 py-6 text-black space-y-6">
			<div class="aspect-video relative bg-tan" data-image-container></div>
			<h3 class="hidden lg:text-2xxl text-tan leading-jumbo"></h3>
			<h2 class="leading-jumbo"></h2>
			<div data-content-container></div>
			<a href="" aria-label="" target="" class="btn-primary btn-finger-white">Learn more</a>
		</div>
	</template>
</div>