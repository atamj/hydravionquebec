<div class="shadow-lg magnetic group aspect-h-1 aspect-w-[1.91] block w-full h-full overflow-hidden rounded-lg focus-within:ring-2 focus-within:ring-secondary-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
  <img src="<?= get_the_post_thumbnail_url() ?>" alt="" class="object-cover">
    <a href="<?= get_the_permalink() ?>"
       class="absolute inset-0 z-1 bg-gradient-b-to-t group-hover:opacity-50 transition-all"></a>
     <h3 class="max-w-[75%] leading-6 absolute pointer-events-none p-4 md:p-6 z-[2] text-lg sm:text-2xl font-[500] tracking-tight text-white ">
	    <?= get_the_title() ?>
     </h3>
</div>





