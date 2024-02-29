<div class=" h-full py-[10vw] min-h-[500px]   pb-12 relative flex flex-col justify-center">
    <img src="<?php echo e($image); ?>" alt=""
         class="z-[1] absolute top-0 h-full object-cover w-full right-0"
    />
    <div aria-hidden="true" class="absolute inset-0 z-[1] bg-gradient-b-to-t "></div>
    <div class="mx-auto w-full max-w-[1536px] px-6 z-[2]">
        <div class="max-w-[600px]">
            <?php if($subtitle): ?>
            <div class="flex gap-2 mb-4 categories items-center">
                <?php echo $subtitle; ?>

            </div>
            <?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb = $component; } ?>
<?php $component = App\View\Components\Text::resolve(['theme' => 'h1'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Text::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['as' => 'h1','class' => 'mb-7 ']); ?><?php echo e($title); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb)): ?>
<?php $component = $__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb; ?>
<?php unset($__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb); ?>
<?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/partials/sections/page-header.blade.php ENDPATH**/ ?>