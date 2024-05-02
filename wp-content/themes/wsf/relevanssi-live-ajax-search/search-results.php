<?php
/**
 * Search results are contained within a div.relevanssi-live-search-results
 * which you can style accordingly as you would any other element on your site.
 *
 * Some base styles are output in wp_footer that do nothing but position the
 * results container and apply a default transition, you can disable that by
 * adding the following to your theme's functions.php:
 *
 * add_filter( 'relevanssi_live_search_base_styles', '__return_false' );
 *
 * There is a separate stylesheet that is also enqueued that applies the default
 * results theme (the visual styles) but you can disable that too by adding
 * the following to your theme's functions.php:
 *
 * wp_dequeue_style( 'relevanssi-live-search' );
 *
 * You can use ~/relevanssi-live-search/assets/styles/style.css as a guide to customize
 *
 * @package Relevanssi Live Ajax Search
 */

?>

<?php if (have_posts()) : ?>
<?php
	$status_element = '<div class="relevanssi-live-search-result-status" role="status" aria-live="polite"><p class="text-sm !mb-4">';
	// Translators: %s is the number of results found.
	$status_element .= sprintf(esc_html(_n('%d result found.', '%d results found.', $wp_query->found_posts, 'relevanssi-live-ajax-search')), intval($wp_query->found_posts));
	if ($wp_query->found_posts > 7) {
		$status_element .= ' ' . sprintf(esc_html(__('Press enter to see all the results.', 'relevanssi-live-ajax-search')));
	}
	$status_element .= '</p></div>';

	/**
	 * Filters the status element location.
	 *
	 * @param string The location. Possible values are 'before' and 'after'. If
	 * the value is 'before', the status element will be added before the
	 * results container. If the value is 'after', the status element will be
	 * added after the results container. Default is 'before'. Any other value
	 * will make the status element disappear.
	 */
	$status_location = apply_filters('relevanssi_live_search_status_location', 'before');

	if (!in_array($status_location, ['before', 'after'], true)) {
		// No status element is displayed. Still add one for screen readers.
		$status_location = 'before';
		$status_element = '<p class="screen-reader-text" role="status" aria-live="polite">';
		// Translators: %s is the number of results found.
		$status_element .= sprintf(esc_html(_n('%d result found.', '%d results found.', $wp_query->found_posts, 'relevanssi-live-ajax-search')), intval($wp_query->found_posts));
		$status_element .= '</p>';
	}

	if ('before' === $status_location) {
		// Already escaped.
		echo $status_element; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	?>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-5">
	<?php while (have_posts()): the_post(); ?>
	<a href="<?= esc_url(get_permalink()); ?>" class="block bg-beige p-5 space-y-3 rounded-md" role="option" id="" aria-selected="false">
		<h3 class="leading-none"><?php the_title() ?></h3>
		<p class="text-xs"><?= get_the_excerpt() ?></p>
		<button class="text-red text-xs flex items-center space-x-1 font-bold">
			<span class="inline-block w-4"><?= file_get_contents(get_template_directory() . '/assets/icons/finger-right-red.svg') ?></span>
			<span>Learn more</span>
		</button>
	</a>
	<?php endwhile; ?>
</div>

<?php

	if ('after' === $status_location) {
		// Already escaped.
		echo $status_element; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	?>
<?php else : ?>
<p class="relevanssi-live-search-no-results" role="status">
	<?php esc_html_e('No results found.', 'relevanssi-live-ajax-search'); ?>
</p>
<?php
		if (function_exists('relevanssi_didyoumean')) {
			relevanssi_didyoumean(
				$wp_query->query_vars['s'],
				'<p class="relevanssi-live-search-didyoumean" role="status">'
					. __('Did you mean', 'relevanssi-live-ajax-search') . ': ',
				'</p>'
			);
		}
		?>
<?php endif; ?>