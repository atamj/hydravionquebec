@props([
    "packages" => [],
    "id" => "packages-slider"
])


<div
    class="slider-carousel-container  z-[4] swiper swiper-container-free-mode absolute  bottom-[2rem] right-0 left-0 max-h-[205px]"
    id="{{$id}}">
    <div class="swiper-wrapper" style="transition-timing-function : linear;">
        @foreach ($packages as $package)

            <div class="wp-block-custom-slide swiper-slide w-full max-w-[390px]">
                <div
                    class="shadow-lg magnetic group aspect-h-1 aspect-w-[1.91] block w-full overflow-hidden rounded-lg focus-within:ring-2 focus-within:ring-secondary-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    @if ($package["featured_image"] !== "")
                        <img src="{{ $package["featured_image"] }}" alt="" class="object-cover">
                    @endif
                    @if ($package["title"] !== "")
                        <h3 class="max-w-[75%] leading-[32px] absolute pointer-events-none p-4  z-[2] text-[21px] font-[500] tracking-tight text-white ">
                            {!! $package["title"] !!}
                        </h3>
                    @endif
                    @if ($package["permalink"] !== "")
                        <a href="{{ $package["permalink"] }}"
                           class="absolute inset-0 z-1 bg-gradient-b-to-t group-hover:opacity-50 transition-all"></a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
