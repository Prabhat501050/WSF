<?php
	$blockFields = get_fields();
	$customBlock = PXUtils::parse_custom_block($block, $blockFields);

	if (is_array($blockFields)) {
		extract($blockFields);
	} else {
		extract($block['data']);
	}

	if (!isset($padding)) {
		$padding = '';
	}
	if (!isset($width)) {
		$width = '';
	}
?>

<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class="<?= $customBlock->classesString ?> <?= $customBlock->paddingStyle; ?> <?= $customBlock->bgColor; ?> <?= $customBlock->bgClass; ?>">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<?= $customBlock->bgImg; ?>
	<div class="<?= $customBlock->bgContainer; ?> ">
		<div class="wysiwyg animate-in">
			<div class="content space-y-4 lg:space-y-6 lg:<?= $width ?> mx-auto">
				<?= $text ?>
			</div>
		</div>
	</div>
</div>