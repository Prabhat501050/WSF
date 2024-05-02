<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}
if (!isset($background_type)) {
	$background_type = '';
}

if (!isset($background_color)) {
	$background_color = '';
}

$image_classes = '';
$img_tag_classes = '';
$headline_classes = '';
$content_classes = '';
$container_classes = '';

switch ($headline_position) {
	case 'full-width':
		$container_classes = 'flex flex-col justify-center';
		$image_classes = 'max-h-[25vh] lg:max-h-[75vh] top-0 w-[40%] left-[75%] max-w-[500px] lg:w-[500px]';
		$img_tag_classes = 'max-w-full h-auto';
		$headline_classes = 'lg:left-0 lg:top-0 mb-8';
		$content_classes = 'lg:left-0 lg:top-0 max-w-[415px]';
		break;

	case 'upper-left':
		$image_classes = 'max-h-[50vh] lg:max-h-[75vh] top-0 right-[80%] w-full';
		$img_tag_classes = 'max-w-[70%] max-h-[70%] lg:max-w-full lg:max-h-[774px] lg:ml-auto lg:h-auto';
		$headline_classes = 'lg:absolute lg:left-[20%] lg:top-0 lg:mt-[220px] mb-8';
		$content_classes = 'lg:absolute lg:left-[20%] lg:ml-[460px] lg:mt-[400px] lg:top-0 max-w-[415px]';
		break;

	case 'lower-left':
		$image_classes = 'max-h-[50vh] lg:max-h-[75vh] top-0 right-[70%] w-[40%]';
		$img_tag_classes = 'object-contain w-[70%] h-[70%] lg:w-full lg:h-full';
		$headline_classes = ' mb-[24px] lg:absolute lg:ml-[-250px] lg:left-[55%] lg:bottom-[30%]';
		$content_classes = 'lg:absolute lg:left-[55%] lg:bottom-[47%] max-w-[415px]';
		break;

	case 'upper-right':
		$image_classes = 'lg:right-[0%] h-full w-full';
		$img_tag_classes = 'object-contain w-full h-full';
		$headline_classes = 'lg:absolute lg:right-[16%] lg:top-[30%] text-right';
		$content_classes = 'lg:absolute lg:right-[55%] lg:top-[47%]';
		break;
}

?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class="py-[96px] lg:pt-[58px] lg:pb-0 <?= $customBlock->classesString ?> <?= $headline_position; ?> <?= $customBlock->bgColor; ?> overflow-hidden">

	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

	<div class="container relative lg:min-h-[976px] <?php echo $container_classes; ?>">
		<?php if (isset($image['html'])) { ?>
		<div class="bg-image realtive lg:absolute ml-[-2rem] lg:ml-0 <?= $image_classes; ?>">
			<img class="<?= $img_tag_classes; ?>" src="<?= $image['url'] ?>"
				alt="<?= $image['title']; ?>" data-parallax />
		</div>
		<!-- /.bg-image -->
		<?php } ?>

		<div class="content">
			<h2
				class="animate-in text-[90px] sm:text-headline lg:text-jumbo leading-jumbo tracking-[0.02em] uppercase <?= $headline_classes; ?> text-<?= $headline_color ?? ''; ?>">
				<?= $headline; ?>
			</h2>
			<div class="animate-in nested <?= $content_classes; ?>">
				<?= $content; ?>
			</div>
			<!-- /.nested -->

		</div>
		<!-- /.content -->
	</div>
	<!-- /.container -->


</div>
