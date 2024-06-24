@extends("components.dashboard.dashboard-layout")
@section("content")
    <div class="w-full" x-data="{isDelete: false, isShowForm: false, isShowFormEdit: false}">
        <div class="absolute w-full top-[-50px] left-0 right-0 bottom-0 bg-[rgba(243,244,246,0.7)] z-[100]"
                x-show="isDelete"
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
            <div class="w-[450px] m-auto bg-white mt-[200px] rounded-lg text-center p-[30px] shadow-2xl">
                <h2 class="font-bold text-[20px]">Konfirmasi Penghapusan</h2>
                <p class="text-[15px] mt-[30px]">Apakah Anda yakin ingin menghapus ini?</p>
                <div class="w-[200px] flex justify-between m-auto mt-[30px]">
                    <button class="py-1 px-2 bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Hapus</button>
                    <button @click="isDelete = !isDelete" class="py-1 px-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Batalkan</button>
                </div>
            </div>
        </div>

        <div class="absolute w-full top-[-50px] left-0 right-0 bottom-0 bg-[rgba(243,244,246,0.7)] z-[100]"
                x-show="isShowFormEdit"
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
            <div class="min-w-[450px] md:w-[650px] m-auto mt-[100px] bg-white mt-[200px] rounded-lg text-center p-[30px] shadow-2xl">
                <h2 class="font-bold text-[20px]">Ubah Pangkat</h2>
                <form action="">
                    @csrf
                    <div class="space-y-6 bg-white">
    
                        <div class="items-center w-full p-4 space-y-4 text-gray-800 md:inline-flex md:space-y-0">
                            <h2 class="max-w-sm mx-auto md:w-1/5 ">
                                Nama <span class="text-red-600">*</span>
                            </h2>
                            <div class="max-w-lg mx-auto md:w-4/5">
                                <div class=" relative ">
                                    <input type="text" name="name" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-600 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Nama" required />
                                </div>
                            </div>
                        </div>
                        <hr/>
    
                        <div class="items-center w-full p-4 space-y-4 text-gray-800 md:inline-flex md:space-y-0">
                            <h2 class="max-w-sm mx-auto md:w-1/5">
                                Deskripsi
                            </h2>
                            <div class="max-w-lg mx-auto md:w-4/5">
                                <div class=" relative">
                                    <textarea id="content" name="description" type="text" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-600 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Deskripsi" required ></textarea>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="w-[200px] flex justify-between m-auto mt-[30px]">
                            <button class="py-1 px-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Ubah</button>
                            <button @click="isShowFormEdit = !isShowFormEdit" class="py-1 px-2 bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Batalkan</button>
                        </div>
                    </div>
            </div>
        </div>

        <div class="py-1 px-4 text-white bg-gray-600 w-fit rounded-r-full">
            <h2>List Data Pangkat</h2>
        </div>

        <div class="w-full bg-gray-100 p-[10px] mt-[5px] border-[1px] border-gray-300 rounded-sm border-l-[3px] border-l-[#009142] mb-[10px]">
            <div x-show="isShowForm" class="rounded-xl border-gray-400 border-[1px] mb-[10px] p-[5px] bg-white shadow-md"
            x-transition:enter="transition ease-out duration-100 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">
                <form action="">
                    @csrf
                    <div class="space-y-6 bg-white">
    
                        <div class="items-center w-full p-4 space-y-4 text-gray-800 md:inline-flex md:space-y-0">
                            <h2 class="max-w-sm mx-auto md:w-1/5">
                                Nama <span class="text-red-600">*</span>
                            </h2>
                            <div class="max-w-lg mx-auto md:w-4/5">
                                <div class=" relative ">
                                    <input type="text" name="name" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-600 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Nama" required />
                                </div>
                            </div>
                        </div>
                        <hr/>
    
                        <div class="items-center w-full p-4 space-y-4 text-gray-800 md:inline-flex md:space-y-0">
                            <h2 class="max-w-sm mx-auto md:w-1/5">
                                Deskripsi
                            </h2>
                            <div class="max-w-lg mx-auto md:w-4/5">
                                <div class=" relative">
                                    <textarea id="content" name="description" type="text" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-600 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Deskripsi" required ></textarea>
                                </div>
                            </div>
                        </div>
                        <hr/>
                            
                        <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                            <div class="w-full px-4 pb-4 text-gray-500 md:w-1/3">
                                <button type="submit" class="py-2 px-4  bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                    Simpan
                                </button>
                            </div>
                        </div>    
                    </div>   
                
                </form> 
            </div>

            <div class="w-full flex flex-row-reverse text-center">
                <button @click="isShowForm = !isShowForm" class="text-[15px] font-bold text-gray-600 hover:text-gray-800 inline-flex items-center justify-center px-[10px] focus:outline-none bg-gray-300 hover:bg-gray-400 rounded-[100px]"><span x-show="isShowForm">X</span><span x-show="!isShowForm">Tambah Pangkat</span></button>
            </div>
        </div>

        <div class="p-[10px]">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4">
                                1
                            </td>
                            <td class="px-6 py-4">
                                tes
                            </td>
                            <td class="px-6 py-4">
                                
                            </td>
                            <td class="px-6 py-4">
                                <button @click="isShowFormEdit = !isShowFormEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">Ubah</button>
                                <button @click="isDelete = !isDelete" class="mx-1 font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection