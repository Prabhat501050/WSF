<!DOCTYPE html>
<html class="no-js <?= isset($_GET['grid']) ? 'debug' : '' ?>" <?php language_attributes(); ?>>

<?php
$favicon = get_field('favicon', 'options');
?>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<?php if ($favicon) :?>
	<link rel="icon" type="image/png" href="<?= $favicon['url'] ?>">
	<?php else: ?>
	<link href="<?= get_template_directory_uri() ?>/assets/images/favicon16.png" rel="icon" sizes="16x16" type="image/png">
	<link href="<?= get_template_directory_uri(); ?>/assets/images/favicon32.png" rel="icon" sizes="32x32" type="image/png">
	<link href="<?= get_template_directory_uri(); ?>/assets/images/favicon96.png" rel="icon" sizes="96x96" type="image/png">
	<?php endif; ?>

	<title><?php wp_title(); ?></title>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAw73Y1iq1OAfaE4SzudVqp8d8_qLNg3B4&callback=Function.prototype"></script>

	<?= get_field('global_header_scripts', 'option'); ?>
	<?= get_field('content_header_scripts'); ?>

	<?php wp_head(); ?>

</head>

<body class="overflow-x-hidden <?= get_field('add_alert_bar') == '1' ? 'pt-[68px] bg-beige' : '' ?>">

	<?php wp_body_open(); ?>

	<a href="#pxMainContent" class="skip_to_main_link"><?= get_field('skip_content_label', 'option') ?></a>

	<?php if (!isset($_COOKIE['acceptedCookiePrompt']) && get_field('activate_gdpr', 'option')) : ?>
	<div role="region" aria-label="<?php _e('Cookie consent banner', 'pxdomain') ?>" class="cookie-banner">
		<div class="container">
			<p><?= get_field('gdpr_label', 'option') ?></p>
			<div class="cookie-banner__actions">
				<button class="accept"><?php _e('Accept', 'pxdomain') ?></button>
				<button class="dismiss"><?php _e('Dismiss', 'pxdomain') ?></button>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<header class="fixed top-0 left-0 right-0 z-50" id="wsf-site-header">
		<?php
			$alert = get_field('add_alert_bar');
$alert_class = ($alert == '1') ? 'lg:rounded-b-none' : '';
?>
		<nav class="flex items-center py-3 lg:py-0 justify-between mt-0 lg:mt-5 container bg-white shadow-lg lg:rounded-md relative <?= $alert_class; ?>" id="header-main-nav">
			<a href="/" aria-label="Home" class="block max-w-[140px] object-contain object-center">
				<?php if(empty(get_field('site_logo', 'option'))) : ?>
				<?= file_get_contents(get_template_directory() . '/assets/images/logo.svg'); ?>
				<?php elseif(!empty(get_field('site_logo', 'option')['svg'])) : ?>
				<?= get_field('site_logo', 'option')['svg']; ?>
				<?php else : ?>
				<?= get_field('site_logo', 'option')['html']; ?>
				<?php endif; ?>
			</a>

			<?php
		if (has_nav_menu('main-menu')) :

			wp_nav_menu([
				//'menu' => 'Main Menu',
				'menu_class' => 'hidden lg:flex items-center ',
				'container' => false,
				'walker' => new CustomMenu(),
				'theme_location' => 'main-menu'
			]);

		else :
			echo 'Main Menu Not Found';
		endif;
?>

			<div class="space-x-5 flex items-center">
				<button class="text-red transition hover:text-red-accent" id="header-nav-search-trigger">
					<?= file_get_contents(get_template_directory() . '/assets/icons/search.svg'); ?>
				</button>

				<button class="block relative visible w-12 h-12 lg:hidden site-header__mobile-trigger" aria-expanded="false" aria-controls="menu">
					<svg width="100%" height="100%" viewBox="0 0 100 100">
						<path fill="none" stroke="#b11f28" stroke-width="6" class="transition-expo line1" stroke-dasharray="60 207"
							d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
						<path fill="none" stroke="#b11f28" stroke-width="6" class="transition-expo line2" stroke-dasharray="60 60" d="M 20,50 H 80" />
						<path fill="none" stroke="#b11f28" stroke-width="6" class="transition-expo line3" stroke-dasharray="60 207"
							d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
					</svg>
				</button>
			</div>

		</nav>


		<?= get_template_part('template-parts/alert') ?>

		<?= get_template_part('template-parts/header-search'); ?>
	</header>

	<nav id="wsf-mobile-menu" class="pt-headerMobile lg:pt-headerDesktop transition-expo fixed h-screen w-screen bottom-0 right-0 translate-x-full pointer-events-none lg:hidden z-40 bg-white overflow-y-auto">
		<?php
			wp_nav_menu([
				'menu_class' => '',
				'container' => false,
				'walker' => new MobileMenuWalker(),
				'theme_location' => 'main-menu'
			]);
?>
	</nav>


	<main id="pxMainContent" class="relative">