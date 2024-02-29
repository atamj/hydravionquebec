<div {{ $attributes->merge(['class' => $theme()]) }}>
    @if($image)
        <img src="{{ $image }}" alt="" class="object-cover">
    @endif
    @if($href)
        <a href="{{ $href }}"
           class="absolute inset-0 z-1 bg-gradient-b-to-t group-hover:opacity-50 transition-all"></a>
    @endif

    <h2 class="max-w-[75%] leading-6 absolute pointer-events-none p-4 md:p-6 z-[2] text-lg sm:text-2xl font-[500] tracking-tight text-white ">
        {{ $title }}
    </h2>
    {{$slot}}
</div>
