@extends("components.dashboard.dashboard-layout")
@section("content")
<div class="bg-white mx-auto max-w-[800px] rounded-lg p-[10px]" x-data="formActivityDataHandler()">
    <h1 class="text-center text-[25px] font-medium mb-[20px]">Formulir Laporan Pengawasan</h1>
    <form class="max-w-lg mx-auto">
        <div class="mb-5 flex items-center">
          <label for="bap_number" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor (ID BAP)</label>
          <input type="number" id="bap_number" name="bap_number" x-model="bap_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nomor (ID BAP)" required />
        </div>
        <div class="mb-5 flex items-center" x-init="fetchDropdownData('http://127.0.0.1:8000/activities/search', 'dataDropdownKegiatan')">
            <label for="activity_id" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
            <select id="activity_id" x-model="activity_id" name="activity_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Kegiatan</option>
                <template x-for="item in dataDropdownKegiatan" :key="item.name">
                    <option :value="item.id" x-text="item.name"></option>
                </template>
              </select>
        </div>
        <div class="mb-5 flex items-center" x-init="fetchDropdownData('http://127.0.0.1:8000/observations/search', 'dataDropdownPengawasan')">
            <label for="observation_id" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Pengawasan</label>
            <select id="observation_id" x-model="observation_id" name="observation_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Jenis Pengawasan</option>
                <template x-for="item in dataDropdownPengawasan" :key="">
                    <option :value="item.id" x-text="item.name"></option>
                </template>
            </select>
        </div>
        <div class="mb-5 flex items-center" x-init="fetchDropdownData('http://127.0.0.1:8000/users/search', 'dataDropdownNamaPengawas')">
            <label for="supervisor_id" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengawas</label>
            <select id="supervisor_id" type="text" x-model="supervisor_id" name="supervisor_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Nama Pengawas</option>
                <template x-for="item in dataDropdownNamaPengawas" :key="item.nip">
                    <option :value="item.nip" x-text="item.full_name"></option>
                </template>
            </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="inspection_date" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pemeriksaan</label>

            <div class="relative inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="absolute ml-[10px] w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                   <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                 </svg>
             </div>
             <input datepicker datepicker-format="yyyy/mm/dd" id="inspection_date" x-model="inspection_date" name="inspection_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal">
        </div>
        <div class="mb-5 flex items-center">
            <label for="company_name" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pelaku Usaha/Perusahaan</label>
            <input type="text" id="company_name" x-model="company_name" name="company_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nama Pelaku Usaha/Perusahaan" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="business_entity_type_id" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Badan Usaha</label>
            <select id="business_entity_type_id" x-model="business_entity_type_id" name="business_entity_type_id" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Kabupaten</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>
        
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Lokasi Proyek :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="address" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <textarea type="text" id="address" name="address" x-model="address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Alamat" required> </textarea>
        </div>
        <div class="mb-5 flex items-center">
            <label for="province_id" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
            <select id="province_id" x-model="province_id" x-model="province_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Provinsi</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="district_id" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
            <select id="district_id" x-model="district_id" name="district_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Kabupaten</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="sub_district_id" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
            <select id="sub_district_id" x-model="sub_district_id" name="sub_district_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Kecamatan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="village_id" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa/Kelurahan</label>
            <select id="village_id" x-model="village_id" name="village_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>

        <div class="mb-5 flex items-center">
            <label class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Penanggung Jawab Proyek :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="manager_id" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <select id="manager_id" x-model="manager_id" name="manager_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="jabatan" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
            <input type="text" id="jabatan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Jabatan" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="kontak" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Kontak</label>
            <input type="text" id="kontak" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:
            focus:border-blue-500 dark:shadow-sm-light" placeholder="Kontak" required /> 
        </div>

        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Data Proyek :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="nib" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">NIB</label>
            <input type="text" id="nib" x-model="nib" name="nib" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="NIB" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="effective_date" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Terbit/Perubahan</label>
            <div class="relative inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="absolute ml-[10px] w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                   <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                 </svg>
             </div>
             <input datepicker datepicker-format="yyyy/mm/dd" id="effective_date" x-model="effective_date" name="effective_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal"> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="project_code" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Kode Proyek</label>
            <input type="text" id="project_code" x-model="project_code" name="project_code" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nomor Kode Proyek" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="sub_sector_id" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Sektor</label>
            <select id="sub_sector_id" x-model="sub_sector_id" name="sub_sector_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
            </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="kbli_id" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">KBLI</label>
            <select id="kbli_id" x-model="kbli_id" name="kbli_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
            </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="business_scale_id" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Skala Usaha</label>
            <select id="business_scale_id" x-model="business_scale_id" name="business_scale_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
            </select>
        </div>

        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Persyaratan Dasar Perizinan Berusaha :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="persetujuan_kesesuaian_ruang" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Persetujuan Kesesuaian Ruang</label>
            <input type="persetujuan_kesesuaian_ruang" id="persetujuan_kesesuaian_ruang" x-model="persetujuan_kesesuaian_ruang" name="persetujuan_kesesuaian_ruang" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Persetujuan Kesesuaian Ruang" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="persetujuan_lingkungan" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Persetujuan Lingkungan</label>
            <input type="persetujuan_lingkungan" id="persetujuan_lingkungan" x-model="persetujuan_lingkungan" name="persetujuan_lingkungan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Persetujuan Lingkungan" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="pbg_slf" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">PBG dan SLF</label>
            <input type="pbg_slf" id="pbg_slf" x-model="pbg_slf" name="pbg_slf" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="PBG dan SLF" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="pernyataan_mandiri" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pernyataan Mandiri</label>
            <input type="pernyataan_mandiri" id="pernyataan_mandiri" x-model="pernyataan_mandiri" name="pernyataan_mandiri" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pernyataan Mandiri" required /> 
        </div>
        
        <div class="mb-5 flex items-center">
            <label for="sertifikat_standar" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Sertifikat Standar </label>
            <input type="text" id="sertifikat_standar" x-model="sertifikat_standar" name="sertifikat_standar" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Sertifikat Standar " required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="investment_type_id" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Penanaman Modal</label>
            <select id="investment_type_id" x-model="investment_type_id" name="investment_type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
            </select>
        </div>
        
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Koordinat Lokasi Proyek  :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="latitude" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Latitude</label>
            <input type="text" id="latitude" x-model="latitude" name="latitude" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Latitude" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="longitude" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitude</label>
            <input type="text" id="longitude" x-model="longitude" name="longitude" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Longitude" required /> 
        </div>

        <div class="mb-5 flex items-center">
            <label for="kepatuhan_teknis" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Penilaian Kepatuhan Teknis</label>
            <input type="number" id="kepatuhan_teknis" x-model="kepatuhan_teknis" name="kepatuhan_teknis" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Penilaian Kepatuhan Teknis" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="perizinan_berusaha_atas_kegiatan_usaha" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan perizinan berusaha atas kegiatan usaha</label>
            <input type="number" id="perizinan_berusaha_atas_kegiatan_usaha" x-model="perizinan_berusaha_atas_kegiatan_usaha" name="perizinan_berusaha_atas_kegiatan_usaha" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan perizinan berusaha atas kegiatan usaha" required />
        </div>

        <div class="mb-5 flex items-center">
            <label for="" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Pemenuhan standar pelaksanaan kegiatan usaha :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="persyaratan_umum_usaha" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan persyaratan umum usaha</label>
            <input type="number" id="persyaratan_umum_usaha" x-model="persyaratan_umum_usaha" name="persyaratan_umum_usaha" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan persyaratan umum usaha" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="persyaratan_khusus_usaha" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan persyaratan khusus usaha</label>
            <input type="number" id="persyaratan_khusus_usaha" x-model="persyaratan_khusus_usaha" name="persyaratan_khusus_usaha" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan persyaratan khusus usaha" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="sarana" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan sarana</label>
            <input type="number" id="sarana" x-model="sarana" name="sarana" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan sarana" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="organisasi_dan_sdm" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white"> Kesesuaian struktur organisasi dan SDM</label>
            <input type="number" id="organisasi_dan_sdm" x-model="organisasi_dan_sdm" name="organisasi_dan_sdm" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder=" Kesesuaian struktur organisasi dan SDM" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="pelayanan" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan pelayanan</label>
            <input type="number" id="pelayanan" x-model="pelayanan" name="pelayanan" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan pelayanan" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="persyaratan_produk" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan persyaratan Produk/Proses/Jasa</label>
            <input type="number" id="persyaratan_produk" x-model="persyaratan_produk" name="persyaratan_produk" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan persyaratan Produk/Proses/Jasa" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="sistem_manajemen_usaha" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan sistem manajemen usaha</label>
            <input type="number" id="sistem_manajemen_usaha" x-model="sistem_manajemen_usaha" name="sistem_manajemen_usaha" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan sistem manajemen usaha" required /> 
        </div>

        <div class="mb-5 flex items-center">
            <label for="kepatuhan_administratif" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Penilaian Kepatuhan Administratif</label>
            <input type="number" id="kepatuhan_administratif" x-model="kepatuhan_administratif" name="kepatuhan_administratif" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Penilaian Kepatuhan Administratif" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="pelaksanaan_kegiatan_usaha" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Penilaian pelaksanaan kegiatan usaha</label>
            <input type="number" id="pelaksanaan_kegiatan_usaha" x-model="pelaksanaan_kegiatan_usaha" name="pelaksanaan_kegiatan_usaha" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Penilaian pelaksanaan kegiatan usaha" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="riwayat_pengenaan_sanksi" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Riwayat pengenaan sanksi</label>
            <input type="number" id="riwayat_pengenaan_sanksi" x-model="riwayat_pengenaan_sanksi" name="riwayat_pengenaan_sanksi" min="0" max="100" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Riwayat pengenaan sanksi" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="tingkat_kepatuhan_proyek" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Tingkat Kepatuhan Proyek</label>
            <select id="tingkat_kepatuhan_proyek" x-model="tingkat_kepatuhan_proyek" name="tingkat_kepatuhan_proyek" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
            </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="kategory_kepatuhan" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Katagori Kepatuhan</label>
            <select id="kategory_kepatuhan" x-model="kategory_kepatuhan" name="kategory_kepatuhan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
            </select>
        </div>

        <div class="mb-5 flex items-center">
            <label for="permasalahan_perusahaan" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Permasalahan yang Dihadapi Perusahaan</label>
            <input type="text" id="permasalahan_perusahaan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Permasalahan yang Dihadapi Perusahaan" required />
        </div>

        <div class="mb-5 flex items-center">
            <label for="hasil_pengawasan" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Hasil Pengawasan</label>
            <input type="text" id="hasil_pengawasan" x-model="hasil_pengawasan" name="hasil_pengawasan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Hasil Pengawasan" required />
        </div>

        <div class="max-w-lg mx-auto">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="dokumen_pendukung">Upload Dokumen Pendukung</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="dokumen_pendukung" x-model="dokumen_pendukung" name="dokumen_pendukung" type="file">
        </div>
        <div class="mb-5 flex items-center">
            <label for="recommendation_id" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Rekomendasi</label>
            <select id="recommendation_id" x-model="recommendation_id" name="recommendation_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>United States</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
            </select>
        </div>
        
        
        
        <button type="submit" class="my-[20px] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Laporan</button>

    </form>
    
</div>
@endsection