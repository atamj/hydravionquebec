<div id="current-post">
	<div class="h-screen pt-[100px] px-6 pb-12 relative flex flex-col justify-end">
		<img
                src="<?= get_the_post_thumbnail_url() ?>"
                class="z-[1] absolute top-0 h-screen object-cover w-full right-0"
                alt=""
        />
		<div aria-hidden="true" class="absolute inset-0 z-[1] bg-gradient-b-to-t "></div>

		<div class="max-w-[550px] z-[2]">

			<h1 class="text-5xl font-medium mb-7 leading-[1.1]"><?= get_the_title() ?></h1>
		</div>


	</div>
	<div class="bg-white text-black">
		<div class="max-w-[1536px] mx-auto px-6 py-20">
			<?= the_content() ?>
		</div>
	</div>
</div>
