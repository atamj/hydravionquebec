<a class="sr-only focus:not-sr-only" href="#main">
  {{ __('Skip to content') }}
</a>

@include('sections.header')


<main id="main" class="relative flex-grow transition-[padding-left] ease-in-out duration-300  bg-primary flex flex-col text-white  min-h-screen"
	  :class="sidebarOpen ? 'lg:pl-[490px]' : ''">
    @yield('content')
	@include('sections.sidebar')
</main>


@include('sections.footer')
