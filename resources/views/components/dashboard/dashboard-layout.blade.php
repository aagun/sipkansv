<x-html>
    <div class="min-h-screen" x-data="{isOpen: true, isOpenMasterData: false, isOpenKegiatan: false}">
        <div class="w-full h-[50px]">
            <nav class="bg-white w-full h-[50px] flex justify-between fixed z-[100] border-b-[1px] border-gray-600">
                <div class="flex items-center h-full">
                    <div class="bg-green-900 h-full flex items-center px-[10px]">
                        <img src="{{ asset('img/logo.png') }}" class="w-[50px]" alt="">
                        <h2 class="text-white font-bold text-[18px] ml-[10px] mr-[20px]">SIPKAN</h2>
                    </div>
                    <button @click="isOpen = !isOpen" class="text-gray-800 hover:text-gray-600 inline-flex items-center justify-center p-2 rounded-md focus:outline-none">
                        <svg width="15" height="15" fill="currentColor" class="w-6 h-6" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1664 1344v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45z">
                            </path>
                        </svg>
                    </button>
                    <h2 class="text-gray-800 font-medium text-[15px] ml-[10px] hidden sm:block">Pemerintah Daerah Provinsi Jawa Barat </h2>
                </div>
                <div class="text-[20px] text-gray-800 flex items-center gap-5 px-[10px]">
                    <button class="fas fa-user"></button>
                    <button class="fas fa-power-off"></button>
                </div>
            </nav>
        </div>
        
        <div class="flex w-full relative">
            <div class="bg-white min-w-[350px] h-full lg:relative absolute"
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" >
                <div class="bg-white min-w-[350px] h-full fixed shadow-md z-30 ">
                    <div class="p-[15px] flex justify-between border-b-[1px] border-gray-300">
                        <h1 class="text-[#009142] font-medium text-[20px]">Dashboard</h1>
                    </div>
                    <div class="p-[15px]" 
                        @if (request()->is("dashboard/data*"))
                            x-data="{isOpenMasterData: true}";
                        @endif
                        @if (request()->is("dashboard/kegiatan*"))
                        x-data="{isOpenKegiatan: true}";
                    @endif
                    >
                        <ul class="text-[18px] text-gray-500">
                            <a href="/dashboard" class="flex items-center hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">
                                <i class="fas fa-chart-line mr-[10px] w-[25px]"></i>Beranda
                                {{-- <p class="hidden group-hover:block {{ (request()->is('dashboard')) ? 'block' : ' ' }}">></p> --}}
                            </a>
                            <a href="/dashboard/users" class="flex items-center hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/users*')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">
                                <i class="fas fa-users mr-[10px] w-[25px]"></i>Data Pengguna
                            </a>
                            <buton @click="isOpenKegiatan = !isOpenKegiatan" class="flex hover:text-gray-700 hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 cursor-pointer border-b-[2px] border-bg-700">
                                <div class="flex items-center justify-between w-full">
                                    <span><i class="fas fa-file-signature mr-[10px] w-[25px]"></i>Kegiatan</span><span>></span>
                                </div>
                            </buton>

                            <div
                            x-show="isOpenKegiatan"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95" >
                                <ul>
                                    <a href="/dashboard/data/pangkat" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/pangkat')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Pangkat</a>
                                    <a href="/dashboard/data/jabatan" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/jabatan')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Jabatan</a>
                                    <a href="/dashboard/data/golongan-ruang" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/golongan-ruang')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Golongan Ruang</a>
                                   
                                </ul>
                            </div>
                            
                            <buton @click="isOpenMasterData = !isOpenMasterData" class="flex hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 cursor-pointer border-b-[2px] border-bg-700">
                                <div class="flex items-center justify-between w-full">
                                    <span><i class="fas fa-database mr-[10px] w-[25px]"></i>Master Data </span><span>></span>
                                </div>
                            </buton>
                            <div
                            x-show="isOpenMasterData"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95" >
                                <ul>
                                    <a href="/dashboard/data/pangkat" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/pangkat')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Pangkat</a>
                                    <a href="/dashboard/data/jabatan" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/jabatan')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Jabatan</a>
                                    <a href="/dashboard/data/golongan-ruang" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/golongan-ruang')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Golongan Ruang</a>
                                    <a href="/dashboard/data/pendidikan" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/pendidikan')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Pendidikan</a>
                                    <a href="/dashboard/data/unit-kerja" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/unit-kerja')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Unit Kerja</a>
                                    <a href="/dashboard/data/instansi" class="flex items-center ml-[25px] hover:text-gray-700 hover hover:bg-gray-100 p-[5px] rounded-sm active:bg-gray-200 {{ (request()->is('dashboard/data/instansi')) ? 'border-r-[4px] border-r-[#009142]' : 'bg-white' }}">Instansi</a>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-100 w-full overflow-auto">
                <div class="bg-white w-[95%] m-auto mt-[10px] min-h-screen rounded-t-xl p-[10px]">
                  @yield("content")
                </div>
            </div>
        </div>
    </div>
</x-html>