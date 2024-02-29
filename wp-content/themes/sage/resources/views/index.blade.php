@extends('layouts.app')

@section('content')
    <div id="dynamic-post"></div>
    <div id="current-post">
        @include ('partials/sections/page-header', [
   'image' => get_featured_image(),
   'title' => 'Nouvelles',
   ])
        <div
            id="grid"
{{--            class=" grid grid-cols-1 gap-x-4 gap-y-8 xs:grid-cols-2 lg:grid-cols-3 sm:gap-x-6 xl:gap-x-8 max-w-[1536px] py-[100px] w-full px-6 mx-auto"--}}
        >
            @while(have_posts())
                @php(the_post())
                <div class="grid-item">
                    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
                </div>
            @endwhile
        </div>
    </div>
@endsection
