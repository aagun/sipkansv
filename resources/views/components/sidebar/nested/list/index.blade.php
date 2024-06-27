@props(['id' => 'dropdown'])

<ul id="{{$id}}" class="hidden py-2 space-y-2">
    {{$slot}}
</ul>
