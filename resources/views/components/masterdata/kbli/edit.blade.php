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
                    <x-alerts.alert id="$store.{{$key}}.prefix" alertType="success" style="margin-top: -0.2rem !important;" class="-mt-0.5"></x-alerts.alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div :class="$store?.{{$key}}?.options?.data?.code.class">
                            <label :for="$store?.{{$key}}?.options?.data?.code.id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   x-html="$store?.{{$key}}?.options?.data?.code?.label">
                            </label>
                            <input :type="$store?.{{$key}}?.options?.data?.code?.type"
                                   :name="$store?.{{$key}}?.options?.data?.code?.name"
                                   :id="$store?.{{$key}}?.options?.data?.code?.id"
                                   x-model="$store.{{$key}}.options.data.code.value"
                                   x-text="$store.{{$key}}.options.data?.code.value"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div :class="$store?.{{$key}}?.options.data.name?.class">
                            <label :for="$store?.{{$key}}?.options?.data?.name?.id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   x-html="$store?.{{$key}}?.options?.data?.name?.label"></label>
                            <input :type="$store?.{{$key}}?.options?.data?.name?.type"
                                   :name="$store?.{{$key}}?.options?.data?.name?.name"
                                   :id="$store?.{{$key}}?.options?.data?.name?.id"
                                   x-model="$store.{{$key}}.options.data.name.value"
                                   x-text="$store.{{$key}}.options.data.name.value"
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label :for="$store?.{{$key}}?.options?.data?.sub_sector_id?.id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   x-html="$store?.{{$key}}?.options?.data?.sub_sector_id?.label">
                            </label>
                            <select :id="$store?.{{$key}}?.options?.data?.sub_sector_id?.id"
                                    x-model="$store.{{$key}}.options.data.sub_sector_id.value"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" x-text="$store.{{$key}}?.options?.data?.sub_sector_id?.default_placeholder_name"></option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div
                    class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button
                        type="button"
                        :id="$store.{{$key}}.prefix + '_save'"
                        @click="(e) => $store.{{$key}}.methods.save(e);"
                        class="w-full md:w-fit px-3 py-2.5 text-sm font-medium text-white flex gap-2 justify-center md:inline-flex md:items-center bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-6 h-6 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7.414A2 2 0 0 0 20.414 6L18 3.586A2 2 0 0 0 16.586 3H5Zm3 11a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v6H8v-6Zm1-7V5h6v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M14 17h-4v-2h4v2Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Simpan</span>
                    </button>
                    <button
                        type="button"
                        :id="$store.{{$key}}.prefix + '_cancel'"
                        @click="() => $store.{{$key}}.methods.cancel(e, $store.{{$key}}.prefix + '_cancel'); return false;"
                        :data-modal-toggle="$store.{{$key}}.prefix + '_editModal'"
                        class="w-full md:w-fit px-3 py-2.5 text-sm font-medium text-white flex gap-2 justify-center md:inline-flex md:items-center bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Batal</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
