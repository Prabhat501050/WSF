<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

$image_classes = [
	[
		'max-w-full max-h-none object-cover lg:w-[712px] lg:h-[712px]'
	],
	[
		'max-w-full max-h-none object-cover lg:w-[365px] lg:h-[424px] lg:absolute lg:top-1/2 z-10 lg:-translate-y-1/2',
		'max-w-full max-h-none object-cover lg:w-[551px] lg:h-[640px] hidden lg:block absolute top-1/2 -translate-y-1/2'
	],
	[
		'max-w-full max-h-none object-cover lg:w-[304px] lg:h-[171px] lg:absolute z-30 lg:-translate-y-1/2',
		'max-w-full max-h-none object-cover w-[365px] h-[424px] hidden lg:block lg:absolute top-1/2 mt-[250px] z-20 -translate-y-1/2',
		'max-w-full max-h-none object-cover w-[365px] h-[424px] hidden lg:block lg:absolute top-1/2 z-10 lg:w-[712px] lg:h-[712px] -translate-y-1/2'
	]
];

switch ($content_placement) {
	case 'content-left':
		$feature_classes = '';
		$content_classes = '';
		$container_classes = 'lg:flex-row-reverse';
		// single image classes
		$image_classes[0][0] = $image_classes[0][0] . ' lg:translate-x-1/4';
		// double image classes
		$image_classes[1][0] = $image_classes[1][0] . ' left-0 lg:translate-x-[112px]';
		$image_classes[1][1] = $image_classes[1][1] . ' left-0 lg:translate-x-[272px]';
		// triple image classes
		$image_classes[2][0] = $image_classes[2][0] . ' left-0 lg:translate-x-[472px]';
		$image_classes[2][1] = $image_classes[2][1] . ' left-0 lg:translate-x-[30px]';
		$image_classes[2][2] = $image_classes[2][2] . ' left-0 lg:translate-x-[112px]';

		break;

	case 'content-right':
		$feature_classes = '';
		$content_classes = 'ml-auto';
		$container_classes = '';
		// single image classes
		$image_classes[0][0] = $image_classes[0][0] . ' lg:-translate-x-1/4';
		// double image classes
		$image_classes[1][0] = $image_classes[1][0] . ' right-0 lg:-translate-x-[112px]';
		$image_classes[1][1] = $image_classes[1][1] . ' right-0 lg:-translate-x-[272px]';
		// triple image classes
		$image_classes[2][0] = $image_classes[2][0] . ' right-0 lg:-translate-x-[472px]';
		$image_classes[2][1] = $image_classes[2][1] . ' right-0 lg:-translate-x-[30px]';
		$image_classes[2][2] = $image_classes[2][2] . ' right-0 lg:-translate-x-[112px]';

		break;
}

?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class=" <?= $customBlock->classesString ?> relative overflow-hidden <?= $content_placement; ?> <?= $customBlock->bgColor; ?> <?= $customBlock->paddingStyle; ?>">

	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

	<div class="container lg:flex items-center <?= $container_classes; ?>">

		<div class="feature relative h-full lg:min-h-[712px] lg:w-1/2 <?= $feature_classes; ?>">
			<?php
			if (in_array($style_of_feature, ['images', 'accordion'])) :
				foreach ($images as $idx => $img) :

					switch ($idx) {
						case 0:
							$speed = 6;
							$zIndex = 30;	
							break;

						case 1:
							$speed = 4;
							$zIndex = 20;
							break;
	
						default:
							$speed = 2;
							$zIndex = 10;	
							break;
					}

					echo '<div class="my-4 lg:absolute top-0 left-0 lg:w-full lg:h-full z-' . $zIndex . '" data-parallax data-rellax-speed="' . $speed . '" >';
					echo wp_get_attachment_image(
						$img['image']['ID'],
						'original',
						false,
						['class' => $image_classes[count($images) - 1][$idx]]
					);
					echo '</div>';
				endforeach;
endif;
?>
		</div>
		<!-- /.feature -->

		<div class="content lg:w-1/2 space-y-4 lg:space-y-6 animate-in <?= $content_classes; ?>">
			<?php
	if ($style_of_feature == 'images') {
		echo $content;
	}
	if ($style_of_feature == 'accordion') {
		if (is_array($accordion) && count($accordion)) {
			foreach ($accordion as $section) {
				echo '<div class="accordion border-l-red-accent border-l-2 p-4">';
				// font-family: 'Knockout HTF68-FullFeatherwt';
				// font-feature-settings: 'pnum' on, 'lnum' on;
				echo '<h3 class="text-[84px] text-red-accent cursor-pointer leading-[.74] tracking-[0.02em] pb-4 transition-expo">' . $section['heading'] . '</h3>';

				echo '<div class="expander transition-expo pointer-events-none opacity-100 translate-y-0">';
				echo $section['content'];
				echo '</div><!-- /.expander -->';
				echo '</div>';
			}
		}
	}
?>
		</div>
		<!-- /.content -->

	</div>
	<!-- /.container -->
</div>