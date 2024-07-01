@props([
    'active' => 0,
    'href' => '#'
])

@php $activeClass = $active == 1 ? 'active' : '' @endphp

<li>
    <a href="{{$href}}" class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group sidebar__item__nested-hover {{$activeClass}}">
        {{$slot}}
    </a>
</li>
