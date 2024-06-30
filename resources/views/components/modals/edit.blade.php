@props(['key'])

<div :id="$store.{{$key}}.prefix + '_editModal'" tabindex="-1"
     aria-hidden="true"
     class="hidden fixed top-0 left-0 right-0 z-50 items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div>
        <div class="relative w-full max-w-3xl max-h-full">
            <!-- Modal content -->
            <form class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"
                        x-text="$store.{{$key}}.options.modalTitle">
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            :data-modal-hide="$store.{{$key}}.prefix + '_editModal'">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <!-- Alert -->
                    <x-alerts.alert-list id="$store.{{$key}}.prefix" alertType="danger"></x-alerts.alert-list>
                    <x-alerts.alert id="$store.{{$key}}.prefix" alertType="success"></x-alerts.alert>

                    <div class="grid grid-cols-2 gap-6">
                        <!-- Loop input elements -->
                        <template x-for="item in $store.{{$key}}.options?.data">
                            <div :class="item?.class">
                                <label :for="item.id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" x-html="item.label">
                                </label>
                                <input :type="item.type" :name="item.name" :id="item.id" x-text="item.value" x-model="item.value"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Modal footer -->
                <div
                    class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button
                        type="button"
                        :id="$store.{{$key}}.prefix + '_save'"
                        @click="(e) => $store.{{$key}}.methods.save(e);"
                        class="text-white bg-blue-500 hover:bg-blue-500/90 focus:ring-4 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:focus:ring-blue-500/55 me-2 mb-2">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 2 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M11 16h2m6.707-9.293-2.414-2.414A1 1 0 0 0 16.586 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.414a1 1 0 0 0-.293-.707ZM16 20v-6a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v6h8ZM9 4h6v3a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4Z"/>
                        </svg>
                        Simpan
                    </button>
                    <button
                        type="button"
                        :id="$store.{{$key}}.prefix + '_cancel'"
                        @click="() => $store.{{$key}}.methods.cancel(e, $store.{{$key}}.prefix + '_cancel'); return false;"
                        :data-modal-toggle="$store.{{$key}}.prefix + '_editModal'"
                        class="text-white bg-red-500 hover:bg-red-500/90 focus:ring-4 focus:outline-none focus:ring-red-500/50 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center me-2 mb-2">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 2 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                        </svg>
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
