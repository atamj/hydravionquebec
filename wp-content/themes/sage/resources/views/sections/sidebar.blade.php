<div @click="sidebarOpen = !sidebarOpen" id="sidebarform-toggle"
	 class="cursor-pointer fixed top-[100px] right-0 z-[9999] hidden md:block">
	<img decoding="async" width="50" src="{{ asset('images/sidebar-form.svg') }}" alt="">
</div>

<div @click="sidebarOpen = !sidebarOpen" id="sidebarform-toggle"
     class="cursor-pointer fixed bottom-0 left-0 w-full z-[99999] bg-primary flex items-center justify-between gap-x-[30px] shadow-inner md:hidden">
    <span class="px-6 font-medium">RÉSERVATION</span>
    <img decoding="async" width="50" src="{{ asset('images/sidebar-form-aside-icon.svg') }}" alt="">

</div>
<aside
		x-show="sidebarOpen"
		x-transition:enter="transition ease-in-out duration-300 transform"
		x-transition:enter-start="-translate-x-full"
		x-transition:enter-end="translate-x-0"
		x-transition:leave="transition ease-in-out duration-300 transform"
		x-transition:leave-start="translate-x-0"
		x-transition:leave-end="-translate-x-full"
		id="secondary"
		class="sidebar-form z-[9999] bg-primary fixed max-w-full w-[490px] top-0 left-0 bottom-0 text-white py-[120px] px-6 overflow-y-auto">
	{!! do_shortcode('[gravityform id="24" title="false" description="false" ajax="true"]') !!}


    @include('partials.sections.sidebar-map')



</aside>

