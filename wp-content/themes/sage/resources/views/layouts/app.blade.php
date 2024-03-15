<!doctype html>
<html @php(language_attributes())>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(wp_head())
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.js'></script>

    <script>
        function hashHandler() {
            return {
                hash: window.location.hash,
                modalOpen: false,
                checkHash(hash) {
                    return this.hash === '#' + hash;
                },
                init() {
                    window.addEventListener('hashchange', () => {
                        this.hash = window.location.hash;
                    }, false);
                    this.hash = window.location.hash;
                }
            }
        }
    </script>
</head>

<body @php(body_class('flex flex-col'))
      x-data="{sidebarOpen: false,modalOpen: false}"
      :class="modalOpen ? 'overflow-hidden' : ''"
>
@php(wp_body_open())
@php(do_action('get_header'))
<a class="sr-only focus:not-sr-only" href="#main">
    {{ __('Skip to content') }}
</a>
@include('sections.header')
<main id="main"
      class="relative flex-grow transition-[padding-left] ease-in-out duration-300  bg-primary flex flex-col text-white  min-h-screen"
      :class="sidebarOpen ? 'lg:pl-[490px]' : ''">
    @yield('content')
    @include('sections.sidebar')
</main>
@include('sections.footer')
@php(do_action('get_footer'))
@php(wp_footer())
</body>
</html>
