<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

$team_members ??= [];

?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class="<?= $customBlock->classesString ?> <?= $customBlock->bgColor; ?>">

	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

	<div class="container">
		<div class="content py-8 space-y-4 lg:space-y-6 lg:pb-16 w-full lg:w-7/12">
			<?= $content ?>
		</div>
		<div class="team-member-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-y-18 mb-12">
			<?php foreach ($team_members as $person) : extract($person); ?>
			<div>
				<img class="mb-4" src="<?= $photo['url'] ?>" alt="<?= $photo['description'] ?>">
				<div class="font-bold text-gray-1100 text-lg leading-6 mb-2"><?= $name ?></div>
				<div class="text-gray-1100 text-sm leading-5"><?= $position ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>