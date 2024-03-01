@extends('layouts.app')

@section('content')
    <div id="dynamic-post"></div>
    <div id="current-post" x-init="
  if (window.matchMedia('(min-width: 1025px)').matches) {
    setTimeout(() => { sidebarOpen = true; }, 2500);
  }
">
        <x-package></x-package>
    </div>
@endsection
