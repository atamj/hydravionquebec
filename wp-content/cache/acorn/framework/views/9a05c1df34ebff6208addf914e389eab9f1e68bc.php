<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    "packages" => [],
    "id" => "packages-slider"
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    "packages" => [],
    "id" => "packages-slider"
]); ?>
<?php foreach (array_filter(([
    "packages" => [],
    "id" => "packages-slider"
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<div
    class="slider-carousel-container  z-[4] swiper swiper-container-free-mode absolute  bottom-[2rem] right-0 left-0 max-h-[205px]"
    id="<?php echo e($id); ?>">
    <div class="swiper-wrapper" style="transition-timing-function : linear;">
        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="wp-block-custom-slide swiper-slide w-full max-w-[390px]">
                <div
                    class="shadow-lg magnetic group aspect-h-1 aspect-w-[1.91] block w-full overflow-hidden rounded-lg focus-within:ring-2 focus-within:ring-secondary-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <?php if($package["featured_image"] !== ""): ?>
                        <img src="<?php echo e($package["featured_image"]); ?>" alt="" class="object-cover">
                    <?php endif; ?>
                    <?php if($package["title"] !== ""): ?>
                        <h3 class="max-w-[75%] leading-[32px] absolute pointer-events-none p-4  z-[2] text-[21px] font-[500] tracking-tight text-white ">
                            <?php echo $package["title"]; ?>

                        </h3>
                    <?php endif; ?>
                    <?php if($package["permalink"] !== ""): ?>
                        <a href="<?php echo e($package["permalink"]); ?>"
                           class="absolute inset-0 z-1 bg-gradient-b-to-t group-hover:opacity-50 transition-all"></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/components/packages-slider.blade.php ENDPATH**/ ?>