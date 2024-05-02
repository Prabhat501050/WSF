<?php
$args = wp_parse_args($args, ['title' => null, 'content' => null, 'image' => null, 'link' => null]);
?>

<div class="bg-white rounded px-5 py-6">
	<div class="aspect-video relative">
		<img src="<?= $args['image']['url'] ?>" alt="" class="w-full object-cover">
		<h2 class="absolute w-full bottom-0 z-10 left-0 text-white "><?= $args['title'] ?></h2>
	</div>
	<div><?= $args['content']['url'] ?></div>
	<a href="<?= $args['link']['url'] ?>"
		class="btn"><?= $args['link']['title'] ?></a>
</div>