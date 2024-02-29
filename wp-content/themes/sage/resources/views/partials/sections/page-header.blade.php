<div class=" h-full py-[10vw] min-h-[500px]   pb-12 relative flex flex-col justify-center">
    <img src="{{$image}}" alt=""
         class="z-[1] absolute top-0 h-full object-cover w-full right-0"
    />
    <div aria-hidden="true" class="absolute inset-0 z-[1] bg-gradient-b-to-t "></div>
    <div class="mx-auto w-full max-w-[1536px] px-6 z-[2]">
        <div class="max-w-[600px]">
            @if($subtitle)
            <div class="flex gap-2 mb-4 categories items-center">
                {!! $subtitle !!}
            </div>
            @endif
            <x-text as="h1" theme="h1" class="mb-7 ">{{$title}}</x-text>
        </div>
    </div>
</div>
