<?php
$alert = get_field('add_alert_bar');
$alertText = get_field('alert_text', 'options');
$link = get_field('alert_link', 'options');
if (isset($link['url'])) {
	$linkURL = $link['url'];
	$linkText = $link['title'];
	$linkTarget = $link['target'];
} else {
	echo '<!-- No link set -->';
	$alert = '0';
}

?>
<?php if($alert == '1') : ?>
<div class="py-4 container bg-red-accent text-white shadow-lg lg:rounded-b-md" id="wsf-alert-bar">
	<div class="flex items-center justify-between w-full">
		<?php if(!empty($alertText)) : ?>
		<div class="wysiwyg relative pl-8 before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-[18px] before:h-5 before:bg-alert before:bg-center before:bg-no-repeat before:bg-contain">
			<?= $alertText ?>
		</div>
		<?php endif; ?>
		<?php if(!empty($linkURL)) : ?>
		<div class="alert-link">
			<a class="btn btn-primary my-0 btn-finger-white py-1 text-[16px] whitespace-nowrap" href="<?= $linkURL?>"
				target="<?= $linkTarget ?>"><?= $linkText ?></a>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>