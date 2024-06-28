@extends("components.dashboard.dashboard-layout")
@section("content")
    <div class="w-full">
        <div class="w-full " x-data="activityDataHandler()">
            <div class="py-1 px-4 text-white bg-gray-600 w-fit rounded-r-full">
                <h2>Daftar Laporan Kegiatan</h2>
            </div>
            <div class="flex justify-between gap-4 mt-[20px] md:items-center pl-[10px]">
                <div class="flex gap-4 items-center md:flex-row flex-col">
                    <div class="flex justify-center">
                        <div class="relative group w-[160px] md:w-fit">
                          <button id="dropdown-button-activity" class="inline-flex justify-center w-full px-1 md:px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                            <span class="mr-2">Jenis Pengawasan</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                          </button>
                          <div x-init="fetchObservationData()" id="dropdown-menu-activity" class="hidden absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1 z-30">
                            <!-- Search input -->
                            <input id="search-input-activity" class="block w-full px-4 py-2 text-gray-800 border rounded-md  border-gray-300 focus:outline-none" type="text" placeholder="Search items" autocomplete="off">
                            <!-- Dropdown content goes here -->
                            <template x-for="item in observationData" :key="item.id">
                                <a href="" x-text="item.name" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md"></a>
                            </template>
                          </div>
                        </div>
                    </div>
    
                    <div class="flex justify-center ">
                        <div class="relative group">
                          <button id="dropdown-button-kabupaten" class="inline-flex justify-center w-[160px] px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                            <span class="mr-2">Kabupaten</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                          </button>
                          <div x-init="fetchDistrictData()" id="dropdown-menu-kabupaten" class="hidden absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1 max-h-[300px] overflow-y-scroll">
                            <!-- Search input -->
                            <input id="search-input-kabupaten" class="block w-full px-4 py-2 text-gray-800 border rounded-md  border-gray-300 focus:outline-none" type="text" placeholder="Search items" autocomplete="off">
                            <!-- Dropdown content goes here -->
                            <template x-for="item in districtData" :key="item.district_id.toString() + item.district_name">
                                <a href="" x-text="item.district_name" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md"></a>
                            </template>
                          </div>
                        </div>
                    </div>
                    <div x-data="yearDropdown()" class="flex w-[160px]">
                        
                        <select id="year" name="year" x-model="selectedYear" class=" block w-full pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Pilih Tahun</option>
                                <template x-for="year in years" :key="year" >
                                    <option :value="year" x-text="year"></option>
                                </template>
                        </select>
                    </div>
                </div>

                <div class="md:mt-0 mt-[100px]">
                    <a href="/dashboard/kegiatan/create" class="py-2 px-2  bg-primary-600 hover:bg-primary-700 focus:ring-primary-500 focus:ring-offset-primary-200 text-white w-fit transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 ">Tambah Laporan</a>
                </div>
                
            </div>
            <div class="overflow-x-scroll p-[5px] mt-[5px]" x-init="fetchActivityData()">
                <table class="table p-4 bg-gray-100 rounded-lg shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nomor (ID BAP)
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama Kegiatan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Jenis Pengawasan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama Pengawas
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Tanggal Pemeriksaan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama Pelaku Usaha / Perusahaan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Status Badan Usaha
                            </th>
                            <th colspan="5" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Lokasi Proyek
                            </th>
                            <th colspan="3" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama dan Kontak Penanggung Jawab
                            </th>
                            <th colspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nomor dan Tanggal NIB
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nomor Kode Proyek
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Sub Sektor
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                KBLI
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Skala Usaha
                            </th>
                            <th colspan="4" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Persyaratan Dasar Perizinan Berusaha
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Sertifikat Standar
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Status Penanaman Modal
                            </th>
                            <th colspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Titik Koordinat Lokasi Usaha
                            </th>
                            <th colspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kepatuhan Teknis
                            </th>
                            <th colspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kepatuhan Administratif
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Tingkat Kepatuhan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kategori Kepatuhan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Rekomendasi
                            </th>

                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Aksi
                            </th>
                        </tr>
                        {{-- table header lv 2 --}}
                        <tr>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Alamat
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Desa/Kel
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kecamatan
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kabupaten
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Provinsi
                            </th>

                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Jabatan
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kontak
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                NIB
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Tanggal Terbit/Perubahan
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Persetujuan Kesesuaian Ruang
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Persetujuan Lingkungan
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                PBG dan SLF
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Pernyataan Mandiri
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Latitude
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Longitude
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Pemenuhan perizinan berusaha atas kegiatan usaha
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Pemenuhan standar pelaksanaan kegiatan usaha
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Penilaian pelaksanaan kegiatan usaha 
                            </th>
                            <th class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Riwayat pengenaan sanksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <template x-for="item in activityData" :key="item.bap_number">
                            <tr class="text-gray-700">
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.bap_number">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.activity_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.observation_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.supervisor_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.inspection_date">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.company_name">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.business_entity_type">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.address">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.village_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.sub_district_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.district_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.province_idr">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.manager_name">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.manager_position">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.manager_phone">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.nib">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.effective_date">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.project_code">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.sub_sector">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.kbli_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.business_scale_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.persetujuan_kesesuaian_ruang">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.persetujuan_lingkungan">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.pbg_slf">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.pernyataan_mandiri">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.sertifikat_standar">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.investment_type_id">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.latitude">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.longitude">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.perizinan_berusaha_atas_kegiatan_usaha">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.standar_pelaksanaan_kegiatan_usaha">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.pelaksanaan_kegiatan_usaha">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.riwayat_pengenaan_sanksi">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="tingkat_kepatuhan_proyek">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="kategory_kepatuhan">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5" x-text="item.recommendation">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 flex gap-2">
                                    <button type="button" class="px-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                        Ubah
                                    </button>
                                    <button @click="isDelete = !isDelete" type="button" class=" px-2 bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </template>      
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection