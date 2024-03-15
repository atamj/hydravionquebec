
<div id="dynamic-post"></div>

<div id="current-post"  x-init="
  if (window.matchMedia('(min-width: 1025px)').matches) {sidebarOpen = true;}">
    <x-package></x-package>
</div>
