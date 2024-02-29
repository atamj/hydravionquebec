@props(['as' => 'p'])

<{{$as}} {{$attributes->merge(['class' => $theme()])}}>
{{$slot}}
</{{$as}}>