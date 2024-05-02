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
?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class="<?= $customBlock->bgColor; ?> <?= $customBlock->classesString ?> <?= $customBlock->paddingStyle; ?> overflow-hidden">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

	<div class="brands w-full glide overflow-visible">

		<div class="glide__track w-full" data-glide-el="track">
			<ul class="glide__slides overflow-visible">
				<?php
					if ($brands) {
						foreach ($brands as $i => $b) {
							$brand = $b['brand'];
							$brandLogo = get_field('logo', $brand->ID);
							$brandUrl = get_the_permalink($brand->ID);
							$brandClass = $i == 0 ? 'ml-[60px] lg:ml-[100px]' : '';

							echo '<li class="block w-[200px] h-[150px] lg:w-[300px] pl-5 pr-5 shrink-0 ' . $brandClass . '">';
							echo '<a href="' . $brandUrl . '" class="glide__slide brand">';
							echo '<img src="' . $brandLogo['sizes']['medium_large'] . '" class="w-full h-full object-contain">';
							echo '</a>';
							echo '</li>';
						}

						echo '<li class="block w-[300px] h-[150px] pl-5 pr-5 shrink-0 ' . $brandClass . '"></li>';
					}
?>
			</ul>
		</div>

		<div class="absolute top-1/2 left-0 -translate-y-1/2 right-0 flex items-center justify-between pointer-events-none px-4" data-glide-el="controls">
			<button class="bg-red bg-fingerLeftWhite bg-center bg-no-repeat w-12 h-12 rounded-full pointer-events-auto" data-glide-dir="&lt;"></button>
			<button class="bg-red bg-fingerRightWhite bg-center bg-no-repeat w-12 h-12 rounded-full pointer-events-auto" data-glide-dir="&gt;"></button>
		</div>

	</div>

</div>