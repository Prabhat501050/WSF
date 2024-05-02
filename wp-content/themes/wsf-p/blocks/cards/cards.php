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
	class=" <?= $customBlock->classesString ?> layout--<?= $layout; ?> intro-size--<?= $intro_container_size; ?> <?= $customBlock->bgColor; ?> <?= $customBlock->paddingStyle; ?> relative overflow-hidden">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<div class="container relative z-10">
		<?php
			if ($extra_link) {
				echo '<div class="text-white animate-in full block lg:grid lg:grid-cols-2 lg:gap-8 items-center">';
				echo '<div class="text-left ">' . $intro . '</div>';
				echo '<div class="lg:text-right "><a href="' . $extra_link['url'] . '" class="btn-primary btn-finger-white" aria-label="' . $extra_link['title'] . '">' . $extra_link['title'] . '</a></div>';
				echo '</div>';
				?>
		<?php } else {?>
		<div class="text-white animate-in mb-8 <?= ($intro_container_size !== 'full') ? 'max-w-[640px]' : ''; ?>">
			<?= $intro; ?>
			<?php
							if (isset($extra_link) && !empty($extra_link['url'])) {
								echo '<a href="' . $extra_link['url'] . '" class="btn-primary btn-finger-white" aria-label="' . $extra_link['title'] . '">' . $extra_link['title'] . '</a>';
							}
			?>
		</div>
		<?php } ?>
		<?php
			// setup some vars
			$is_carousel = (count($cards) > 3 && $layout != 'grid');
			$container_class = ($is_carousel) ? 'glide' : '';
			if ($is_carousel) {
				$container_class = 'glide animate-in';
			} else {
				if (isset($layout) && $layout == 'grid') {
					$container_class = 'lg:grid grid-cols-2 gap-8 animate-in animate-children';
				} else {
					// standard
					$container_class = 'lg:grid grid-cols-3 gap-8 animate-in animate-children';
				}
			}
		?>
		<div class="cards <?= $container_class; ?>">
			<?php
				if ( $is_carousel ) {
					echo '<div class="glide__track" data-glide-el="track">';
					echo '<ul class="glide__slides flex items-stretch">';
				}
				foreach ($cards as $card) {
					echo '<div class="glide__slide group !mx-0 !h-auto card px-5 py-6 mb-8 lg:mb-0 rounded bg-white">';
					if ( is_array($card['url']) && isset($card['url']) ) {
						echo '<a href="' . $card['url']['url'] . '" aria-label="' . $card['url']['title'] . '"  target="' . $card['url']['target'] . '" class="block">';
					}
						echo '<div class="image-holder mb-6 relative overflow-hidden aspect-video">';
							echo '<div class="bg-gradient bg-gradient-to-b from-transparent to-black group-hover:scale-100  z-10 absolute h-full w-full opacity-50"></div><!-- /.bg-gradient -->';
							if ( !empty($card['image']['url']) ) {
								$image_alt = '';
								if ( !empty($card['image']['alt']) ) {
									$image_alt = $card['image']['alt'];
								} else if ( !empty($card['title']) ) {
									$image_alt = $card['title'];
								}
								echo '<img src="' . $card['image']['url'] . '" alt="'. $image_alt .'" class="object-cover object-center transition-expo group-hover:scale-105" />';
							}
							echo '<span class="title font-heading text-[36px] leading-[1] z-20 absolute bottom-0 left-0 text-white pb-2 pl-3 uppercase">' . $card['title'] . '</span>';
						echo '</div><!-- /.image-holder -->';

						if ( !empty($card['content']) ) {
							echo '<div class="content pb-6">';
								echo $card['content'];
							echo '</div><!-- /.content -->';
						}
						if ( is_array($card['url']) && isset($card['url']) ) {
							echo '<div class="lg:grid lg:grid-cols-2 lg:gap-8 relative">';
								echo '<span class="link-label font-heading text-[20px] text-red uppercase">' . $card['url']['title'] . '</span>';
								echo '<span class="reltive finger-red"></span>';
							echo '</div>';
						}
					if ( is_array($card['url']) && isset($card['url']) ) {
							echo '</a><!-- /.card -->';
					}
					echo '</div>';
				}
				if ($is_carousel) {
					echo '</ul><!-- /.glide__slides -->';
					echo '</div><!-- /.glide__track -->';
				}
			?>
		</div>
		<!-- /.cards -->
	</div>
	<!-- /.container -->
	<div class="<?= $customBlock->bgContainer; ?>"><?= $customBlock->bgImg; ?></div>

</div>