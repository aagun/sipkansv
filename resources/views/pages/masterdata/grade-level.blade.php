@extends('layout');

@section('title', 'Pengguna');

@push('styles')
@endpush

@section('content')
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

    <div class="grid grid-cols-1 gap-4 mb-4">
        <div
            class="mt-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <table
                id="tableGradeLevel"
                data-toggle="table"
                data-height="460"
                data-pagination-h-align="right"
                data-pagination-detail-h-align="left"
                data-url="{{env('API_URL')}}/grade-levels/search">
            </table>
        </div>
    </div>


    <!-- Edit modal -->
    <x-modals.edit
        form="{{json_encode([])}}"
        prefix="gradeLevel"
        header="Ubah Data Golongan"
    />
    <!-- End Edit modal -->

    <!-- Delete modal -->
    <div id="tableGradeLevel_deleteModal" tabindex="-1" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="tableGradeLevel_deleteModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
                <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin ingin menghapus data?</p>
                <div class="flex justify-center items-center space-x-4">
                    <button
                        class="py-2 px-3 font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Hapus
                    </button>
                    <button data-modal-toggle="tableGradeLevel_deleteModal" type="button"
                            class="py-2 px-3 font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Emd Delete modal -->

@endsection

@push('scripts')
    <script>
        const GRADE_LEVEL_KEY = 'gradeLevelStore';
        alpineInitStore(GRADE_LEVEL_KEY);
        function tableGradeLevel_params(params) {
            return {
                ...params,
                offset: (params.offset / params.limit) + 1
            };
        }

        function tableGradeLevel_responseHandler(res) {
            return {
                rows: res.data.data,
                total: res.data.total
            };
        }

        function gradeLevelEditStoreOption(data) {
            const row = JSON.parse(atob(data));
            const PREFIX = 'grade_level';
            const options = {
                data: {
                    edit: [
                        {
                            key: true,
                            type: 'hidden',
                            name: `${PREFIX}_id`,
                            value: row.id
                        },
                        {
                            type: 'text',
                            id:
                                `${PREFIX}_name`,
                            name:
                                `${PREFIX}_name`,
                            value:
                            row.name
                        },
                        {
                            type: 'text',
                            id:
                                `${PREFIX}_description`,
                            name:
                                `${PREFIX}_description`,
                            value:
                            row.description
                        }
                    ]
                }
            }

            Alpine.store(GRADE_LEVEL_KEY, {options});
        }

        function gradeLevelDeleteStoreOption($id) {

        }


        function tableGradeLevel_actions(value, row, index) {
            const data = btoa(JSON.stringify(row));

            return `
                <div class="flex gap-4">
                    <a href="#"
                        @click="gradeLevelEditStoreOption('${data}')"
                        type="button"
                        data-modal-target="gradeLevel_editModal"
                        data-modal-show="gradeLevel_editModal"
                        class="font-medium text-primary-500 dark:text-primary-500 hover:underline">
                        Ubah
                    </a>
                    <a href="#"
                        type="button"
                        data-modal-target="tableGradeLevel_deleteModal"
                        data-modal-show="tableGradeLevel_deleteModal"
                        class="font-medium text-red-600 dark:text-red-500 hover:underline">
                        Hapus
                    </a>
                </div>
                `
        }

        function gradeLevelEdit({id, name, description}) {
            $('#grade_level_id').val(id);
            $('#grade_level_name').val(name);
            $('#grade_level_description').val(description);
        }

        async function gradeLevelDoEdit() {
            const requestBody = {
                id: $('#grade_level_id').val(),
                name: $('#grade_level_name').val(),
                description: $('#grade_level_description').val()
            }
        }

        const $gradeLevelTable = $('#tableGradeLevel')

        $gradeLevelTable.bootstrapTable({
            method: 'post',
            pagination: true,
            sidePagination: 'server',
            serverSort: true,
            paginationLoop: true,
            paginationPagesBySide: 1,
            paginationSuccessivelySize: 3,
            pageList: [5, 10, 25, 50, 100],
            sortName: 'id',
            sortOrder: 'asc',
            queryParams: tableGradeLevel_params,
            responseHandler: tableGradeLevel_responseHandler,
            columns: [
                {
                    title: 'ID',
                    field: 'id',
                    sortable: true,
                    align: 'center',
                    width: 50,
                },
                {
                    title: 'Golongan',
                    field: 'name',
                    sortable: true,
                    align: 'center',
                },
                {
                    title: 'Deskripsi',
                    field: 'description',
                    sortable: true,
                    align: 'center',
                },
                {
                    title: 'Aksi',
                    align: 'center',
                    width: 150,
                    formatter: tableGradeLevel_actions
                }
            ]
        });
    </script>
@endpush
