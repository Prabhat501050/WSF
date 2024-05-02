<?php
	$blockFields = get_fields();
	$customBlock = PXUtils::parse_custom_block($block, $blockFields);

	if (is_array($blockFields)) {
		extract($blockFields);
	} else {
		extract($block['data']);
	}

	$bgColor = '';
	if ($background_type == 'image') {
	} else {
		$bgColor .= 'bg-' . $background_color . '';
	}

	$perRow = '';
	if (isset($per_row)){
		$perRow .= ''.$per_row.'';
	} else { 
		$perRow .= 'grid-cols-4'; 
	};

	// If border does not exist, set it to left, this is because the border was not optional initially
	if ( !isset($border) ) $border = 'left';
	
	// Configure the border classes for the columns
	$border_classes = '';
	switch ( $border ) {
		case 'left':
			$border_classes = 'border-tan border-t-4 lg:border-t-0 lg:border-l-4';
			break;
		default:
			break;
	}

?>
<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
	data-anchor-label="<?= $customBlock->anchorLabel ?>"
	class=" <?= $customBlock->classesString ?> <?= $customBlock->bgColor; ?> <?= $customBlock->paddingStyle; ?> relative">
	<?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>
	<div class="container relative z-[2]">
		<?php if ( $type == 'manual' || $type == 'accordion' ) { ?>
		<div class="lg:grid <?= $perRow; ?> gap-y-[48px] columns-type-<?= $type; ?>">
			<?php
					foreach ( $columns as $column ) {
						// Build the grid item classes
						$item_classes = array(
							'grid-item',
							'p-8',
							'lg:pt-0',
							'wysiwyg',
							'group',
							$border_classes
						);
						// If it is an accordion, add the accordion class
						if ( $type == 'accordion' ) {
							$item_classes = array_merge($item_classes, array(
								'accordion-item',
								'cursor-pointer',
								'hover:bg-dark-beige'
							));
						}
						// Start the HTML
						echo '<div class="'. implode(' ', $item_classes) .'">';
							// If we have an image, output it
							if ( $column['image'] && !empty($column['image']['html']) ) {
								// Image classes
								$image_classes = array(
									'image',
									'flex',
									'flex-col',
									'items-center',
									'transition-filter',
									'duration-300',
								);
								// If greyscale_inactive_images add the tailwind greyscale class
								if ( !empty($greyscale_inactive_images) ) {
									$image_classes[] = 'group-[.active]:grayscale-0';
									$image_classes[] = 'grayscale';
								}
								echo '<div class="'. implode(' ', $image_classes) .'">';
									echo $column['image']['html'];
								echo '</div>';
							}
							// If we have content, output it
							if ( $column['content'] ) {
								echo '<div class="content m-2 mb-4">'. $column['content'] .'</div>';
							}
							// If an accordion, output the accordion content if it exists
							if ( $type == 'accordion' && !empty($column['accordion_content']) ) {
								// If we have accordion_hint_text, output it
								if ( !empty($column['accordion_hint_text']) ) {
									echo '<div class="overflow-hidden">';
										echo '<h6 class="accordion-hint text-center mb-4 transition-transform duration-300">'. $column['accordion_hint_text'] .'</h6>';
									echo ' </div>';
								}
								echo '<div class="accordion-content px-4 m-2 mb-4 h-0 overflow-hidden transition-height duration-300">' . $column['accordion_content'] . '</div>';
							}

						echo '</div><!-- /.grid-item -->';
					}
			?>
		</div>
		<?php } elseif ($type == 'brands') { ?>
		<div class="lg:grid  <?= $perRow; ?>  gap-y-[64px]">
			<?php
				foreach ($columns as $column) {
					$brand = $column['brand'];
					$id = $brand->ID;

					$title = $brand->post_title;
					$link = get_permalink($id);
					$desc = get_field('description', $id);
					$logo = get_field('logo', $id);

					echo '<div class="grid-item mb-8 lg:pl-5 p-8 '. $border_classes .'">';
						echo '<a href="' . $link . '" aria-label="' . $title . '">';
							echo '<div class="brand-img">' . $logo['html'] . '</div>';
								echo '<div class="title font-heading text-[36px] leading-[1] uppercase text-charcoal my-7">' . $title . '</div>';
								echo '<p>' . $desc . '</p>';
						echo '</a>';
					echo '</div>';
				}
			?>
		</div>
		<?php } else {  ?>
		<div class="lg:grid  <?= $perRow; ?>  gap-y-[64px] gap-x-10">
			<?php if ( is_singular('brand') ) { ?>
			<?php
					$post_id = get_the_ID();
				$products = get_field('products', $post_id);

				foreach ($products as $pt) {
					$product = $pt['product'];
					$id = $product->ID;
					$img = get_the_post_thumbnail($id, 'full');
					$title = $product->post_title;
					$desc = get_field('description', $id);
					$link = get_field('link', $id);

					echo '<div class="grid-item mb-8">';
					if ($link) {
						echo '<a href="' . $link['url'] . '" aria-label="View ' . $title . '" target="' . $link['target'] . '">';
						echo '<div class="mb-5">' . $img . '</div>';
						echo '</a>';
					} else {
						echo '<div class="mb-5">' . $img . '</div>';
					}
					echo '<div class="title font-heading text-[36px] leading-[1] z-20 lg:mb-6 text-charcoal pb-2 uppercase">' . $title . '</div>';
					if ($desc) {
						echo '<div class="lg:mb-3">' . $desc . '</div>';
					}
					if ($link) {
						echo '<a href="' . $link['url'] . '" aria-label="View ' . $title . '" target="' . $link['target'] . '" class="btn-primary btn-finger-white">' . $link['title'] . '</a>';
					}
					echo '</div>';
				}
				?>
			<?php
			} else {
				foreach ($columns as $column) {
					$product = $column['product'];
					$id = $product->ID;

					$title = $product->post_title;
					$img = get_the_post_thumbnail($id, 'full');
					$desc = get_field('description', $id);
					$link = get_field('link', $id);

					echo '<div class="grid-item mb-8">';
					if ($link) {
						echo '<a href="' . $link['url'] . '" aria-label="View ' . $title . '" target="' . $link['target'] . '">';
						echo '<div class="mb-5">' . $img . '</div>';
						echo '</a>';
					} else {
						echo '<div class="mb-5">' . $img . '</div>';
					}
					echo '<div class="title font-heading text-[36px] leading-[1] z-20 lg:mb-6 text-charcoal pb-2 uppercase">' . $title . '</div>';
					if ($desc) {
						echo '<div class="lg:mb-3">' . $desc . '</div>';
					}
					if ($link) {
						echo '<a href="' . $link['url'] . '" aria-label="View ' . $title . '" target="' . $link['target'] . '" class="btn-primary btn-finger-white">' . $link['title'] . '</a>';
					}
					echo '</div>';
				}
			}
			?>
		</div>
		<?php } ?>
	</div> <!-- /.container -->

	<?php if ( $background_type != 'color' && isset($background_image)) :?>
	<div class="absolute z-[1] bottom-0 left-0 w-full h-[300px] md:h-auto bg-beige">
		<div class="relative w-full h-full z-[1] overflow-hidden  img-bg">
			<?= wp_get_attachment_image($background_image['ID'], 'original', false, ['class' => 'block object-cover w-full h-full']) ?>
		</div>
	</div>
	<?php endif; ?>

</div>