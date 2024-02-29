@props(['video'])


<div class="video-wrapper">
    <iframe {{ $attributes }}></iframe><br>
    {{ $slot }}
</div>
