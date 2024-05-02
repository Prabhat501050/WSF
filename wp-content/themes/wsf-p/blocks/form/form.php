<?php
$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}
?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class=" <?= $customBlock->classesString ?> <?= $customBlock->paddingStyle; ?> <?= $customBlock->bgColor; ?> relative">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<div class="container relative z-20">
		<div class="lg:grid grid-cols-2">
			<div class="grid-item pb-8  lg:w-full w-[90%] my-0 mx-auto">
				<?= $content; ?>
			</div>
			<!-- /.grid-item -->
			<div class="grid-item lg:w-full w-[90%] my-0 mx-auto">
				<?= $form_shortcode; ?>
			</div>
			<!-- /.grid-item -->
		</div>
		<!-- /.grid grid-cols-2 -->
	</div>
	<!-- /.container -->

	<div class="container">
		<div class="w-full mx-auto mb-0 mt-14 lg:mt-[150px] py-14 lg:py-[72px] px-6 lg:px-[72px] relative z-10 bg-<?= $background_color_columns; ?>">
			<?php if ($intro_content) { ?>
			<div class="form--intro mb-5 lg:mb-10"><?= $intro_content; ?></div>
			<?php } ?>
			<?php
				if ($form_columns) :
					echo '<div class="block lg:flex lg:flex-row lg:gap-14 lg:justify-start">';
					foreach ($form_columns as $form_column) :
						echo '<div class="w-full lg:w-1/2 border-l-2 border-tan pl-7  mb-5 lg:mb-0 ">';
						echo '<div class="mb-3">' . $form_column['column_icon']['html'] . '</div>';
						echo '<div class="wysiwyg">' . $form_column['column_content'] . '</div>';
						echo '</div>';
					endforeach;
					echo '</div>';
				endif;
?>
		</div>
	</div>
	<?php
	if ($background_image_columns) {
		echo '<div class="absolute z-[1] bottom-0 left-0 w-full h-auto' . $customBlock->bgColor . '">';
		echo '<div class="relative w-full h-full z-[1] overflow-hidden img-bg">';
		echo $background_image_columns['html'];
		echo '</div>';
		echo '</div>';
	}
?>
</div>