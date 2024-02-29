<a class="sr-only focus:not-sr-only" href="#main">
  <?php echo e(__('Skip to content')); ?>

</a>

<?php echo $__env->make('sections.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<main id="main" class="relative flex-grow transition-[padding-left] ease-in-out duration-300  bg-primary flex flex-col text-white  min-h-screen"
	  :class="sidebarOpen ? 'lg:pl-[490px]' : ''">
    <?php echo $__env->yieldContent('content'); ?>
	<?php echo $__env->make('sections.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</main>


<?php echo $__env->make('sections.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/layouts/app.blade.php ENDPATH**/ ?>