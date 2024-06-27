@props([
    'active' => false,
    'label' => 'harap_ubah_label_ini',
    'href' => '#'
])

<li>
    <a href="{{$href}}"
       class="flex items-center p-2 text-base font-medium rounded-lg sidebar__item group {{$active ? 'active' : ''}}">
        {{$slot}}
        <span class="ml-3">{{$label}}</span>
    </a>
</li>
