<div class="bg-white ">
    <div class="px-6 max-w-[1536px]  mx-auto">
        @php
            $myquery = new WP_Query(array(
                'post_type' => get_post_type(),
                'posts_per_page' => 3,
                'order' => 'DESC',
                'orderby' => 'date'
            ));
        @endphp

        <div class="my-20">
            <x-text as="h2" theme="h2" class=" my-12 text-center text-primary">Articles récents</x-text>
            <div
                class="grid grid-cols-1 gap-x-4 gap-y-8 xs:grid-cols-2 lg:grid-cols-3 sm:gap-x-6 xl:gap-x-8 w-full mx-auto">
                @foreach($myquery->get_posts() as $post)
                    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
                @endforeach
            </div>
        </div>
    </div>

    <div style="border-top-color:#eaeaea;border-top-width:1px" class="px-6">
        @php
            the_post_navigation(array(
                   'prev_text' => '<span class="nav-subtitle">' . esc_html__('←', 'hc') . '</span> <span class="nav-title">%title</span>',
                   'next_text' => '<span class="nav-subtitle">' . esc_html__('→', 'hc') . '</span> <span class="nav-title">%title</span>',
            ));
           wp_reset_postdata();
        @endphp
    </div>

</div>
