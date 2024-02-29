(function ($) {
    const $container = $('#grid');

    function initializeGrid() {
        const sizeClasses = 'grid-item--width2-height2';

        $container.find('.grid-item').each(function (index) {
            if ((index + 1) % 3 === 1) {
                $(this).addClass(sizeClasses);
            }
        });

        var $grid = $container.isotope({
            itemSelector: '.grid-item',
            layoutMode: 'packery',
            masonry: {
                columnWidth: '.grid-sizer'
            },
        });
    }

    // Call the function to initialize the grid
    $(document).ready(function () {
        initializeGrid();
    });
})(jQuery);
