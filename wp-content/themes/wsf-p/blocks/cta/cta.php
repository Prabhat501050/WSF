<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

if ( !isset($padding) ) {
	$padding = '';
}

if ( !isset($background_type) ) {
	$background_type = '';
}

if ( !isset($background_color) ) {
	$background_color = '';
}

?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>" data-anchor-label="<?= $customBlock->anchorLabel ?>" class=" <?= $customBlock->classesString ?> relative overflow-hidden bg-red-accent">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<div class="container relative z-10  <?= $customBlock->paddingStyle; ?>">
		<div class="lg:grid lg:grid-cols-2">
			<div class="content text-white">
				<?php echo $content; ?>
			</div>
			<!-- /.content -->

			<div class="buttons text-right lg:flex lg:flex-col lg:justify-center">
				<?php
					if ( isset($buttons) && is_array($buttons) && count($buttons)) {
						$buttonCount = count($buttons);

						echo '<div class="flex gap-4 lg:justify-end">';
						$index = 0;

						foreach ($buttons as $button) {
							$buttonClass = ($index === $buttonCount - 1) ? 'btn-outline' : 'btn-primary-reversed';

							echo '<a class="inline-block w-auto ' . $buttonClass . '" href="' . $button['button']['url'] . '" aria-label="' . $button['button']['title'] . '" target="' . $button['button']['target'] . '">' . $button['button']['title'] . '</a>';

							$index++;
						}
						echo '</div>';
					}
				?>
			</div>
			<!-- /.buttons -->
		</div>

	</div>
	<!-- /.container -->
	<?php if ( $background_image ) { ?>
	<div class="background-image absolute top-0 left-0 w-full h-full">
		<?php
			// do this better
			echo '<img src="'.$background_image['url'].'" class="absolute object-cover w-full h-full" alt="" />';
		?>
	</div>
	<!-- /.background-image -->
	<?php } ?>
</div>
