<?php
$args = wp_parse_args($args, ['post' => null]);
extract($args);
?>
<a href="<?= get_the_permalink($post) ?>" class="block bg-white rounded-md overflow-hidden group mb-[32px] lg:mb-0 last:mb-0"
	aria-label="Read <?= $post->post_title; ?>">
	<div class="aspect-video bg-red-accent/50 relative overflow-hidden">
		<?= get_the_post_thumbnail($post, 'large', ['class' => 'transition-expo w-full h-full object-center object-cover group-hover:scale-105']) ?>
	</div>
	<div class="p-6">
		<p>
			<span
				class="text-red heading text-base"><?= join(', ', array_map(fn ($el) => $el->name, array_filter(get_the_category($post->ID), fn ($cat) => $cat->slug !== 'uncategorized'))) ?></span>
			<span class="inline-block ml-1 text-xs text-gray-600"><?= get_the_date('M d, Y') ?></span>
		</p>
		<p class="mt-[8px] lg:text-lg"><?= $post->post_title ?></p>
	</div>
</a>