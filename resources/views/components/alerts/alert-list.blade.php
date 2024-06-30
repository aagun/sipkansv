@props(['alertType' => 'danger', 'id'])
@php
    $alertTypeList = [
        'danger' => 'red',
        'info' => 'blue',
        'warn' => 'yellow',
        'success' => 'green'
    ];
@endphp

<div :id="{{$id}} + '_alert_list'"
     class="opacity-0 hidden flex justify-between p-3 mb-4 text-{{$alertTypeList[$alertType]}}-800 rounded-lg bg-{{$alertTypeList[$alertType]}}-50 dark:bg-gray-800 dark:text-{{$alertTypeList[$alertType]}}-400"
     role="alert">
    <ul class="ms-4 me-2 mt-3 mb-2 text-sm font-medium list-disc list-inside">
    </ul>
    <div class="flex items-end align-self-start">
        <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-{{$alertTypeList[$alertType]}}-50 text-{{$alertTypeList[$alertType]}}-500 rounded-lg focus:ring-2 focus:ring-{{$alertTypeList[$alertType]}}-400 p-1.5 hover:bg-{{$alertTypeList[$alertType]}}-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-{{$alertTypeList[$alertType]}}-400 dark:hover:bg-gray-700"
                :data-dismiss-target="'#' + {{$id}} + '_alert_list'"
                aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</div>
