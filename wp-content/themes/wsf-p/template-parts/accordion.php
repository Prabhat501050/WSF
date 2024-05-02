<?php
	$args = wp_parse_args($args, ['items' => [], 'containerClasses' => '']);
?>

<ul class="m-0 text-black divide-gray-400 divide-y border-y border-gray-400 <?= $args['containerClasses'] ?>">
	<?php foreach ($args['items'] as $item) :?>
	<li class="px-4 transition-expo" data-accordion-item>
		<h4 class="flex items-center justify-between hover:cursor-pointer py-6 lg:py-9" data-trigger>
			<span class="transition-expo" data-item-title><?= $item['title'] ?></span>
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path id="maximize" d="M18 13H13V18H11V13H6V11H11V6H13V11H18V13Z" fill="currentColor" class="transition-expo origin-center" />
				<path id="minimize" d="M18 13H6V11H18V13Z" fill="currentColor" class="transition-expo origin-center -rotate-90 opacity-0" />
			</svg>
		</h4>
		<div class="hidden" data-content>
			<div class="-translate-y-6"><?= $item['content'] ?></div>
		</div>
	</li>
	<?php endforeach; ?>
</ul>