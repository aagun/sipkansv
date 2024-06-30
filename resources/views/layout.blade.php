<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{asset("assets/img/favicon.ico")}}">
    <title>@yield('title') | SIPKAN</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
    <script src="{{asset("/assets/js/commons/messages.js")}}"></script>
    <script src="{{asset("/assets/js/commons/rules.js")}}"></script>
    <script src="{{asset("/assets/js/commons/commons.js")}}"></script>
    @vite(['resources/css/app.css'])Save function on edit fired
    @stack('styles')
</head>
<body>
    @php
        $fullName = 'Fulan bin Fulan';
        $photo = 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png';
        $position = 'Administrator'
    @endphp

    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar :$fullName :$photo :$position/>
        <x-sidebar/>
        <main class="p-4 lg:ml-64 h-auto pt-40 mt-8">
            <div id="sipkanGlobalMessageSuccess_alert"
                 class="opacity-0 hidden flex justify-between p-3 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                 role="alert">
                <div class="ms-3 text-sm font-medium" data-message>
                </div>
                <div class="flex items-end align-self-start">
                    <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#sipkanGlobalMessageSuccess_alert"
                            aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="sipkanGlobalMessageError_alert"
                 class="opacity-0 hidden flex justify-between p-3 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                 role="alert">
                <div class="ms-3 text-sm font-medium" data-message>
                </div>
                <div class="flex items-end align-self-start">
                    <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#sipkanGlobalMessageError_alert"
                            aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            </div>
            @yield('content')
        </main>
        <x-footer/>
    </div>
</body>

@vite(['resources/js/app.js'])
<script defer src="{{asset("/assets/js/commons/http.js")}}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@stack("scripts")
</html>
