@props(['target' => 'item-drop', 'label' => "Item"])

<button
    type="button"
    class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group sidebar__item__nested-hover"
    aria-controls="{{$target}}"
    data-collapse-toggle="{{$target}}">
    {{$slot}}
</button>
