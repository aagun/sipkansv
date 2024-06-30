@extends('layout');

@section('title', 'Dashboard');

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-fit md:h-32">
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between">
                    <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                            <span id="subTitlePengawasanRutin"></span>
                            Laporan
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400" id="titlePengawasanRutin">
                            Pengawasan Rutin
                        </p>
                    </div>
                </div>
                <div id="canvasPengawasanRutin"></div>
            </div>
        </div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-fit md:h-32">
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between">
                    <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                            <span id="subTitlePengawasanInsidental"></span>
                            Laporan
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400" id="titlePengawasanInsidental">
                            Pengawasan Rutin
                        </p>
                    </div>
                </div>
                <div id="canvasPengawasanInsidental"></div>
            </div>
        </div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-fit md:h-32">
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between">
                    <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                            <span id="subTitlePengawasanPatroli"></span>
                            Laporan
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400" id="titlePengawasanPatroli">
                            Pengawasan Patroli
                        </p>
                    </div>
                </div>
                <div id="canvasPengawasanPatroli"></div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-4 mt-48">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-full"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div
            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
    </div>
    <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
    ></div>
    <div class="grid grid-cols-2 gap-4">
        <div
            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
@endpush

