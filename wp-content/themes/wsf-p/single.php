<?php
	get_header();
		if (have_posts()) :
			while (have_posts()) :
				the_post();
				
				$post_type = get_post_type();
				$containerClass = ($post_type === 'brand') ? 'p-0 max-w-[none]' : '';
            	$maxWidth = ($post_type === 'brand') ? 'w-full' : 'max-w-[1370px] mx-auto pt-[150px] pb-[150px]';
            	$internalWidth = ($post_type === 'brand') ? 'w-full' : 'max-w-[850px]';
?>
				<section class="single-post section-<?= $post_type;?>">
					<div class="container <?= $containerClass; ?>">
						<div class="<?= $maxWidth; ?>">
							<div class="<?= $internalWidth; ?>">
								<?php
									if($post_type == 'post') {
										echo '<h1 class="h-display text-charcoal mb-20">'.get_the_title().'</h1>'; 
									}
								?>
								<?php echo the_content(); ?>
							</div>
						</div>
					</div>
				</section>

				<?php
			endwhile;
		endif;
	get_footer();
?>
