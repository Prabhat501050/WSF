<?php
// Path: template-parts/dropdown-filter.php
// Expects:
//      An array of options as objects with 'slug' and 'name' properties and renders a select dropdown
//      A label to render before the dropdown and for unique form names
//      A label slug to update in the URL when the dropdown changes
// Usage:
//      get_template_part('template-parts/dropdown-filter', null, ['options' => $options, 'label' => 'Label', 'label_slug' => 'label']);

echo '<div class="dropdown-filter">';
    $name = '';
    // Handle the label
    // Technically this could repeat, but it's unlikely and not a big deal if it does
    $name = 'filter-' . strtolower(sanitize_title($args['label'])) . '-' . substr(md5(rand()), 0, 8);
    // Render the label
    echo '<label for="'. $name .'" class="mr-2">'. $args['label'] .':</label>';
    // Render a select dropdown
    echo '<select class="filter-select large px-2" id='. $name .' data-slug='. $args['label_slug'] .'>';
        echo '<option value="all">All</option>';
        foreach ($args['options'] as $option) {
            echo '<option value="'. $option->slug .'">'. $option->name .'</option>';
        }
    echo '</select>';
echo '</div>';
