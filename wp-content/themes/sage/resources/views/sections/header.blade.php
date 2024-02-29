
<header
		x-data="{ scrolled: false, open: false }"
		x-init="() => {
            window.addEventListener('scroll', () => {
                scrolled = window.scrollY > 0;
            });
        }"
		class="fixed w-full z-[99999] transition-all ease-in	"
		:class="{'bg-primary ': scrolled}"
>
	<nav class="relative px-6 py-4 flex justify-between items-center h-[75px]">
		<a class="text-3xl font-bold leading-none" href="{{ get_current_language_code() == 'fr' ? '/' : '/en' }}">
			@if(get_field('logo_light', 'option'))
				<img decoding="async" loading="lazy" width="150" src="{{ get_field('logo_light', 'option') }}"
					 alt="Hydravion Québec">
			@endif
		</a>
		<div class="lg:hidden">
			<button @click="open = !open"
					class="navbar-burger flex items-center text-white hover:text-secondary p-6 absolute h-full right-0 top-0">
				<svg class="block h-4 w-[20px] h-[20px] fill-current" viewBox="0 0 20 20"
					 xmlns="http://www.w3.org/2000/svg">
					<title>Mobile menu</title>
					<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
				</svg>
			</button>
		</div>
		{{ wp_nav_menu([
			'theme_location' => 'primary_navigation',
			'container' => 'ul',
			'menu_id' => 'main-menu',
			'menu_class' => 'text-white hidden lg:flex lg:ml-auto lg:flex lg:items-center lg:w-auto lg:space-x-6 ',
		]) }}
	</nav>
	<nav x-show="open"
		 x-transition:enter="transition ease-in-out duration-300 transform"
		 x-transition:enter-start="translate-x-full"
		 x-transition:enter-end="-translate-x-0"
		 x-transition:leave="transition ease-in-out duration-300 transform"
		 x-transition:leave-start="-translate-x-0"
		 x-transition:leave-end="translate-x-full"
		 class="fixed top-0 right-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-primary text-white border-r overflow-y-auto">
		<div class="flex items-center mb-8">
			<button @click="open = !open" class="navbar-close ml-auto absolute right-0 top-0 p-6">
				<svg class="w-[20px] h-[20px] text-white cursor-pointer hover:text-secondary"
					 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						  d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</button>
		</div>
		<div>
		{{ wp_nav_menu([
			'theme_location' => 'mobile_navigation',
			'container' => 'ul',
			'menu_id' => 'mobile-menu',
			'menu_class' => '',
		]) }}
</div>
</nav>
</header>
