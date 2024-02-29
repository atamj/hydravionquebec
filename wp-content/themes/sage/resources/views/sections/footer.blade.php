<footer class="overflow-hidden transition-[padding-left] ease-in-out duration-300 mt-auto flex-0 relative pb-[40px]"
        :class="sidebarOpen ? 'lg:pl-[490px]' : ''">
    <img src="{{ asset('images/bg-footer.png') }}" class="z-[1] absolute  h-full w-screen object-cover" alt=""
         width="4160" height="6240"/>
    <div aria-hidden="true" class="absolute w-full  z-[1] h-full bg-gradient-to-p-90 opacity-70"></div>
    <div
        class="z-[2] flex flex-col lg:flex-row gap-y-8 gap-x-20 text-white py-12 md:pb-[100px] px-6 relative max-w-[1536px] mx-auto">
        <div class="flex flex-col gap-y-8">
            <a class="text-sm leading-6 " href="{{ get_current_language_code() == 'fr' ? '/' : '/en' }}">
                @if (get_field('logo_light', 'option'))
                    <img decoding="async" loading="lazy" width="250" src="{{ get_field('logo_light', 'option') }}"
                         alt="Hydravion Québec">
            </a>

        </div>

        <div class="flex flex-col gap-y-4">
            <p class="leading-loose" style="font-style:normal;font-weight:400">Base Mauricie : <br>30 Ch Contour-du-Lac-A-Beauce La Tuque, QC G9X&nbsp;3N8</p>
            <p class="leading-loose" style="font-style:normal;font-weight:400">Base Québec : <br>2029, 15e avenue St-Augustin-des-Desmaures, QC G3A&nbsp;1W7</p>
            <p class="leading-loose" style="font-style:normal;font-weight:400">Base Saguenay : <br>450, chemin 9 du Lac Sébastien, Saint-David-de-Falardeau, G0V&nbsp;1C0</p>
        </div>


        @endif
        <div class="flex gap-x-12 gap-y-8 flex-col lg:flex-row lg:justify-between lg:ml-auto">
            {{ wp_nav_menu([
                'theme_location' => 'footer_navigation',
                'container' => 'ul',
                'menu_id' => 'footer-menu',
                'menu_class' => 'flex-wrap text-white gap-x-4 flex lg:flex-col leading-loose px-lg-10 mr-auto',
            ]) }}


            <div>
                <p class="leading-loose">
                    <a class="text-white hover:text-secondary"
                       href="mailto:info@hydravionquebec.com">info@hydravionquebec.com</a>
                </p>
                <p class="leading-loose">
                    <a class="text-white hover:text-secondary" href="tel:418 204-2221">418 204-2221</a>
                </p>
                <ul class="flex gap-x-3 mt-2">
                    <li>
                        <a class="text-white hover:text-secondary" href="https://www.instagram.com/hydravion_qc/">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                 aria-hidden="true" focusable="false">
                                <path fill="currentColor"
                                      d="M12,4.622c2.403,0,2.688,0.009,3.637,0.052c0.877,0.04,1.354,0.187,1.671,0.31c0.42,0.163,0.72,0.358,1.035,0.673 c0.315,0.315,0.51,0.615,0.673,1.035c0.123,0.317,0.27,0.794,0.31,1.671c0.043,0.949,0.052,1.234,0.052,3.637 s-0.009,2.688-0.052,3.637c-0.04,0.877-0.187,1.354-0.31,1.671c-0.163,0.42-0.358,0.72-0.673,1.035 c-0.315,0.315-0.615,0.51-1.035,0.673c-0.317,0.123-0.794,0.27-1.671,0.31c-0.949,0.043-1.233,0.052-3.637,0.052 s-2.688-0.009-3.637-0.052c-0.877-0.04-1.354-0.187-1.671-0.31c-0.42-0.163-0.72-0.358-1.035-0.673 c-0.315-0.315-0.51-0.615-0.673-1.035c-0.123-0.317-0.27-0.794-0.31-1.671C4.631,14.688,4.622,14.403,4.622,12 s0.009-2.688,0.052-3.637c0.04-0.877,0.187-1.354,0.31-1.671c0.163-0.42,0.358-0.72,0.673-1.035 c0.315-0.315,0.615-0.51,1.035-0.673c0.317-0.123,0.794-0.27,1.671-0.31C9.312,4.631,9.597,4.622,12,4.622 M12,3 C9.556,3,9.249,3.01,8.289,3.054C7.331,3.098,6.677,3.25,6.105,3.472C5.513,3.702,5.011,4.01,4.511,4.511 c-0.5,0.5-0.808,1.002-1.038,1.594C3.25,6.677,3.098,7.331,3.054,8.289C3.01,9.249,3,9.556,3,12c0,2.444,0.01,2.751,0.054,3.711 c0.044,0.958,0.196,1.612,0.418,2.185c0.23,0.592,0.538,1.094,1.038,1.594c0.5,0.5,1.002,0.808,1.594,1.038 c0.572,0.222,1.227,0.375,2.185,0.418C9.249,20.99,9.556,21,12,21s2.751-0.01,3.711-0.054c0.958-0.044,1.612-0.196,2.185-0.418 c0.592-0.23,1.094-0.538,1.594-1.038c0.5-0.5,0.808-1.002,1.038-1.594c0.222-0.572,0.375-1.227,0.418-2.185 C20.99,14.751,21,14.444,21,12s-0.01-2.751-0.054-3.711c-0.044-0.958-0.196-1.612-0.418-2.185c-0.23-0.592-0.538-1.094-1.038-1.594 c-0.5-0.5-1.002-0.808-1.594-1.038c-0.572-0.222-1.227-0.375-2.185-0.418C14.751,3.01,14.444,3,12,3L12,3z M12,7.378 c-2.552,0-4.622,2.069-4.622,4.622S9.448,16.622,12,16.622s4.622-2.069,4.622-4.622S14.552,7.378,12,7.378z M12,15 c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3S13.657,15,12,15z M16.804,6.116c-0.596,0-1.08,0.484-1.08,1.08 s0.484,1.08,1.08,1.08c0.596,0,1.08-0.484,1.08-1.08S17.401,6.116,16.804,6.116z">
                                </path>
                            </svg>
                            <span class="screen-reader-text">Instagram</span>
                        </a>
                    </li>
                    <li>
                        <a class="text-white hover:text-secondary"
                           href="https://www.facebook.com/profile.php?id=100092987267024">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                 aria-hidden="true" focusable="false">
                                <path fill="currentColor"
                                      d="M12 2C6.5 2 2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.3v7C18.3 21.1 22 17 22 12c0-5.5-4.5-10-10-10z">
                                </path>
                            </svg>
                            <span class="screen-reader-text">Facebook</span>
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </div>
    <div
        class="flex flex-col md:flex-row z-[2] md:z-[99999] -mt-[1rem] pb-[50px] md:py-2 md:mt-0 gap-y-2 relative md:fixed bottom-0 w-full left-0 justify-between md:items-center md:bg-foreground-gray px-6">
        <a href="#nous-joindre"
           class="text-sm text-left leading-6 text-white hover:text-secondary">{{ __('Contact us', 'ng') }}</a>
        <p class="text-sm leading-6 text-white">{!! '@' . date('Y') . '&nbsp;' . __('Hydravion Québec - All rights reserved', 'ng') !!} </p>
        <a class="text-sm leading-6 text-white hover:text-secondary flex"
           href="https://hebertcommunication.com">DESIGN&nbsp;+&nbsp;WEB&nbsp;→
            <img decoding="async" loading="lazy" width="24" height="24"
                 style="float:right;width: 24px;margin-left: 10px;" src="{{ asset('images/hebert.png') }}"
                 alt="Hebert Communication">
        </a>
    </div>
</footer>


@include('partials.sections.contact-modal')
