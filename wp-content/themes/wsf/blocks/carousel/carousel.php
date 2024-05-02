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
	class="<?= $customBlock->classesString ?> <?= $customBlock->bgColor; ?> <?= $customBlock->paddingStyle; ?>">

	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<?php if (isset($caption_placement)) {
		echo '<div class="container">';
	}; ?>
	<?php 
		if (isset($intro_copy) && !empty($intro_copy)) {
			$classes = 'lg:';
			if (isset($intro_copy_width) && !empty($intro_copy_width)) {
				$classes .= $intro_copy_width;
			}
			$classes .= ' w-full mx-auto mt-0 mb-[35px] lg:mb-[65px]';
			echo '<div class="' . $classes . '">' . $intro_copy . '</div>';
		}
	?>


	<?php if (isset($slides)) :?>
	<div class="glide relative md:px-14">
		<div class="glide__track" data-glide-el="track">
			<ul class="glide__slides">
				<?php foreach ($slides as $slide) :?>
				<?php if (isset($caption_placement) && $caption_placement === 'ontop') : ?>
				<div class="glide__slide aspect-square max-w-[740px] relative group">
					<?php if ($slide['image']) :?>
					<img src="<?= $slide['image']['url'] ?>" class="object-cover overflow-hidden w-full h-full"
						alt="<?= $slide['image']['alt'] ?>" />
					<?php endif; ?>
					<?php if (isset($slide['caption']) && !empty($slide['caption'])) :?>
					<div class="absolute top-0 left-0 w-full h-full transition-expo opacity-0 bg-red-accent/80 text-white group-hover:opacity-100 flex flex-col items-center justify-center">
						<div class="transition-expo scale-125 group-hover:scale-100 w-36 opacity-50 mb-11">
							<?= file_get_contents(get_template_directory() . '/assets/icons/chicken.svg') ?>
						</div>
						<div class="transition-expo translate-y-16 opacity-0 group-hover:translate-y-0 group-hover:opacity-100">
							<?= $slide['caption'] ?>
							<?php if (isset($slide['link']) && !empty($slide['link'])) :?>
							<a class="btn" href="<?= $slide['link']['url']; ?>"
								aria-label="<?= $slide['link']['title']; ?>"
								target="<?= $slide['link']['target']; ?>"><?= $slide['link']['title']; ?></a>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php else : ?>
				<div class="glide__slide aspect-square max-w-[425px] relative group bg-white p-5 rounded-md">
					<div class="realtive">
						<div class="aspect-video overflow-hidden relative w-full h-[230px]">
							<?php if ($slide['image']) :?>
							<img src="<?= $slide['image']['url'] ?>"
								class="z-1 transition-expo w-full h-full object-center object-cover group-hover:scale-105 wp-post-image"
								alt="<?= $slide['image']['alt'] ?>" />
							<?php endif; ?>
							<?php if (isset($slide['title']) && !empty($slide['title'])) :?>
							<div class="text-white absolute bottom-0 left-0 w-full p-2 heading text-3xl tracking-2 leading-6"><?= $slide['title']; ?></div>
							<?php endif; ?>
						</div>
						<div class="mx-0 my-3">
							<?= $slide['caption'] ?>
						</div>
						<div>
							<?php if (isset($slide['link']) && !empty($slide['link'])) :?>
							<a class="flex justify-between items-center w-[calc(100%-40px)] absolute left-5 bottom-5 heading text-xl leading-4 text-red btn-finger-red"
								href="<?= $slide['link']['url']; ?>"
								aria-label="<?= $slide['link']['title']; ?>"
								target="<?= $slide['link']['target']; ?>"><?= $slide['link']['title']; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="md:absolute md:top-1/2 md:left-0 md:-translate-y-1/2 md:right-0 flex items-center justify-between pt-12 md:pt-0 pointer-events-none" data-glide-el="controls">
			<button class="bg-red bg-fingerLeftWhite bg-center bg-no-repeat w-12 h-12 rounded-full pointer-events-auto" data-glide-dir="&lt;"></button>
			<button class="bg-red bg-fingerRightWhite bg-center bg-no-repeat w-12 h-12 rounded-full pointer-events-auto" data-glide-dir="&gt;"></button>
		</div>
		<div class="flex items-center justify-center space-x-3 md:pt-12" data-glide-el="controls[nav]">
			<?php foreach ($slides as $idx => $slide) :?>
			<button class="glide__bullet bg-beige w-[12px] h-[12px] rounded-full transition-expo" data-glide-dir="=<?= $idx ?>"></button>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>

	<?php if (isset($caption_placement)) {
		echo '</div>';
	}; ?>
</div>