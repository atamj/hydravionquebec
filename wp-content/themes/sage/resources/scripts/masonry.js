(function ($) {
    const $container = $('#masonry-grid');
    if ($container.length !== 0) {
        $container.isotope({
            itemSelector: '.wp-block-post',
            layoutMode: 'packery',
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });
    }
})(jQuery);
