@extends("components.dashboard.dashboard-layout")
@section("content")
<div class="bg-white mx-auto max-w-[800px] rounded-lg p-[10px]">
    <h1 class="text-center text-[25px] font-medium mb-[20px]">Formulir Laporan Pengawasan</h1>
    <form class="max-w-lg mx-auto">
        <div class="mb-5 flex items-center">
          <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor (ID BAP)</label>
          <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nomor (ID BAP)" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nama Kegiatan" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kegiatan</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Jenis Kegiatan" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengawas</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nama Pengawas" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pemeriksaan</label>

            <div class="relative inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="absolute ml-[10px] w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                   <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                 </svg>
             </div>
             <input datepicker datepicker-format="dd/mm/yyyy" id="datepickerId" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal">
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pelaku Usaha/Perusahaan</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nama Pelaku Usaha/Perusahaan" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Badan Usaha</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Status Badan Usaha" required />
        </div>
        
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Lokasi Proyek :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <textarea type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Alamat" required> </textarea>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Provinsi</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Kabupaten</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Kecamatan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa/Kelurahan</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Desa/Kelurahan</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select>
        </div>

        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Penanggung Jawab Proyek :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nama" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Jabatan" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Kontak</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:
            focus:border-blue-500 dark:shadow-sm-light" placeholder="Kontak" required /> 
        </div>

        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Data Proyek :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">NIB</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="NIB" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Terbit/Perubahan</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Tanggal Terbit/Perubahan" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Kode Proyek</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nomor Kode Proyek" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Sektor</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Sub Sektor" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">KBLI</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="KBLI" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Skala Usaha</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Skala Usaha" required /> 
        </div>

        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Persyaratan Dasar Perizinan Berusaha :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Persetujuan Kesesuaian Ruang</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Persetujuan Kesesuaian Ruang" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Persetujuan Lingkungan</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Persetujuan Lingkungan" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">PBG dan SLF</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="PBG dan SLF" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pernyataan Mandiri</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pernyataan Mandiri" required /> 
        </div>
        
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Sertifikat Standar </label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Sertifikat Standar " required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Penanaman Modal</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Status Penanaman Modal" required />
        </div>
        
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Koordinat Lokasi Proyek  :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Latitude</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Latitude" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitude</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Longitude" required /> 
        </div>

        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Penilaian Kepatuhan Teknis</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Penilaian Kepatuhan Teknis" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan perizinan berusaha atas kegiatan usaha</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan perizinan berusaha atas kegiatan usaha" required />
        </div>

        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-bold text-gray-900 dark:text-white">Pemenuhan standar pelaksanaan kegiatan usaha :</label>
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan persyaratan umum usaha</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan persyaratan umum usaha" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan persyaratan khusus usaha</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan persyaratan khusus usaha" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan sarana</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan sarana" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white"> Kesesuaian struktur organisasi dan SDM</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder=" Kesesuaian struktur organisasi dan SDM" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan pelayanan</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan pelayanan" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan persyaratan Produk/Proses/Jasa</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan persyaratan Produk/Proses/Jasa" required /> 
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="ml-[10px] block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemenuhan sistem manajemen usaha</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Pemenuhan sistem manajemen usaha" required /> 
        </div>

        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Penilaian Kepatuhan Administratif</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Penilaian Kepatuhan Administratif" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Penilaian pelaksanaan kegiatan usaha</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Penilaian pelaksanaan kegiatan usaha" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Riwayat pengenaan sanksi</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Riwayat pengenaan sanksi" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Tingkat Kepatuhan Proyek</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Tingkat Kepatuhan Proyek" required />
        </div>
        <div class="mb-5 flex items-center">
            <label for="email" class="block w-[200px] mb-2 text-sm font-medium text-gray-900 dark:text-white">Katagori Kepatuhan</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Katagori Kepatuhan" required />
        </div>

        <div class="max-w-lg mx-auto">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload Dokumen Pendukung</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
          </div>

         {{-- <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>United States</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
              </select> --}}
        
        
        <button type="submit" class="my-[20px] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Laporan</button>

    </form>
    
</div>
@endsection