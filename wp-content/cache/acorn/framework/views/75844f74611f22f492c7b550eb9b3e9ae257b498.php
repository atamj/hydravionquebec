<div>
    <div class="min-h-screen pt-[100px] px-6 pb-12 relative  flex flex-col justify-end">
        <img
            src="<?php echo e($featured_image); ?>"
            class="z-[1] absolute top-0 h-full object-cover w-full right-0"
            alt=""
        />
        <div aria-hidden="true" class="absolute inset-0 z-[1] bg-gradient-b-to-t "></div>

        <?php if($video): ?>
            <div class="video-wrapper z-[1]">
                <iframe
                    src="https://player.vimeo.com/video/<?php echo e($video); ?>?h=db57139e05&badge=0&autopause=0&player_id=0&background=1&muted=1"
                    frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                <br/>
            </div>
        <?php endif; ?>
        <div class="max-w-[490px] z-[2]">
            <div class=" z-[2] mb-7 ">
                <?php if (isset($component)) { $__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb = $component; } ?>
<?php $component = App\View\Components\Text::resolve(['theme' => 'h1'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Text::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['as' => 'h1','class' => 'mb-5 font-normal']); ?><?php echo $title; ?>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb)): ?>
<?php $component = $__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb; ?>
<?php unset($__componentOriginal420f7c96ac3f84b969214fe410926b297dccb1fb); ?>
<?php endif; ?>
            </div>

            <?php if($duration || $length || $price || $price_base || $address): ?>
                <ul class="mb-6 ">
                    <?php if($address): ?>
                        <li class="mb-3 inline-flex py-2 px-5 flex-col text-lg font-semibold bg-primary/80 justify-center border border-white rounded-lg mr-3">
                            <span class="text-xs">Adresse</span><?php echo e($address); ?>

                        </li>
                    <?php endif; ?>
                    <?php if($duration): ?>
                        <li class="mb-3 inline-flex py-2 px-5 flex-col text-lg font-semibold bg-primary/80 justify-center border border-white rounded-lg mr-3">
                            <span class="text-xs">Durée</span><?php echo e($duration); ?>

                        </li>
                    <?php endif; ?>
                    <?php if($length): ?>
                        <li class="mb-3 inline-flex py-2 px-4 flex-col text-lg font-semibold justify-center bg-primary/80 border border-white rounded-lg mr-3">
                            <span class="text-xs">Temps de vol</span><?php echo e($length); ?>

                        </li>
                    <?php endif; ?>
                    <?php if($price_base): ?>
                        <li class="mb-3 inline-flex py-2 px-4 flex-col text-lg font-semibold bg-foreground-light/80 justify-center border border-white rounded-lg mr-3">
                            <span class="text-xs">Prix de base</span> À partir de <?php echo e($price_base); ?>$
                        </li>
                    <?php endif; ?>
                    <?php if($price): ?>
                        <li class="mb-3 inline-flex py-2 px-4 flex-col text-lg font-semibold bg-foreground-light/80 justify-center border border-white rounded-lg mr-3">
                            <span class="text-xs">Prix&nbsp;/&nbsp;personne</span><?php echo e($price); ?>$
                        </li>
                    <?php endif; ?>

                </ul>
            <?php endif; ?>
            <?php echo $description; ?>

        </div>
        <div class="relative px-6 -bottom-[3rem] <?php echo e($slides && count($slides) ? 'pb-[250px]' : 'pb-[75px]'); ?>">
            <?php if($slides && count($slides)): ?>
		
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.packages-slider','data' => ['packages' => $slides]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('packages-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['packages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($slides)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white text-black relative z-[1]" >
        <?php if($content): ?>
            <div class="max-w-[1536px] mx-auto px-6 py-10 lg:py-20">
                <div class="content typography is-layout-constrained">
                    <?php echo $content; ?>

                </div>
            </div>
        <?php endif; ?>

            <?php if($leaflet_map): ?>
                <div class="relative" style="height: calc(100vh - 75px);">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.map','data' => ['show' => 'true','title' => get_the_title()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('map'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['show' => 'true','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_the_title())]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>





    </div>
</div>
<?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/components/package.blade.php ENDPATH**/ ?>