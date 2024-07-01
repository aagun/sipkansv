@extends('layout');

@section('title', 'Laporan Kegiatan');

@push('styles')
@endpush

@section('content')
    <div class="w-full  rounded-lg p-[15px] bg-white">
        <div class="w-full " x-data="activityDataHandler()">
            <div class="fixed w-full top-0 left-0 right-0 bottom-0 bg-[rgba(243,244,246,0.7)] z-[100] pt-[200px]"
             x-show="isDelete"
             x-transition:enter="transition ease-out duration-100 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75 transform"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
                <div class="w-[450px] m-auto mt-[300px] bg-white rounded-lg text-center p-[30px] shadow-2xl">
                    <h2 class="font-bold text-[20px]">Konfirmasi Penghapusan</h2>
                    <p class="text-[15px] my-[30px]">Apakah Anda yakin ingin menghapus ini?</p>
                    <div class="w-[200px] flex justify-between m-auto mt-[30px]">
                        <button
                                class="py-1 px-2 bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Hapus
                        </button>
                        <button @click="isDelete = !isDelete"
                                class="py-1 px-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Batalkan
                        </button>
                    </div>
                </div>
            </div>
            <div class="py-1 px-4 text-white bg-gray-600 w-fit rounded-r-full">
                <h2>Daftar Laporan Kegiatan</h2>
            </div>
            <div class="flex justify-between gap-4 mt-[20px] md:items-center pl-[10px]">
                <div class="flex gap-4 items-center md:flex-row flex-col" >
                    <div class="flex justify-center"  x-init="fetchObservationData()">
                        <div class="relative group min-w-[160px] md:w-fit">
                            <select @change="filterActivity()" x-model="search.observation_id" name="search.observation_id" class="inline-flex justify-center w-full px-1 md:px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                <option class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Jenis Pengawasan</option>
                                <template x-for="item in observationData" :key="item.id">
                                    <option x-text="item.name" :value="item.id" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-center" x-init="fetchDistrictData()" >
                        <div class="relative group">
                            <input type="text" x-model="cariKabupaten" name="cariKabupaten" class=" block w-[160px] px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500 relative" placeholder="Cari Kabupaten" @input="filterKabupaten()" />
                            <select @change="filterActivity()" x-model="search.district_id" name="search.districh_id" class="inline-flex justify-center w-[160px] px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500 relative">
                                <option class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Kabupaten</option>
                                <template x-for="item in districtData" :key="item.district_id.toString() + item.district_name">
                                    <option x-text="item.district_name" :value="item.district_id" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div x-init="yearDropdown()" class="flex w-[160px]">
                        
                        <select @change="filterActivity()" name="search.year" x-model="search.year" class=" block w-full pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Pilih Tahun</option>
                                <template x-for="year in years" :key="year" >
                                    <option :value="year" x-text="year"></option>
                                </template>
                        </select>
                    </div>
                    <div>
                        <button @click="exportFile" class="inline-flex justify-center w-fit px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">Export File</button>
                    </div>
                </div>

                <div class="md:mt-0 mt-[100px]">
                    <a href="/dashboard/kegiatan/buat" class="py-2 px-2  bg-primary-600 hover:bg-primary-700 focus:ring-primary-500 focus:ring-offset-primary-200 text-white w-fit transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 ">Tambah Laporan</a>
                </div>
                
            </div>
            <div class=" p-[5px] mt-[5px] overflow-auto max-h-[450px]" x-init="fetchActivityData()">
                <table class="p-4 rounded-lg shadow text-center ">
                    <thead class="bg-gray-50">
                        <tr >
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nomor (ID BAP)
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama Kegiatan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Jenis Pengawasan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama Pengawas
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Tanggal Pemeriksaan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama Pelaku Usaha / Perusahaan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Status Badan Usaha
                            </th>
                            <th colspan="5" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Lokasi Proyek
                            </th>
                            <th colspan="3" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama dan Kontak Penanggung Jawab
                            </th>
                            <th colspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nomor dan Tanggal NIB
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nomor Kode Proyek
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Sub Sektor
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                KBLI
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Skala Usaha
                            </th>
                            <th colspan="4" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Persyaratan Dasar Perizinan Berusaha
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Sertifikat Standar
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Status Penanaman Modal
                            </th>
                            <th colspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Titik Koordinat Lokasi Usaha
                            </th>
                            <th colspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kepatuhan Teknis
                            </th>
                            <th colspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kepatuhan Administratif
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Tingkat Kepatuhan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kategori Kepatuhan
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Rekomendasi
                            </th>
                            <th rowspan="2" class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Dokumen Pendukung
                            </th>

                            <th rowspan="2" class="border py-2 px-4 dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Aksi
                            </th>
                        </tr>
                        {{-- table header lv 2 --}}
                        <tr>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Alamat
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Desa/Kel
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kecamatan
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kabupaten
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Provinsi
                            </th>

                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Nama
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Jabatan
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Kontak
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                NIB
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Tanggal Terbit/Perubahan
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Persetujuan Kesesuaian Ruang
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Persetujuan Lingkungan
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                PBG dan SLF
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Pernyataan Mandiri
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Latitude
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Longitude
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Pemenuhan perizinan berusaha atas kegiatan usaha
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Pemenuhan standar pelaksanaan kegiatan usaha
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Penilaian pelaksanaan kegiatan usaha 
                            </th>
                            <th class="border py-2 px-4 min-w-[250px] dark:border-dark-5 whitespace-nowrap font-medium text-gray-900">
                                Riwayat pengenaan sanksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <template x-for="(item, index) in activityData" :key="item.bap_number">
                            <tr class="text-gray-700">
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.bap_number">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.activity">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.observation">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.supervisor_name">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="formatDateRead(item.inspection_date)">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.company_name">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.business_entity_type">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.address">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.village">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.sub_district">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.district">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.province">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.manager_name">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.manager_position">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.manager_phone">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.nib">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="formatDateRead(item.effective_date)">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.project_code">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.sub_sector">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.kbli">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.business_scale">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.persetujuan_kesesuaian_ruang">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.persetujuan_lingkungan">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.pbg_slf">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.pernyataan_mandiri">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.sertifikat_standar">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.investment_type">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.latitude">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.longitude">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.perizinan_berusaha_atas_kegiatan_usaha">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.standar_pelaksanaan_kegiatan_usaha">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.pelaksanaan_kegiatan_usaha">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.riwayat_pengenaan_sanksi">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.tingkat_kepatuhan_proyek">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.kategory_kepatuhan">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-text="item.recommendation">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center" x-html="`<a href='${item.attachment_link}' target='_blank' class='text-blue-600 hover:text-indigo-800 active:text-indigo-500' >${item.attachment_name}</a>`">
                                </td>
                                <td class="border px-3 py-1 dark:border-dark-5 text-center">
                                    {{-- <div x-html="`<a href='/dashboard/kegiatan/ubah/${item.activity_report_id}' class='px-2 bg-indigo-600 hover:cursor-pointer hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg mb-[5px]'>Ubah</a>`"></div> --}}
                                    <button @click="editButtonHandler(index)" class="px-2 bg-indigo-600 hover:cursor-pointer hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg mb-[5px]">
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

@push('scripts')
    <script src="{{asset('assets/js/pages/activity.js')}}"></script>
@endpush
