<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

$contentContainerClasses = match($layout) {
	'half-content-media' => 'w-full lg:w-2/5 animate-in pt-[120px] pb-10',
	'card-media-background' => 'w-full lg:w-[55%] bg-white p-12 lg:p-20 mt-8 animate-in',
	default => 'w-full animate-in'
};

$mediaClasses = match($layout) {
	'half-content-media' => 'lg:absolute lg:w-1/2 lg:right-0 lg:top-0 lg:object-cover',
	'media-background' => 'absolute top-0 left-0 z-0 pointer-events-none w-full h-full object-cover object-center',
	'short' => 'absolute top-0 left-0 z-0 pointer-events-none w-full h-full object-cover object-center',
	'card-media-background' => 'absolute top-0 left-0 z-0 pointer-events-none w-full h-full object-cover object-center',
	default => (isset($video_file) || isset($image)) ? '' : 'hidden'
};

	$blockClasses = match($layout) {
		'short' => 'mt-[-10px] min-h-[400px] lg:min-h-[670px]',
		'media-background' => 'h-[550px] lg:h-auto lg:aspect-video',
		'half-content-media' => 'lg:h-auto xl:aspect-video',
		default => 'pt-[150px] pb-[150px] lg:h-auto'
	};
?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class=" <?= $customBlock->paddingStyle; ?>  <?= $customBlock->bgColor; ?> <?= $customBlock->classesString ?> <?= $blockClasses; ?> bg-cover bg-no-repeat bg-center relative flex flex-col justify-center overflow-hidden">
	<?= $is_preview ? '<span class="block-preview-label">' . $block['title'] . '</span>' : '' ?>

	<?php if (isset($video_file)) :?>
		<video src="<?= $video_file['url'] ?>" autoplay muted playsinline loop class="<?= $mediaClasses ?>"></video>
	<?php endif; ?>

	<?php if (isset($image)) :?>
	<img src="<?= $image['url'] ?? '' ?>" class="<?= $mediaClasses ?> lg:-mt-[5%] lg:h-[125%]"
		aria-label="<?= $image['title']; ?>" data-parallax />
	<?php endif; ?>

	<div class="container relative z-10 flex items-center">
		<div class="content <?= $contentContainerClasses ?>"><?= $content ?></div>
	</div>
</div>