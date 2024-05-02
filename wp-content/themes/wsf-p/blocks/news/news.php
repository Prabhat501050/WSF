<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

$categories = get_categories(['hide_empty' => false]);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

$postArgs = [
	'post_type' => 'post',
	'posts_per_page' => (isset($type) && $type === 'featured') ? 4 : 9,
	'paged' => $paged
];

if (isset($type) && $type === 'featured') {
	$post_ids = [];
	foreach ($featured_news as $news) {
		if ($news['news']) {
			$post_ids[] = $news['news']->ID;
		}
	}
	$postArgs['post__in'] = $post_ids;
	$postArgs['order'] = 'ASC';
	$postArgs['orderby'] = 'post__in';
}

if (isset($_GET['category'])) {
	$postArgs['category__in'] = $_GET['category'];
}

$allClasses = isset($_GET['category']) ? '' : 'bg-red text-white';

$q = new WP_Query($postArgs);

$posts = $q->posts;

$type ??= 'full';
?>
<script>
	const baseUrl = '<?= get_the_permalink() ?>';
</script>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class=" <?= $customBlock->classesString ?> bg-beige/60 <?= $customBlock->paddingStyle; ?> relative">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

	<?php if (isset($type) && $type == 'full') { ?>
	<nav class="container lg:flex lg:items-center lg:space-x-2 xl:space-x-8">
		<button class="heading p-2 px-4 tracking-wide lg:text-xl hover:bg-red hover:text-white transition-expo <?= $allClasses ?>" data-all-categories>All categories<button>
				<?php foreach ($categories as $category) : ?>
				<button
					class="heading p-2 px-4 tracking-wide lg:text-xl hover:bg-red hover:text-white transition-expo <?= isset($_GET['category']) && $category->term_id == $_GET['category'] ? 'bg-red text-white' : '' ?>"
					data-category="<?= $category->term_id ?>">
					<?= $category->name ?>
					<button>
						<?php endforeach; ?>
	</nav>
	<?php } ?>

	<div class="bg-beige py-16 space-y-12 z-[2] relative">

		<?php if (isset($type) && $type == 'full') { ?>
		<div class="container space-y-5 md:space-y-0 md:grid md:grid-cols-2 md:gap-8 lg:grid-cols-3 lg:gap-y-16 lg:gap-x-8">
			<?php foreach ($posts as $post) :?>
			<?php get_template_part('template-parts/news-card', null, ['post' => $post]); ?>
			<?php endforeach; ?>
		</div>
		<?php } ?>

		<?php if (isset($type) && $type == 'featured') { ?>
		<div class="container">
			<div class="first-row lg:grid lg:grid-cols-2 lg:gap-x-6 lg:gap-y-6 mb-6 animate-in">
				<div class="content relative">
					<h2 class=" mb-[48px] lg:mb-0 text-[90px] sm:text-headline lg:text-[220px] leading-[.73] tracking-[0.02em] uppercase text-charcoal"><?= $heading; ?></h2>
					<div class="copy mb-[24px] lg:mb-0 lg:absolute top-0 left-[270px] lg:max-w-[300px] text-[36px] leading-[.89] text-charcoal">
						<?= $content; ?>
					</div>
					<!-- /.copy -->
				</div>
				<!-- /.content -->
				<div class="featured-post">
					<?php get_template_part('template-parts/news-card', null, ['post' => $posts[0]]); ?>
				</div>
				<!-- /.featured-post -->
			</div>
			<!-- /.first-row -->

			<div class="second-row lg:grid lg:grid-cols-3 lg:gap-x-6 lg:gap-y-6 animate-in animate-children">
				<?php get_template_part('template-parts/news-card', null, ['post' => $posts[1]]); ?>
				<?php get_template_part('template-parts/news-card', null, ['post' => $posts[2]]); ?>
				<?php get_template_part('template-parts/news-card', null, ['post' => $posts[3]]); ?>
			</div>
			<!-- /.second-row -->

		</div>
		<?php } ?>

		<?php if (isset($type) && $type == 'full') { ?>
		<div class="container flex items-center justify-between lg:max-w-6xl">
			<?php previous_posts_link('Previous'); ?>
			<p class="text-sm font-inter text-charcoal mx-auto my-0">Showing
				<b><?= $paged * 9 - 8  ?>-<?= $paged === intval($q->max_num_pages) ? $paged * 9 - $paged * 9 - $q->found_posts : $paged * 9 ?></b>
				of
				<b><?= $q->found_posts ?></b>
			</p>
			<?php next_posts_link('Next', $q->max_num_pages); ?>
		</div>
		<?php } ?>
	</div>
	<?php if ( !empty($background_image) ) :?>
	<div class="absolute z-[1] bottom-0 left-0 w-full h-[300px] md:h-auto bg-beige">
		<div class="relative w-full h-full z-[1] overflow-hidden  img-bg">
			<?= wp_get_attachment_image($background_image['ID'], 'original', false, ['class' => 'block object-cover w-full h-full']) ?>
		</div>
	</div>
	<?php endif; ?>
</div>