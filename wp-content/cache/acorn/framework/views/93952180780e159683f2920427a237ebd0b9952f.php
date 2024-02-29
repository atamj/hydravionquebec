<div id="current-post" class="flex-1 flex flex-col">
    <?php echo $__env->make('partials/sections/page-header', [
 'image' => get_the_post_thumbnail_url(),
 'subtitle' => get_the_category_list('•'),
 'title' => get_the_title(),
 ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="flex-1 bg-white text-black">
		<div class="max-w-[1536px] mx-auto px-6 py-12">
			<div class="content typography is-layout-constrained">
				<?= the_content() ?>
			</div>
		</div>
	</div>
    <?php echo $__env->make('partials/sections/latest-posts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/partials/content-single-post.blade.php ENDPATH**/ ?>