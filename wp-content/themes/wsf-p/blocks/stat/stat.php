<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
	extract($blockFields);
} else {
	extract($block['data']);
}

// keep for options of compiling the grid
// grid-cols-4 grid-cols-3 grid-cols-2 grid-cols-1

$container_classes = '';
$content_classes = '';

// switch ($style) {
// 	case 'simple':
// 		$container_classes .= '';
// 		$content_classes .= '';
// 		break;
// 	case 'supporting':
// 		$container_classes .= '';
// 		break;
// }

// Check for background color
$bgColor = '';
if ( $background_type != 'image' && !empty($background_color) ) {
	$bgColor = 'bg-' . $background_color;
}

// Build the block classes array
$blockClasses = [];
if ( !empty($customBlock->classesString) ) $blockClasses[] = $customBlock->classesString;
if ( !empty($customBlock->bgColor) ) $blockClasses[] = $customBlock->bgColor;
if ( !empty($customBlock->paddingStyle) ) $blockClasses[] = $customBlock->paddingStyle;
if ( !empty($container_classes) ) $blockClasses[] = $container_classes;

// Get the base font color from the custom field, and if it exists, add it to the block classes array
$baseFontColor = get_field('base_font_color');
if ( !empty($baseFontColor) ) {
	$blockClasses[] = 'text-'. $baseFontColor;
} else {
	$blockClasses[] = 'text-white';
}

?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class="<?php echo implode(' ', $blockClasses); ?>">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<div class="container <?= $content_classes; ?>">
		<?php

			if ($style == 'simple') {
				echo '<div class="pb-[72px] max-w-[525px] space-y-4 2xl:space-y-6">';
				echo $intro;
				echo '</div>';
			}

			if ($style == 'simple') {
				if (is_array($stats) && count($stats)) {
					echo '<div class="lg:grid grid-cols-' . count($stats) . '">';
					foreach ($stats as $idx => $stat) {
						$grid_class = ($idx) ? 'border-t-4 border-t-tan lg:border-t-0 lg:border-l-4 lg:border-l-tan' : '';

						echo '<div class="grid-item py-5 lg:pl-5 lg:pr-8 ' . $grid_class . '">';
						echo '<div class="heading text-[80px] lg:text-[180px] leading-[1.1] tracking-[0.02em] text-center uppercase mb-5">';
						echo $stat['stat'];
						echo '</div>';
						echo '<div class="text-center text-[18px] leading-[1.56]">';
						echo $stat['description'];
						echo '</div>';
						echo '</div><!-- /.grid-item -->';
					}
					echo '</div><!-- /.grid -->';
				}
			}

			if ($style == 'supporting') {
				echo '<div class="2xl:grid grid-cols-2 justify-between">';

				echo '<div class="grid-item 2xl:w-4/5 w-full 2xl:flex 2xl:column 2xl:items-center">';
				echo '<div class="pb-[72px] 2xl:pb-0 text-black stat-list">';
				echo $intro;
				echo '</div>';

				if (is_array($supporting_columns) && count($supporting_columns)) {
					echo '<div class="2xl:grid grid-cols-' . count($supporting_columns) . '">';
					foreach ($supporting_columns as $col) {
						$multi_column_class = (count($supporting_columns) > 1) ? 'border-l border-l-tan pl-5 pr-8' : '';
						echo '<div class="grid-item mb-8 ' . $multi_column_class . '">';
						echo $col['support'];
						echo '</div><!-- /.grid-item -->';
					}
					echo '</div><!-- /.grid -->';
				}

				if (is_array($cta_link) && isset($cta_link['url'])) {
					echo '<a href="' . $cta_link['url'] . '">' . $cta_link['title'] . '</a>';
				}

				echo '</div><!-- /.grid-item -->';

				echo '<div class="stat-column bg-red-accent text-white relative 2xl:pt-[150px] 2xl:pb-[150px] 2xl:pl-[120px] 2xl:pr-[40px] p-[50px] px-[50px] pt-[80px] pb-[50px] grid-item 2xl:w-half w-full">';

				if (is_array($icon) && isset($icon['url'])) {
					echo '<img src="' . $icon['url'] . '" class="block absolute -top-[60px] left-1/2 -translate-x-1/2 2xl:top-1/2 2xl:left-0 2xl:-translate-y-1/2 2xl:-translate-x-1/2 max-w-[120px] max-h-[120px] 2xl:max-w-[168px] 2xl:max-h-[168px]" alt="' . $icon['alt'] . '" />';
				}

				if (!empty($single_stat)) {
					echo '<div class="heading uppercase text-[100px] 2xl:text-[140px] leading-[0.71] mb-8">';
					echo $single_stat;
					echo '</div>';
				}

				if (!empty($single_description)) {
					echo '<div class="text-[18px] leading-[1.56]">';
					echo $single_description;
					echo '</div>';
				}

				echo '</div><!-- /.stat-column -->';
				echo '</div><!-- /.grid grid-cols-2 -->';
			}
?>

	</div>
	<!-- /.container -->
</div>