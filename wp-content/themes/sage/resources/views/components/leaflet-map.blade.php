@props(['show' => false])
<div>
    <div id="leaflet-container" style="height: calc(100vh - 40px);" x-show="{{$show}}">
        <div id="map" style="height:calc(100vh - 40px);"></div>
        <div class="leaflet-modal">
            <div class="leaflet-modal-content">
                <span class="close">&times;</span>
                <div class="leaflet-modal-sidebar">
                    <h2 class="leaflet-modal-title">

                    </h2>
                    <p class="leaflet-modal-description">

                    </p>
                </div>
                <div class="wp-block-custom-slider">
                    <div id="image-gallery" class="slider-carousel-container swiper swiper-horizontal"
                         data-desktop="1"
                         data-tablet="1"
                         data-mobile="1"
                         data-autoplay="false"
                         data-autoplaydelay="0"
                         data-autoplaydirection="false"
                         data-speed="150"
                         data-loop="true"
                         data-pauseonhover="false"
                         data-keyboard="true"
                         data-mousewheel="false"
                         data-autoheight="false"
                         data-deskspace="32"
                         data-tabspace="16"
                         data-phonespace="16"
                         data-id="image-gallery"
                         data-pagination="true"
                         data-navigation="true">
                        <div class="swiper-wrapper"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>


</div>
