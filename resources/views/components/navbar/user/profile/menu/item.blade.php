@props([
    'label' => 'Item',
    'href' => '#'
])

<li>
    <a href="{{$href}}" class="block py-2 px-4 text-sm hover:bg-primary-100 dark:hover:bg-primary-600 dark:hover:text-white">
        {{$label}}
    </a>
</li>
