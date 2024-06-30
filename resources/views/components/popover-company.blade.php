@props(['data' => ''])

@php
    $company = json_decode(str_replace('&quot;', '"', $data), true);
@endphp


{{$slot}}
<div data-popover id="{{$company['target']}}" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-80 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
    <div class="p-3">
        <div class="flex">
            <div class="me-3 shrink-0">
                <a target="_blank" href="{{$company['website']}}" class="block p-2 bg-gray-100 rounded-lg dark:bg-gray-700">
                    <img class="w-8 h-8 rounded-full" src="{{asset($company['logo'])}}" alt="{{$company['name']}}}}">
                </a>
            </div>
            <div>
                <p class="mb-1 text-base font-semibold leading-none text-gray-900 dark:text-white">
                    <a target="_blank" href="{{$company['website']}}" class="hover:underline">{{$company['name']}}</a>
                </p>
                <p class="mb-3 text-sm font-normal">{{$company['sector']}}</p>
                <p class="mb-4 text-sm">{{$company['description']}}</p>
                <ul class="text-sm">
                    <li class="flex items-center mb-2">
                        <span class="me-2 font-semibold text-gray-400">
                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.487 1.746c0 4.192 3.592 1.66 4.592 5.754 0 .828 1 1.5 2 1.5s2-.672 2-1.5a1.5 1.5 0 0 1 1.5-1.5h1.5m-16.02.471c4.02 2.248 1.776 4.216 4.878 5.645C10.18 13.61 9 19 9 19m9.366-6h-2.287a3 3 0 0 0-3 3v2m6-8a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                        </span>
                        <a target="_blank" href="{{$company['website']}}" class="text-blue-600 dark:text-blue-500 hover:underline">{{$company['website']}}</a>
                    </li>
                </ul>
                <div class="flex mt-5">
                    <a target="_blank" href="{{$company['website']}}" class="text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Kunjungi
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div data-popper-arrow></div>
</div>
