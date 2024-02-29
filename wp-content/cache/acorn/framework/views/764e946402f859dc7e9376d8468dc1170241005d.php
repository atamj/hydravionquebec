<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['video']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['video']); ?>
<?php foreach (array_filter((['video']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<div class="video-wrapper">
    <iframe <?php echo e($attributes); ?>></iframe><br>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/components/video.blade.php ENDPATH**/ ?>