<?php
get_header();

$pages = get_pages();
foreach($pages as $page) {
    echo '<div class="container wysiwyg">';
    echo '<h2>'.$page->post_title.'</h2>';

    if ( has_blocks( $page->post_content ) ) {
        $blocks = parse_blocks(  $page->post_content );
        echo '<ul>';
            foreach ($blocks as $i => $block) {
                echo '<li>'.$block['blockName'].'</li>';
            }
        echo '</ul>';
    }
    echo '</div>';
}

get_footer();
?>