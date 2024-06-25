<x-html>
    <div class="w-full bg-[#fbc92a] min-h-screen p-0 text-center">
        <nav class="bg-[#009142] w-full h-[50px] flex justify-between">
            <div class="flex items-center pl-[5px]">
                <h3 class="text-white font-medium text-[14px] sm:text-[16px]">UPTD PSDKP Wilayah Selatan</h3>
            </div>
            <div class="flex gap-2 items-center bg-[#80c8a2] pl-[10px]">
                <img src="./img/e-SLO.png" alt="" class="w-[30px] h-fit">
                <img src="./img/JDIH.png" alt="" class="w-[30px] h-fit">
                <img src="./img/Logo-OSS-RBA.svg" alt="" class="w-[60px] h-fit">
                <img src="./img/Smart-Jabar.png" alt="" class="w-[90px] h-fit">
            </div>
        </nav>
        <div class="w-[460px] bg-white text-center rounded-xl m-auto mt-[80px]">
            <div class="flex text-left gap-[10px] m-[10px]">
                <div class="w-[130px] flex justify-center items-center">
                    <img src="./img/logo.png" alt="">
                </div>
                <div class="flex flex-col gap-0">
                    <h1 class="text-[48.5px] font-bold p-0 m-0">SIPKAN</h1>
                    <h2 class="font-medium text-[12px]">Sistem Informasi Pengawas Kelautan dan Perikanan</br>
                        Pemerintah Daerah Provinsi Jawa Barat 
                    </h2>
                </div>
            </div>
            <div class="bg-white border-t-[1px] border-gray-300 rounded-b-2xl p-[15px]">
                <h3 class="text-[13px] font-bold text-gray-600">Silahkan masukkan nip & kata sandi untuk masuk ke Aplikasi</h3>
                <div class="p-[10px]">
                    <form action="" method="post">
                        @csrf
                        <div class=" relative mb-[10px]">
                            @if (session()->get("error"))
                                <p class="text-red-400">{{ session()->get("error") }}</p>
                            @endif
                            <input type="text" name="username" class="rounded-lg border-transparent flex-1  bg-gray-200 appearance-none border border-gray-500 w-[80%] py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-[#009142] focus:border-transparent" placeholder="Nomor Induk Pegawai"/>
                        </div>
                        <div class=" relative mb-[20px]">
                            <input type="password" name="password" class="bg-gray-200 rounded-lg border-transparent flex-1 appearance-none border border-gray-500 w-[80%] py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-[#009142] focus:border-transparent" placeholder="Kata Sandi"/>
                        </div>
                        <button type="submit" class="py-2 px-4  bg-[#09afed] hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-[80%] transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Masuk ke Aplikasi
                        </button>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</x-html>  