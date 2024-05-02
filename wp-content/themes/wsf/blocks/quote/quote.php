<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);
if (is_array($blockFields)) {
	extract($blockFields);
}
if (!isset($padding)) {
	$padding = '';
}
$icon = file_get_contents(get_template_directory() . '/assets/icons/quote.svg');
?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	class="<?= $customBlock->paddingStyle; ?> <?= $customBlock->classesString ?> text-center bg-red-accent text-white relative overflow-hidden block">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<div class="quotes relative z-10">
		<div class="quote--icon items-center flex justify-center align-center"><?= $icon; ?></div>
		<div class="glide">
			<div class="glide__track max-w-[864px] mx-auto" data-glide-el="track">
				<ul class="glide__slides">
					<?php
						foreach ($quotes as $qt) {
							echo '<div class="glide__slide slide">';
							echo '<div class="quote lg:mb-12">';
							echo $qt['quote'];
							echo '</div>';
							if (isset($qt['attribution']) && !empty($qt['attribution'])) {
								echo '<div class="attribution text-beige text-base">';
								echo $qt['attribution'];
								echo '</div>';
							}
							echo '</div>';
						}
?>
				</ul><!-- /.glide__slides -->
			</div><!-- /.glide__track -->

			<?php  if(sizeOf($quotes) > 1): ?>
			<div class="absolute bottom-[-35%] lg:top-1/2 left-0 -translate-y-1/2 right-0 flex items-center justify-between pointer-events-none px-4" data-glide-el="controls">
				<button class="bg-red bg-fingerLeftWhite bg-center bg-no-repeat w-12 h-12 rounded-full pointer-events-auto" data-glide-dir="&lt;"></button>
				<button class="bg-red bg-fingerRightWhite bg-center bg-no-repeat w-12 h-12 rounded-full pointer-events-auto" data-glide-dir="&gt;"></button>
				<?php endif; ?>
			</div>
		</div>
		<!-- /.glide -->

		<?php if (isset($bg_img) && !empty($bg_img)) {
			echo '<div class="quote--bg z-1 absolute w-full h-full top-0 left-0">' . $bg_img['html'] . '</div>';
		}?>
		<!-- /.quotes -->

	</div>
</div>