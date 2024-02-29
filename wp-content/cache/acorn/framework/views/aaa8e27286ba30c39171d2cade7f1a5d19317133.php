<div class="bg-white ">
    <div class="px-6 max-w-[1536px]  mx-auto">
        <?php
            $myquery = new WP_Query(array(
                'post_type' => get_post_type(),
                'posts_per_page' => 3,
                'order' => 'DESC',
                'orderby' => 'date'
            ));
        ?>

        <div class="my-20">
            <?php if (isset($component)) { $__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb = $component; } ?>
<?php $component = App\View\Components\Text::resolve(['theme' => 'h2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Text::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['as' => 'h2','class' => ' my-12 text-center text-primary']); ?>Articles récents <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb)): ?>
<?php $component = $__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb; ?>
<?php unset($__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb); ?>
<?php endif; ?>
            <div
                class="grid grid-cols-1 gap-x-4 gap-y-8 xs:grid-cols-2 lg:grid-cols-3 sm:gap-x-6 xl:gap-x-8 w-full mx-auto">
                <?php $__currentLoopData = $myquery->get_posts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->first(['partials.content-' . get_post_type(), 'partials.content'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div style="border-top-color:#eaeaea;border-top-width:1px" class="px-6">
        <?php
            the_post_navigation(array(
                   'prev_text' => '<span class="nav-subtitle">' . esc_html__('←', 'hc') . '</span> <span class="nav-title">%title</span>',
                   'next_text' => '<span class="nav-subtitle">' . esc_html__('→', 'hc') . '</span> <span class="nav-title">%title</span>',
            ));
           wp_reset_postdata();
        ?>
    </div>

</div>
<?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/partials/sections/latest-posts.blade.php ENDPATH**/ ?>