(function ($) {
    function magneticCursor($wrap) {
        $wrap = typeof $wrap == "undefined" ? $("body") : $wrap;

        $wrap.on("mousemove", ".magnetic", function (e) {
            var $el = $("img", this),
                bound = e.currentTarget.getBoundingClientRect(),
                coeff = 150,
                hor = bound.width / 2 - (e.clientX - bound.left),
                ver = bound.height / 2 - (e.clientY - bound.top),
                toX = hor / bound.width * coeff,
                toY = ver / bound.height * coeff,
                scaleX = ((bound.width + coeff + 5) / bound.width).toFixed(2),
                scaleY = ((bound.height + coeff + 5) / bound.height).toFixed(2),
                toScale = Math.max(scaleX, scaleY);

            gsap.killTweensOf($el);
            gsap.to($el, {
                duration: .75,
                x: toX,
                y: toY,
                scale: toScale,
                ease: Power1.easeOut,
                transformPerspective: 900,
                transformOrigin: "center",
                force3D: !0
            })
        }).on("mouseout", ".magnetic", function (e) {
            var $el = $("img", this);

            gsap.killTweensOf($el);
            gsap.to($el, {
                duration: .6,
                y: 0,
                x: 0,
                scale: 1,
                ease: Power1.easeOut,
                transformPerspective: 900,
                transformOrigin: "center",
                force3D: !0
            })
        })
    }

    $(window).on("load", function (event) {
        magneticCursor()
    }), $(".isotope-container").on("isotope-layout-complete", function () {
        var $this = $(this);
        magneticCursor($this)
    })
})(jQuery)
