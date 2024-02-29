<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['title' => false, 'show' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['title' => false, 'show' => false]); ?>
<?php foreach (array_filter((['title' => false, 'show' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div class="" x-show="<?php echo e($show); ?>">
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.css' rel='stylesheet'/>

    <div id="wrapper">
        <div id='map2'></div>
        <div id="card" class="map-card" data-scene-number="0">
            <?php if($title): ?>
                <div id="card_title" class="map-card__title">
                    <h1><?php echo $title; ?></h1>
                </div>
            <?php endif; ?>
            <div id="card_body" class="map-card__body"></div>
            <div id="card_nav" class="map-card__nav map-card__nav_cover" style="display: none;"><span id="card_nav__prev"></span><span
                    id="card_nav__next">Suivant &rarr;</span></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <?php
    wp_enqueue_style('mapbox', get_template_directory_uri() . '/resources/styles/mapbox.css', array(), null);

    ?>
</div>
<?php /**PATH /var/www/vhosts/hydravionquebec.com/httpdocs/wp-content/themes/sage/resources/views/components/map.blade.php ENDPATH**/ ?>