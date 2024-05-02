<?php
	$blockFields = get_fields();
	$customBlock = PXUtils::parse_custom_block($block, $blockFields);

	if (is_array($blockFields)) {
		extract($blockFields);
	} else {
		extract($block['data']);
	}
?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>" data-anchor-label="<?= $customBlock->anchorLabel ?>" class="<?= $customBlock->bgColor; ?> <?= $customBlock->classesString ?> <?= $customBlock->paddingStyle; ?>">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<div class="container">
		<div class="space-y-5 lg:space-y-0 lg:space-x-48 lg:flex lg:justify-between">
			<?php if ($content) :?>
				<div class="w-full lg:w-3/12 lg:flex-shrink-0 content"><?= $content ?></div>
			<?php endif; ?>
			<?php
				if ($items) {
					get_template_part('template-parts/accordion', null, ['items' => $items, 'containerClasses' => 'w-full lg:w-1/2 lg:flex-shrink-0 accordion']);
				}
			?>
		</div>
	</div>
</div>