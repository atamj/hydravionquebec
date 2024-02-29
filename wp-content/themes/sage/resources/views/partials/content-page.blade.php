<div id="current-post">
	<div class="max- h-full py-[10vw] min-h-[500px]  relative flex flex-col justify-center">
		<img src="<?= get_the_post_thumbnail_url() ?>" alt=""
			 class="z-[1] absolute top-0 h-full object-cover w-full right-0"
		/>
		<div aria-hidden="true" class="absolute inset-0 z-[1] bg-gradient-b-to-t "></div>
		<div class="mx-auto w-full max-w-[1536px] px-6 z-[2]">
			<div class="max-w-[600px]">
				<div class="flex gap-2 mb-4 items-center categories">
					<?= get_the_category_list('•') ?>
				</div>
                <x-text as="h1" theme="h1" class="mb-7"><?= get_the_title() ?></x-text>
				<p>
					<?= get_the_excerpt() ?>
				</p>
			</div>
		</div>
	</div>

	<div class="bg-white text-black">
		<div class="">
			<div class="content typography">
				<?= the_content() ?>
			</div>
		</div>
	</div>
</div>
