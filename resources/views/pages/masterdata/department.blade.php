@php use Illuminate\Support\Str; @endphp
@extends('layout');

@php
    $APP_PREFIX = 'Department';
    $APP_TITLE = 'Unit Kerja';
@endphp

@section('title', $APP_TITLE);

@section('content')
    <!-- Breadcrumb -->
    <nav class="flex mt-8 mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="breadcrumb__item inline-flex items-center text-sm font-medium text-gray-700 ">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Data Master
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="#"
                       class="breadcrumb__item ms-1 text-sm font-medium text-gray-700 md:ms-2">{{$APP_TITLE}}</a>
                </div>
            </li>
        </ol>
    </nav>

    <div x-data>
        <h2 class="text-3xl md:text-4xl mt-5 mb-5 font-extrabold dark:text-white">Data Master {{$APP_TITLE}}</h2>
        <div
            class="mt-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex gap-3 justify-center md:justify-start mb-4">
                <button
                    @click="() => $store?.{{Str::camel($APP_PREFIX)}}StoreCreate?.setOptions()"
                    type="button"
                    data-modal-target="{{Str::camel($APP_PREFIX)}}Create_createModal"
                    data-modal-show="{{Str::camel($APP_PREFIX)}}Create_createModal"
                    class="w-full md:w-fit px-3 py-2.5 text-sm font-medium text-white flex gap-2 justify-center md:inline-flex md:items-center bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                         viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                              d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span>Tambah Data</span>
                </button>
                <button
                    onclick="{{Str::camel($APP_PREFIX).'ResetTable'}}()"
                    type="button"
                    class="w-full md:w-fit px-3 py-2.5 text-sm font-medium text-white flex gap-2 justify-center md:inline-flex md:items-center bg-yellow-500 hover:bg-yellow-600/90 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg text-center">
                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                    </svg>
                    <span>Refresh</span>
                </button>
            </div>
            <!-- Bootstrap Table -->
            <div class="grid grid-cols-1 gap-4 mb-4">
                <table
                    id="table{{$APP_PREFIX}}"
                    data-toggle="table"
                    data-pagination-h-align="right"
                    data-pagination-detail-h-align="left">
                </table>
            </div>
        </div>

        <!-- create modal -->
        <x-modals.create key="{{Str::camel($APP_PREFIX)}}StoreCreate"/>

        <!-- Edit modal -->
        <x-modals.edit key="{{Str::camel($APP_PREFIX)}}StoreEdit"/>

        <!-- Delete modal -->
        <x-modals.delete key="{{Str::camel($APP_PREFIX)}}StoreDelete"/>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('assets/js/pages/masterdata/'.Str::lower($APP_PREFIX).'.js')}}"></script>
@endpush
