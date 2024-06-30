/**
 * Position global config
 * */
const POSITION_BASEURL = 'http://localhost:8000';
const POSITION_BASE_ENDPOINT = '/positions';
const POSITION_API_SEARCH = `${POSITION_BASEURL}${POSITION_BASE_ENDPOINT}/search`;
const POSITION_EDIT = 'positionEdit';
const POSITION_CREATE = 'positionCreate';
const POSITION_DELETE = 'positionDelete';
const POSITION = 'Jabatan';
const $positionTable = $('#tablePosition');

function positionCleanAlert(id) {
    _sipkan_clearAlert(id);
    _sipkan_clearAlertList(id);
}

function positionCleanUpMessage(id) {
    _sipkan_cleanAlert(id);
    _sipkan_cleanAlertList(id);
}

function positionRefreshTable() {
    $positionTable.bootstrapTable('refresh', {
        url: POSITION_API_SEARCH
    })
}

function positionResetTable() {
    $positionTable.bootstrapTable('resetSearch', {
        url: POSITION_API_SEARCH
    })
}

/**
 * Alpine config
 * */
const POSITION_STORE_EDIT = 'positionStoreEdit';
const POSITION_STORE_CREATE= 'positionStoreCreate';
const POSITION_STORE_DELETE= 'positionStoreDelete';

function positionCreateAlpineConfig() {
    Alpine.store(POSITION_STORE_CREATE, {
        prefix: POSITION_CREATE,
        options: {
            modalTitle: "Tambah Data " + POSITION,
            data: {
                name: {
                    type: 'text',
                    id: `${this.prefix}_name`,
                    name: `name`,
                    value: '',
                    label: `${POSITION} <span class="text-red-600">*</span>`
                },
                description: {
                    type: 'text',
                    id: `${this.prefix}_description`,
                    name: `description`,
                    value: '',
                    label: 'Description'
                }
            },
            rules: {
                name: ['required']
            },
        },
        methods: {
            cancel(e, id) {
                e.preventDefault();
                const options = _sipkan_getSotreData(POSITION_STORE_CREATE).options;
                for (const [attribute, item] of Object.entries(options.data)) {
                    console.log({item});
                }
            },
            async save(e) {
                e.preventDefault();
                console.log('Save function on edit fired');
                positionCleanAlert(POSITION_CREATE);
                function cleanMarkErrors(type, id) {
                    if (type !== 'hidden') {
                        _sipkan_getElementLabel(id).parent()
                            .removeClass('sipkan__has-error');
                    }
                }

                function composeFormData([key, item]) {
                    cleanMarkErrors(item.type, item.id);
                    return {[key]: item.value }
                }

                let {data, hasError} = _sipkan_validateFormData(POSITION_STORE_CREATE);

                if (hasError) return false;

                data = Object.entries(data)
                    .map(composeFormData)
                    .reduce((item, obj) => ({...item, ...obj}), {});

                _sipkan_http.post(POSITION_BASE_ENDPOINT, data)
                    .then(response => {
                        if (_sipkan_ok(response)) {
                            _sipkan_setAlertMessage(POSITION_CREATE, response.data.message);
                            setTimeout(() =>{
                                _sipkan_closeModal(POSITION_CREATE + '_createModal');
                                positionRefreshTable();
                            }, 5_000);
                        }
                    })
                    .catch(error => {
                        _sipkan_setMessageAlertList(POSITION_CREATE, [_sipkan_messages.error.server]);
                    })
                    .finally(() => {
                        setTimeout(() => {
                            console.log('finally');
                            positionCleanAlert(POSITION_CREATE);
                        }, 5_000)
                    });
            }
        },
        setOptions() {
            positionCleanAlert(POSITION_CREATE);
            _sipkan_cleanInputs(this.options.data);
            _sipkan_toggleModal(POSITION_CREATE + '_createModal')
        }
    });
}
function positionEditAlpineConfig() {
    Alpine.store(POSITION_STORE_EDIT, {
        prefix: POSITION_EDIT,
        options: {},
        methods: {
            cancel(e, id) {
                e.preventDefault();
                const options = _sipkan_getSotreData(POSITION_STORE_EDIT).options;
                for (const [attribute, item] of Object.entries(options.data)) {
                    console.log({item});
                }
            },
            async save(e) {
                e.preventDefault();
                console.log('Save function on edit fired');
                function cleanMarkErrors(type, id) {
                    if (type !== 'hidden') {
                        _sipkan_getElementLabel(id).parent()
                            .removeClass('sipkan__has-error');
                    }
                }

                function composeFormData([key, item]) {
                    cleanMarkErrors(item.type, item.id);
                    return {[key]: item.value }
                }


                let {data, hasError, objAlertList} = _sipkan_validateFormData(POSITION_STORE_EDIT);

                if (hasError) return false;

                data = Object.entries(data)
                    .map(composeFormData)
                    .reduce((item, obj) => ({...item, ...obj}), {});

                _sipkan_http.put(POSITION_BASE_ENDPOINT, data)
                    .then(response => {
                        if (_sipkan_ok(response)) {
                            _sipkan_setAlertMessage(POSITION_EDIT, response.data.message);
                            setTimeout(() =>{
                                _sipkan_closeModal(POSITION_EDIT + '_editModal');
                                positionRefreshTable();
                            }, 5_000);
                        }
                    })
                    .catch(error => {
                        _sipkan_setMessageAlertList(POSITION_EDIT, [_sipkan_messages.error.server]);
                    })
                    .finally(() => {
                        setTimeout(() => {
                            console.log('finally');
                            positionCleanAlert(POSITION_EDIT);
                        }, 5_000)
                    });
            }
        },
        setOptions(data) {
            const row = JSON.parse(atob(data));
            this.options = {
                modalTitle: "Ubah Data " + POSITION,
                data: {
                    id: {
                        type: 'hidden',
                        id: `${this.prefix}_id`,
                        name: `id`,
                        value: row.id,
                        label: 'Id',
                        class: 'hidden'
                    },
                    name: {
                        type: 'text',
                        id: `${this.prefix}_name`,
                        name: `name`,
                        value: row.name,
                        label: `${POSITION} <span class="text-red-600">*</span>`
                    },
                    description: {
                        type: 'text',
                        id: `${this.prefix}_description`,
                        name: `description`,
                        value: row.description,
                        label: 'Description'
                    }
                },
                rules: {
                    name: ['required']
                },
            };

            positionCleanAlert(POSITION_EDIT);
            _sipkan_toggleModal(POSITION_EDIT + '_editModal')
        }
    });
}

