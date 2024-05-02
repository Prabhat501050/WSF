<?php

class MobileMenuWalker extends Walker_Nav_Menu
{
	public $megaMenuClasses = 'transition-expo max-h-0 mobile-mega-menu overflow-y-auto';

	public function start_lvl(&$output, $depth = 0, $args = [])
	{
		$themeLocation = is_array($args) ? $args['theme_location'] : $args?->theme_location;

		$output .= $themeLocation === 'main-menu' ? '' : "<ul class='sub-menu hidden'>";
	}

	public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		$topItemClass = 'heading p-4 block text-2xl';
		$columns = get_field('columns', $item->ID);
		$hasChildren = in_array('menu-item-has-children', $item->classes);
		$currentPage = in_array('current_page_item', $item->classes);

		if ($currentPage) {
			$topItemClass .= ' text-red';
		}

		// Top level item
		if ($depth === 0) {
			if ($hasChildren || $columns) {
				$topItemClass .= ' flex items-center justify-between transition-expo relative';
			}

			$item->classes[] = strtolower($item->title);
			$item->classes[] = 'menu-item-' . $item->ID;
			$item->classes[] = 'group overflow-hidden';

			$output .= '<li class="' . join(' ', $item->classes) . '">';
			$output .= '<a href="' . $item->url . '" class="' . $topItemClass . '">';
			$output .= $hasChildren ? '<span>' . $item->title . '</span>' : $item->title;

			if ($hasChildren || $columns) {
				$output .= '<span class="transition-expo group-hover:-rotate-180 group-hover:text-red pointer-events-none">' . file_get_contents(get_template_directory() . '/assets/icons/chevron.svg') . '</span>';
			}

			$output .= '</a>';

			if ($hasChildren || $columns) {
				$output .= "<div class='$this->megaMenuClasses'>";
			}

			if (!$columns && $hasChildren) {
				$output .= '<ul class="space-y-4 p-4 max-w-xs mx-auto">';
			}
		}

		if ($depth === 1) {
			$output .= '<a href="' . $item->url . '" class="space-y-2 block">';
			$output .= '<div class="aspect-[4/3] w-full">';
			$output .= get_the_post_thumbnail($item->object_id, 'large', ['class' => 'w-full h-full object-cover']);
			$output .= '</div>';
			$output .= '<h4 class="text-red flex items-center justify-between !text-xl">';
			$output .= '<span class="text-charcoal">' . $item->title . '</span>';
			$output .= '<span class="inline-flex w-5">' . file_get_contents(get_template_directory() . '/assets/icons/finger-right.svg') . '</span>';
			$output .= '</h4>';
			$output .= '<p class="text-base leading-normal text-charcoal">' . get_the_excerpt($item->object_id) . '</p>';
			$output .= '</a>';
		}

		if ($columns) {
			$output .= '<div class="p-4 space-y-4">';
			foreach ($columns as $col) {
				$output .= $col['type'] === 'brands' ? '<ul class="text-sm font-semibold flex-1 font-sans min-w-[68%]">' : '<ul class="text-sm font-semibold flex-1 font-sans space-y-3">';
				$output .= '<li class="block heading w-full border-b mb-6 text-charcoal font-normal text-base">' . $col['title'] . '</li>';
				if ($col['type'] === 'brands') {
					$output .= '<li>';
					foreach ($col['brands'] as $brand) {
						$output .= '<a href="' . get_the_permalink($brand->ID) . '" class="flex items-center space-x-2 transition hover:bg-gray-50 p-2 rounded-lg hover:text-red">';
						$output .= '<img src="' . get_field('logo', $brand->ID)['url'] . '" class="w-12 max-h-[48px]">';
						$output .= '<span class="transition">' . $brand->post_title . '</span>';
						$output .= '</a>';
					}
					$output .= '</li>';
				} elseif ($col['items'] !== false) {
					foreach ($col['items'] as $el) {
						$output .= '<li><a href="'. $el['page']['url'] .'" class="hover:text-red transition" target='. $el['page']['target'] .'>' . $el['page']['title'] .'</a></li>';
					}
				}
				$output .= '</ul>';
			}
			$output .= '</div>';
		}
	}

	public function end_el(&$output, $item, $depth = 0, $args = null)
	{
		$columns = get_field('columns', $item->ID);
		$hasChildren = in_array('menu-item-has-children', $item->classes);

		if (!$columns && $hasChildren) {
			$output .= '</ul>';
		}

		if ($hasChildren || $columns) {
			$output .= '<div class="px-4"><a href="' . $item->url . '" class="btn-primary btn-finger-white mx-auto">' . $item->title . '</a></div>';
			$output .= '</div>';
		}
	}

	//
	// Wrap up SubMenu output if needed
	//
	public function end_lvl(&$output, $depth = 0, $args = [])
	{
		$themeLocation = is_array($args) ? $args['theme_location'] : $args?->theme_location;

		$output .= $themeLocation === 'main-menu' ? '' : '</ul>';
	}
}
