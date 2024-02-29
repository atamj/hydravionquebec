<div x-data="hashHandler()"
     x-show="checkHash('nous-joindre')"
     x-transition:enter="   duration-[750ms] transform"
     x-transition:enter-start="translate-y-full"
     x-transition:enter-end="-translate-y-0"
     x-transition:leave="   duration-[750ms] transform"
     x-transition:leave-start="-translate-y-0"
     x-transition:leave-end="translate-y-full"

     class="z-[99999] fixed top-0 left-0 w-full h-screen flex items-center justify-center"
     style="display: none;transition: all; transition-duration: 750ms; transition-timing-function: cubic-bezier(0.5, 0.1, 0.1, 1) !important"
>
    <a href="#" class="fixed right-0 top-0 z-10 p-6">
        <svg class="h-[20px] w-[20px] text-white cursor-pointer hover:text-secondary" xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 20 20" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </a>

    <div aria-hidden="true" class="fixed h-full w-full z-[1] bg-gradient-to-p-90 opacity-70"></div>
    <img src="{{ asset('images/default.webp') }}"
         class="fixed h-full w-full object-cover"
         alt="contact modal background" width="4160" height="6240"/>
    <div class="overflow-y-scroll w-full max-h-screen px-6 py-12 ">
        <div class="relative z-20 text-center w-full   max-w-screen-md mx-auto ">
            <h2 class="font-semibold text-5xl text-white">{{ __('Contact us', 'ng') }}</h2>
            <p class="mt-4 mb-12 text-white">{{ __('Have a question? Feel free to contact us', 'ng') }}</p>
            {!! do_shortcode('[gravityform id="19" title="false" description="false" ajax="true"]') !!}
        </div>
    </div>

</div>
