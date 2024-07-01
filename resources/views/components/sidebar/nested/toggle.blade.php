@props(['target' => 'item-drop', 'label' => "Item", 'active' => 0])

@php
    $active = $active == 1 ? 'true' : 'false';
@endphp

<button
    type="button"
    class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group sidebar__item__nested-hover"
    aria-controls="{{$target}}"
    data-collapse-toggle="{{$target}}">
    {{$slot}}
</button>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        if ({{$active}}) {
            setTimeout(() => {
                const target = '{{$target }}';
                console.log({target});
                document.querySelector(`[data-collapse-toggle="${target}"]`).click();
            }, 500);
        }
    });
</script>
