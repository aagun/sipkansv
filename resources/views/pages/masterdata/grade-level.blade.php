@extends('layout');

@section('title', 'Golongan');

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
                    <a href="#" class="breadcrumb__item ms-1 text-sm font-medium text-gray-700 md:ms-2">Golongan</a>
                </div>
            </li>
        </ol>
    </nav>

    <div x-data>
        <!-- Bootstrap Table -->
        <div class="grid grid-cols-1 gap-4 mb-4">
            <div
                class="mt-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <table
                    id="tableGradeLevel"
                    data-toggle="table"
                    data-height="460"
                    data-pagination-h-align="right"
                    data-pagination-detail-h-align="left">
                </table>
            </div>
        </div>

        <!-- Edit modal -->
        <x-modals.edit key="gradeLevelStoreEdit"/>

        <!-- Delete modal -->
        <x-modals.delete key="gradeLevelStoreDelete"/>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('assets/js/masterdata/grade-level.js')}}"></script>
@endpush
