<x-html>
    <div class="w-full bg-[#fbc92a] min-h-screen flex flex-col justify-center items-center p-[10px] text-center">
        <div class="w-[460px] bg-white text-center rounded-2xl">
            <div class="flex text-left gap-[10px] m-[10px]">
                <div class="w-[130px] flex justify-center items-center">
                    <img src="./img/logo.jpg" alt="">
                </div>
                <div class="flex flex-col gap-0">
                    <h1 class="text-[48.5px] font-bold p-0 m-0">SIPKAN</h1>
                    <h2 class="font-medium text-[12px]">Sistem Informasi Pengawas Kelautan dan Perikanan</br>
                        Pemerintah Daerah Provinsi Jawa Barat 
                    </h2>
                </div>
            </div>
            <div class="bg-gray-50 border-t-[1px] border-gray-300 rounded-b-2xl">
                <h1 class="text-[30px] font-bold text-[#009142] mt-[20px]">Login</h1>
                <div class="p-[30px]">
                    <form action="" method="post">
                        @csrf
                        <div class=" relative mb-[10px]">
                            @if (session()->get("error"))
                                <p class="text-red-400">{{ session()->get("error") }}</p>
                            @endif
                            <input type="text" name="username" class="rounded-lg border-transparent flex-1 appearance-none border border-gray-500 w-[80%] py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-[#009142] focus:border-transparent" placeholder="Username"/>
                        </div>
                        <div class=" relative mb-[20px]">
                            <input type="password" name="password" class="rounded-lg border-transparent flex-1 appearance-none border border-gray-500 w-[80%] py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-[#009142] focus:border-transparent" placeholder="Password"/>
                        </div>
                        <button type="submit" class="py-2 px-4  bg-[#09afed] hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-[80%] transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Login
                        </button>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</x-html>  