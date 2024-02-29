<?php $__env->startSection('content'); ?>

    <div id="dynamic-post"></div>

    <div id="current-post" x-init="
  if (window.matchMedia('(min-width: 1025px)').matches) {
    setTimeout(() => { sidebarOpen = true; }, 2500);
  }
">
        <div id="hero-section"
             class="gap-y-8 min-h-screen px-8 py-8  pt-28 flex flex-col justify-start w-full overflow-hidden">
            <div
                class="hidden top overflow-hidden absolute left-0  pt-28 right-[10%] top-0  h-screen lg:flex flex-col justify-start text-white py-8 z-[3] "
                :class="sidebarOpen ? 'lg:left-[490px]' : ''">
                <img src="<?php echo e(get_field('featured_image')); ?>" alt=""
                     class="z-[1] absolute top-0 h-screen object-cover max-w-none left-0"/>
                <?php if(get_field('featured_text')): ?>
                    <div class="w-[450px] ml-8 z-[3] text-primary ">
                        <?php echo get_field('featured_text'); ?>

                    </div>
                <?php endif; ?>
            </div>


            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.video','data' => ['class' => 'hidden lg:block','src' => 'https://player.vimeo.com/video/830266264?h=db57139e05&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;background=1&amp;muted=1','allow' => 'autoplay; fullscreen; picture-in-picture','allowfullscreen' => '','dataReady' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('video'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'hidden lg:block','src' => 'https://player.vimeo.com/video/830266264?h=db57139e05&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;background=1&amp;muted=1','allow' => 'autoplay; fullscreen; picture-in-picture','allowfullscreen' => '','data-ready' => 'true']); ?>
                <script src="https://player.vimeo.com/api/player.js"></script>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

            <?php if(get_field('featured_text')): ?>
                <div class="max-w-md z-[2] text-white ">
                    <?php echo get_field('featured_text'); ?>

                </div>
            <?php endif; ?>
            <div class="pt-48">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.packages-slider','data' => ['id' => 'front-page']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('packages-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'front-page']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>

        </div>
        <div class="bg-white text-black">
            <?php echo e(the_content()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/front-page.blade.php ENDPATH**/ ?>