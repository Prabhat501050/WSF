<?php

class CustomMenu extends Walker_Nav_Menu
{
	public $megaMenuClasses = 'shadow-lg rounded-xl w-full max-w-3xl overflow-hidden absolute bottom-0 opacity-0 pointer-events-none translate-y-[125%] z-50 bg-white left-1/2 -translate-x-1/2 transition-expo group-hover:pointer-events-auto group-hover:opacity-100 group-hover:translate-y-full mega-menu';

	//
	// Begin SubMenu Output if needed
	//
	public function start_lvl(&$output, $depth = 0, $args = [])
	{
		$themeLocation = is_array($args) ? $args['theme_location'] : $args?->theme_location;

		$output .= $themeLocation === 'main-menu' ? '' : "<ul class='sub-menu hidden'>";
	}

	public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		$topItemClass = 'heading lg:text-xl py-8 group-hover:text-red';
		$spanHover = ' ';
		$columns = get_field('columns', $item->ID);
		$hasChildren = in_array('menu-item-has-children', $item->classes);
		$currentPage = in_array('current_page_item', $item->classes);

		/* ACTIVE STATE 
		if ($currentPage) {
			$topItemClass .= ' text-red';
			$spanHover .= ' bg-red-accent pointer-events-none absolute bottom-6 left-0 right-0 h-px scale-x-150';
		} else {
			$spanHover = 'transition-expo scale-x-0 group-hover:scale-x-150 bg-red-accent pointer-events-none absolute bottom-6 left-0 right-0 h-px';
		} */

		if ($currentPage) {
			$topItemClass .= ' text-red';
		}


		// Top level item
		if ($depth === 0) {
			$topItemClass .= ' flex items-center transition relative pl-5 pr-5';

			$output .= '<li class="' . join(' ', $item->classes) . ' ' . strtolower($item->title) . ' menu-item-' . $item->ID . ' group">';
			$output .= '<a href="' . $item->url . '" class="' . $topItemClass . '">';

			if ($hasChildren || $columns) {
				$output .= $hasChildren ? '<span>' . $item->title . '</span>' : $item->title;
				$output .= '<span class="transition-expo group-hover:-rotate-180 group-hover:text-red pointer-events-none">' . file_get_contents(get_template_directory() . '/assets/icons/chevron.svg') . '</span>';
				// $output .= '<span class="'.$spanHover.'"></span>';
				$output .= '<span class="transition-expo scale-x-0 group-hover:scale-x-100 bg-red-accent pointer-events-none absolute bottom-6 left-0 right-0 h-px"></span>';
			} else {
				$output .= '<span>' . $item->title . '</span>';
				// $output .= '<span class="'.$spanHover.'"></span>';
				$output .= '<span class="transition-expo scale-x-0 group-hover:scale-x-100 bg-red-accent pointer-events-none absolute bottom-6 left-0 right-0 h-px"></span>';
			}

			$output .= '</a>';

			if (!$columns && $hasChildren) {
				$this->megaMenuClasses .= ' !max-w-[80%]';
			}

			if ($hasChildren || $columns) {
				$output .= "<div class='$this->megaMenuClasses'>";
			}

			if (!$columns && $hasChildren) {
				$output .= '<ul class="grid grid-cols-5 gap-4 p-8">';
			}
			
		}

		if ($depth === 1) {
			$output .= '<a href="' . $item->url . '" class="space-y-2">';
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
			$output .= '<div class="p-8 flex space-x-6">';
			foreach ($columns as $col) {
				$output .= $col['type'] === 'brands' ? '<ul class="text-sm font-semibold flex-1 font-sans min-w-[68%]">' : '<ul class="text-sm font-semibold flex-1 font-sans space-y-3">';
				$output .= '<li class="block heading w-full border-b mb-6 text-charcoal font-normal text-base">' . $col['title'] . '</li>';
				if ($col['type'] === 'brands') {
					$output .= '<li class="grid grid-cols-2 gap-4 gap-y-2">';
					foreach ($col['brands'] as $brand) {
						$output .= '<a href="' . get_the_permalink($brand->ID) . '" class="flex items-center space-x-2 transition hover:bg-gray-50 p-2 rounded-lg hover:text-red">';
						$output .= '<img src="' . get_field('logo', $brand->ID)['url'] . '" class="w-12 max-h-[48px]">';
						$output .= '<span class="transition">' . $brand->post_title . '</span>';
						$output .= '</a>';
					}
					$output .= '</li>';
				} elseif ($col['items'] !== false) {
					foreach ($col['items'] as $el) {
						$output .= '<li><a href="'. $el['page']['url'] .'" class="hover:text-red transition" target='. $el['page']['target'] .'>'. $el['page']['title'] .'</a></li>';
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
			$megaMenuLinkLabel = get_field('mega_menu_link_label', $item->object_id);
			$output .= '<a href="' . $item->url . '" class="btn-primary btn-finger-white w-full my-0 px-8">' . ($megaMenuLinkLabel ? $megaMenuLinkLabel : $item->title) . '</a>';
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

//
// Build menu as a select dropdown
//
class Walker_Select_List extends Walker_Nav_Menu
{
	public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		$url = $item->url;
		$title = $item->title;
		$output = $output . '<option value="' . $url . '">' . $title . '</option>';
	}
}
