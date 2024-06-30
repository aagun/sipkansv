@extends("components.dashboard.dashboard-layout")
@section("content")
    <div class="w-full" x-data="{isShowSearch: true, isDelete:false}">
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
                <p class="text-[15px] mt-[30px]">Apakah Anda yakin ingin menghapus item ini?</p>
                <div class="w-[200px] flex justify-between m-auto mt-[30px]">
                    <button class="py-1 px-2 bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Hapus</button>
                    <button @click="isDelete = !isDelete" class="py-1 px-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Batalkan</button>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="py-1 px-4 text-white bg-gray-600 w-fit rounded-r-full">
                <h2>Daftar Data Pengguna</h2>
            </div>
            <div class="w-full bg-gray-100 p-[10px] mt-[5px] border-[1px] border-gray-300 rounded-sm border-l-[3px] border-l-primary-500">
                <div x-show="isShowSearch"
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                    <form action="">
                        <table>
                            <tbody class="flex flex-col gap-3">
                                <tr>
                                    <td class="w-[200px]">NIP/NIK</td>
                                    <td><input type="text" class="border-gray-400 border-[1px] focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent px-2"></td>
                                </tr>
                                <tr>
                                    <td class="w-[200px]">Pangkat</td>
                                    <td><input type="text" class="border-gray-400 border-[1px] focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent px-2"></td>
                                </tr>
                                <tr>
                                    <td class="w-[200px]">Golongan Ruang</td>
                                    <td><input type="text" class="border-gray-400 border-[1px] focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent px-2"></td>
                                </tr>
                                <tr>
                                    <td class="w-[200px]">Pendidikan</td>
                                    <td><input type="text" class="border-gray-400 border-[1px] focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent px-2"></td>
                                </tr>
                                <tr>
                                    <td class="w-[200px]">Unit Kerja</td>
                                    <td><input type="text" class="border-gray-400 border-[1px] focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent px-2"></td>
                                </tr>
                                <tr>
                                    <td class="w-[200px]">Instansi</td>
                                    <td><input type="text" class="border-gray-400 border-[1px] focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent px-2"></td>
                                </tr>
                                <tr>
                                    <td class="w-[200px]">Status</td>
                                    <td><select name="" id="" class="border-gray-400 border-[1px] focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent px-2 w-[200px]">
                                        <option value="">Semua</option>
                                        <option value="">Aktif</option>
                                        <option value="">Tidak Aktif</option>
                                    </select></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="my-[10px] text-white">
                            <button type="submit" class="bg-[#09afed] hover:bg-blue-600 active:bg-blue-800 rounded-sm px-3 py-1"><i class="fas fa-search mr-[5px]"></i>Cari</button>
                            <button class="bg-[#09afed] hover:bg-blue-600 active:bg-blue-800 rounded-sm px-3 py-1"><i class="fas fa-undo-alt mr-[5px]"></i>reset</button>
                        </div>
                    </form>
                </div>
                <div class="w-full flex flex-row-reverse text-center">
                    <button @click="isShowSearch = !isShowSearch" class="text-[15px] font-bold text-gray-600 hover:text-gray-800 inline-flex items-center justify-center px-[10px] focus:outline-none bg-gray-300 hover:bg-gray-400 rounded-[100px]"><span x-show="isShowSearch">X</span><span x-show="!isShowSearch">Cari Pengguna</span></button>
                </div>
            </div>
        </div>

        <div class="w-full">
            <div class="mt-[20px] mb-[10px]  flex justify-between">
                <a href="/dashboard/users/buat" class="py-2 px-4  bg-primary-600 hover:bg-primary-700 focus:ring-primary-500 focus:ring-offset-primary-200 text-white w-fit transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 ">Tambah Pengguna</a>
            </div>
            <div class="overflow-x-scroll p-[5px]">
                <table class="table p-4 bg-gray-100 rounded-lg shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                No
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                NIP/NIK
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Pangkat
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Golongan Ruang
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Pendidikan
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Unit Kerja
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Instansi
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                kontak
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Email
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Username
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Password
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Status
                            </th>
                            <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="text-gray-700">
                            <td class="border p-4 dark:border-dark-5 text-center">
                                1
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                adminsipkan
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                tes
                            </td>
                            <td class="border p-4 dark:border-dark-5">
                                -
                            </td>
                            <td class="border p-4 dark:border-dark-5 flex gap-2">
                                <button type="button" class="py-1 px-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                    Ubah
                                </button>
                                <button @click="isDelete = !isDelete" type="button" class="py-1 px-2 bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
@endsection