function positionDeleteAlpineConfig() {
    Alpine.store(POSITION_STORE_DELETE, {
        prefix: POSITION_DELETE,
        options: {},
        methods: {
            cancel(e, id) {
                e.preventDefault();
            },
            async delete() {
                console.log('Delete function on edit fired');
                const {data} = _sipkan_getSotreData(POSITION_STORE_DELETE).options;
                _sipkan_http.delete(`${POSITION_BASE_ENDPOINT}/${data.id.value}`)
                    .then(response => {
                        if (_sipkan_ok(response)) {
                            _sipkan_setGlobalMessageSuccess(response.data.message);
                        } else {
                            _sipkan_setGlobalMessageError(response.data.message);
                        }
                    })
                    .catch(error => {
                        _sipkan_setGlobalMessageError(_sipkan_messages.error.server);
                    }).finally((params) => {
                    _sipkan_toggleModal(POSITION_DELETE + '_deleteModal');
                    positionRefreshTable();
                    setTimeout(() => {
                        _sipkan_clearGolbalMessageSuccess();
                        _sipkan_clearGolbalMessageError();
                    }, 2_000);
                });
            }
        },
        setOptions(data) {
            const row = JSON.parse(atob(data));
            this.options = {
                modalTitle: `Apakah anda yakin ingin menghapus data golongan ${row.name}?`,
                data: {
                    id: {
                        attribute: `id`,
                        value: row.id,
                    },
                    name: {
                        attribute: `name`,
                        value: row.name,
                        label: `Golongan`
                    }
                }
            };
            _sipkan_toggleModal(POSITION_DELETE + '_deleteModal');
        }
    });
}

document.addEventListener('alpine:init', () => {
    positionCreateAlpineConfig();
    positionEditAlpineConfig();
    positionDeleteAlpineConfig();
});

/**
 * Bootstrap table config
 * */
function tablePosition_params(params) {
    if (Object.hasOwn(params, 'filter')) {
        const filter = JSON.parse(params.filter);
        return {
            limit: params.limit,
            offset: (params.offset / params.limit) + 1,
            order: params.order,
            sort: params.sort,
            search: filter
        }
    }

    return {
        ...params,
        offset: (params.offset / params.limit) + 1
    };
}

function tablePosition_responseHandler(res) {
    return {
        rows: res.data.data,
        total: res.data.total
    };
}

function tablePosition_actions(value, row, index) {
    const data = btoa(JSON.stringify(row));

    return `
                <div class="flex gap-4">
                    <a href="#"
                        type="button"
                        @click="$store.${POSITION_STORE_EDIT}.setOptions('${data}')"
                        data-modal-target="${POSITION_EDIT}_editModal"
                        data-modal-show="${POSITION_EDIT}_editModal"
                        class="font-medium text-primary-500 dark:text-primary-400 hover:underline">
                        Ubah
                    </a>
                    <a href="#"
                        type="button"
                         @click="$store.${POSITION_STORE_DELETE}.setOptions('${data}')"
                        data-modal-target="${POSITION_DELETE}_deleteModal"
                        data-modal-show="${POSITION_DELETE}_deleteModal"
                        class="font-medium text-red-500 dark:text-red-500 hover:underline">
                        Hapus
                    </a>
                </div>
                `
}

$positionTable.bootstrapTable({
    url: POSITION_API_SEARCH,
    method: 'post',
    height: 510,
    pagination: true,
    filterControl: true,
    sidePagination: 'server',
    serverSort: true,
    paginationLoop: true,
    paginationPagesBySide: 1,
    paginationSuccessivelySize: 3,
    pageList: [5, 10, 25, 50, 100],
    sortName: 'id',
    sortOrder: 'asc',
    queryParams: tablePosition_params,
    responseHandler: tablePosition_responseHandler,
    columns: [
        {
            title: 'ID',
            field: 'id',
            sortable: true,
            align: 'center',
            valign: 'middle',
            width: 50,
        },
        {
            title: 'Pangkat',
            field: 'name',
            filterControl: 'input',
            sortable: true,
            align: 'center',
            valign: 'middle',
        },
        {
            title: 'Deskripsi',
            field: 'description',
            sortable: true,
            align: 'center',
            valign: 'middle',
        },
        {
            title: 'Aksi',
            align: 'center',
            valign: 'middle',
            width: 150,
            formatter: tablePosition_actions
        }
    ],
    loadingTemplate: () => `
                <div class="text-center">
                    <div role="status">
                        <svg aria-hidden="true" class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>`,
});
