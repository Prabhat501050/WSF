<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>" data-anchor-label="<?= $customBlock->anchorLabel ?>" class=" <?= $customBlock->classesString ?>">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

	<h1>Hello Accordiaon</h1>
	<?php
	$rows = get_field('state_accordion');
	echo '<pre>';
	print_r($rows);
	echo '</pre>';
	?>
</div>