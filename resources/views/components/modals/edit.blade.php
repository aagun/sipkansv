@props(['key'])

<div :id="$store.{{$key}}.prefix + '_editModal'" tabindex="-1"
     aria-hidden="true"
     class="hidden fixed top-0 left-0 right-0 z-50 items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div>
        <div class="relative w-full max-w-2xl max-h-full">
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
                    <button :id="$store.{{$key}}.prefix + '_save'"
                            type="button"
                            @click="(e) => $store.{{$key}}.methods.save(e);"
                            class="py-2 px-3 font-medium text-center text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-900">
                        Simpan
                    </button>
                    <button :id="$store.{{$key}}.prefix + '_cancel'"
                            type="button"
                            @click="() => $store.{{$key}}.methods.cancel(e, $store.{{$key}}.prefix + '_cancel'); return false;"
                            :data-modal-toggle="$store.{{$key}}.prefix + '_editModal'"
                            class="py-2 px-3 font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
