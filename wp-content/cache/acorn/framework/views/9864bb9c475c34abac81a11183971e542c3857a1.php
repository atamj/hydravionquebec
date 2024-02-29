<?php $__env->startSection('content'); ?>
    <div id="dynamic-post"></div>
    <div id="current-post">
        <?php echo $__env->make('partials/sections/page-header', [
   'image' => get_featured_image(),
   'title' => 'Nouvelles',
   ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div
            id="grid"

        >
            <?php while(have_posts()): ?>
                <?php (the_post()); ?>
                <div class="grid-item">
                    <?php echo $__env->first(['partials.content-' . get_post_type(), 'partials.content'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/index.blade.php ENDPATH**/ ?>