<?php
	$blockFields = get_fields();
	$customBlock = PXUtils::parse_custom_block($block, $blockFields);

	if (is_array($blockFields)) {
		extract($blockFields);
	} else {
		extract($block['data']);
	}

	if (!isset($caption)) {
		$caption = '';
	}

	$cap = '';
	if (isset($caption)){
		$cap .= '<div class="mt-5 lg:mt-8">' . $caption . '</div>';
	} 

?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>" data-anchor-label="<?= $customBlock->anchorLabel ?>" class=" <?= $customBlock->classesString ?> <?= $customBlock->bgColor; ?> <?= $customBlock->paddingStyle; ?>">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<?php 

		if($media_type == 'image' && !empty($image)) {
			echo '<div class="container img-full animate-in">';
				echo $image['html'];
				echo $cap;
			echo '</div>';
		} 
		if($media_type == 'video-link' && !empty($video_link)) {
			echo '<div class="container iframe animate-in media--full">';
				echo $video_link;
				echo $cap;
			echo '</div>';
		}

		if($media_type == 'video-file' && !empty($video_file)) {
			echo '<div class="container iframe animate-in media--full">';
				$atts = '';

				if ($controls == 'yes' && $autoplay == 'yes') {
					$atts .= 'controls autoplay muted loop playsinline ';
				} elseif ($controls == 'yes') {
					$atts .= 'controls ';
				} elseif ($autoplay == 'yes') {
					$atts .= 'autoplay muted loop playsinline ';
				}

				echo '<video src="'.$video_file['url'].'" '.$atts.'></video>';
				echo $cap;

			echo '</div>';
		}
	?>
	</div>
	<!-- /.container -->
</div>