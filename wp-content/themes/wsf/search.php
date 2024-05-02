<?php
global $wp_query;

get_header();
?>

<section class="py-32">
	<div class="container">

		<?php if (have_posts()) : ?>

		<h1 class="mb-8"><?= $wp_query->found_posts ?> results for: <span><?= get_search_query(); ?></span></h1>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
			<?php while (have_posts()) : the_post(); ?>
			<a href="<?= esc_url(get_permalink()); ?>" class="block bg-beige p-5 space-y-3 rounded-md" role="option" id="" aria-selected="false">
				<h3 class="leading-none flex items-center justify-between">
					<span><?php the_title() ?></span>
					<span class="font-heading text-lg"><?= get_post_type() ?></span>
				</h3>
				<p class="text-sm"><?= get_the_excerpt() ?></p>
				<button class="text-red text-xs flex items-center space-x-1 font-bold">
					<span class="inline-block w-4"><?= file_get_contents(get_template_directory() . '/assets/icons/finger-right-red.svg') ?></span>
					<span>Learn more</span>
				</button>
			</a>
			<?php endwhile; ?>
		</div>

		<?php
		else:
			echo '<h1 class="__title">Sorry, no results were found for: <span>' . get_search_query() . '</span></h1>';
		endif;
?>

	</div>
</section>

<?php
get_footer();
?>