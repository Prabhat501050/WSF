<?php
$copyright = get_field('footer_copyright', 'options');
$cta = get_field('footer_cta', 'options');
$facebook = get_field('facebook_url', 'options');
$twitter = get_field('twitter_url', 'options');
$instagram = get_field('instagram_url', 'options');
$linkedin = get_field('linkedin_url', 'options');
$youtube = get_field('youtube_url', 'options');
$site_title = get_bloginfo('title');
$logo = get_field('footer_logo', 'options');
$m_logo = get_field('mobile_logo', 'options');
$footer_links = get_field('footer_links', 'options');
?>
<footer class="bg-red-accent text-white xl:py-32 py-24 space-y-14">
	<div class="container xl:flex space-y-6 xl:space-y-0 xl:justify-between xl:space-x-4 xl:space-x-0">
		<?php if ($logo) {
			echo '<a href="/" aria-label="' . $site_title . ' Home">';
			echo '<div>' . $logo['html'] . '</div>';
			echo '</a>';
		}
?>
		<div>
			<p class="heading text-beige h-overline mb-6 leading-none">Quick links</p>
			<?php
		wp_nav_menu([
			'menu_class' => 'grid grid-cols-2 gap-6 heading leading-none max-w-[500px]',
			'container' => false,
			'walker' => new CustomMenu(),
			'theme_location' => 'footer-menu'
		]);
?>
		</div>
		<div class="xl:max-w-xs space-y-4">
			<?php
		if ($m_logo) {
			echo '<a href="/" aria-label="' . $site_title . ' Home">';
			echo '<div class="block sm:hidden">' . $m_logo['html'] . '</div>';
			echo '</a>';
		}
?>
			<?= $cta; ?>
		</div>
	</div>

	<div class="container">
		<hr>
	</div>

	<!-- Desktop -->
	<div class="container xl:flex xl:items-center xl:justify-between heading xl:text-xl space-y-5 xl:space-y-0 sm:mt-48 ">
		<nav class="flex items-center justify-center xl:justify-start space-x-8 xl:hidden xl:visible mb-6">
			<a href="<?= $twitter; ?>" aria-label="Visit <?= $site_title; ?> Twitter"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/twitter.svg') ?></a>
			<a href="<?= $facebook; ?>" aria-label="Visit <?= $site_title; ?> Facebook"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/facebook.svg') ?></a>
			<a href="<?= $instagram; ?>" aria-label="Visit <?= $site_title; ?> Instagram"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/instagram.svg') ?></a>
			<a href="<?= $linkedin; ?>" aria-label="Visit <?= $site_title; ?> Linkedin"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/linkedin.svg') ?></a>
			<a href="<?= $youtube; ?>" aria-label="Visit <?= $site_title; ?> Youtube"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/youtube.svg') ?></a>

		</nav>
		<span class="block mx-auto text-center relative m-0 w-64 xl:text-left xl:w-auto xl:mx-0"><?= $copyright; ?></span>
		<?php
if (is_array($footer_links) && count($footer_links)) {
	echo '<ul class="text-center mx-auto xl:flex xl:items-center xl:space-x-5 space-y-4 xl:space-y-0 w-48 xl:w-auto xl:mx-auto xl:mt-0">';
	foreach ($footer_links as $footer_link) {
		if (isset($footer_link['footer_link'])) {
			$link = $footer_link['footer_link'];
			$url = $link['url'];
			$title = $link['title'];
			echo '<li class="text-center xl:text-left">';
			echo '<a href="' . $url . '" aria-label="' . $title . '">' . $title . '</a>';
			echo '<li>';
		}
	}
	echo '</ul>';
}
?>
		<nav class="items-center justify-center xl:justify-start space-x-8 hidden xl:flex">
			<a href="<?= $twitter; ?>" aria-label="Visit <?= $site_title; ?> Twitter"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/twitter.svg') ?></a>
			<a href="<?= $facebook; ?>" aria-label="Visit <?= $site_title; ?> Facebook"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/facebook.svg') ?></a>
			<a href="<?= $instagram; ?>" aria-label="Visit <?= $site_title; ?> Instagram"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/instagram.svg') ?></a>
			<a href="<?= $linkedin; ?>" aria-label="Visit <?= $title; ?> Linkedin"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/linkedin.svg') ?></a>
			<a href="<?= $youtube; ?>" aria-label="Visit <?= $title; ?> Youtube"
				class="block w-6 h-6"><?= file_get_contents(get_template_directory() . '/assets/icons/youtube.svg') ?></a>

		</nav>
	</div>
</footer>