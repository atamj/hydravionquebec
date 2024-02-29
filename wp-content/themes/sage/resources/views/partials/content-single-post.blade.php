<div id="current-post" class="flex-1 flex flex-col">
    @include ('partials/sections/page-header', [
 'image' => get_the_post_thumbnail_url(),
 'subtitle' => get_the_category_list('•'),
 'title' => get_the_title(),
 ])

	<div class="flex-1 bg-white text-black">
		<div class="max-w-[1536px] mx-auto px-6 py-12">
			<div class="content typography is-layout-constrained">
				<?= the_content() ?>
			</div>
		</div>
	</div>
    @include('partials/sections/latest-posts')
</div>
