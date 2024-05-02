
<?php $bottomBackground = get_field('bottom_background'); ?>

<?php 
    if ($bottomBackground) :
        $content = "footer--bg max-w-[1800px] mr-auto ml-auto relative block w-full  h-[200px] lg:h-[400px] bottom-0 left-0 z-[-1] overflow-hidden bg--cont-img before:content-[''] before:block before:pb-[100%]";
        echo '<div class="'.$content.'">';
            echo $bottomBackground['html'];
        echo '</div>';
    endif; 
?>

</main>

<?php
    get_template_part('template-parts/footer');

    wp_footer();

    include_once 'modals.php';
    echo get_field('global_footer_scripts', 'option');
    echo get_field('content_footer_scripts');
?>
</body>

</html>
