@extends("components.dashboard.dashboard-layout")
@section("content")
<div class="bg-white mx-auto max-w-[700px] rounded-lg p-[10px]">
    <h1 class="text-center text-[25px] font-medium mb-[20px]">Form Pengguna</h1>
    {{-- <form action="" method="post">
        @csrf
        <div class="space-y-6 bg-white border-[2px] border-gray-300 rounded-lg">
            <div class="items-center w-full px-4 pt-5 text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Nama
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <input type="text" name="name"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Nama"/>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4  text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Jabatan
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <select type="text" name="position"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent">
                            <option value=""><span >Pilih jabatan....</span></option>
                            <option value="">option 1</option>
                            <option value="">Option 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4 text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    NIP/NIK
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <input type="text" name="nip"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="NIP/NIK"/>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4  text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Pangkat
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <select type="text" name="ranks"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent">
                            <option value=""><span >Pilih pangkat....</span></option>
                            <option value="">option 1</option>
                            <option value="">Option 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4  text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Golongan Ruang
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <select type="text" name="commities"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent">
                            <option value=""><span >Pilih golongan ruang....</span></option>
                            <option value="">option 1</option>
                            <option value="">Option 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4  text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Pendidikan
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <select type="text" name="education"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent">
                            <option value=""><span >Pilih pendidikan....</span></option>
                            <option value="">option 1</option>
                            <option value="">Option 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4  text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Unit Kerja
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <select type="text" name="departments"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent">
                            <option value=""><span >Pilih unit kerja....</span></option>
                            <option value="">option 1</option>
                            <option value="">Option 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4  text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Instansi
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <select type="text" name="institutions"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent">
                            <option value=""><span >Pilih instansi....</span></option>
                            <option value="">option 1</option>
                            <option value="">Option 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4 text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Kontak
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <input type="text" name="contact"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Kontak"/>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4 text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Email
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <input type="text" name="email"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Email"/>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4 text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Username
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <input type="text" name="username"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Username"/>
                    </div>
                </div>
            </div>
            <hr>

            <div class="items-center w-full px-4 text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Password
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative ">
                        <input type="password" name="password"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Password"/>
                    </div>
                </div>
            </div>
            <hr>
            
            <div class="items-center w-full px-4 text-gray-800 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/3 ">
                    Konfirmasi Password
                </h2>
                <div class="max-w-sm mx-auto md:w-2/3">
                    <div class=" relative box-border">
                        @if (session()->get("error"))
                            <p class="text-red-400">{{ session()->get("error") }}</p>
                        @endif
                        <input type="password" name="confirm-password"  class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-400 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent" placeholder="Konfirmasi Password"/>
                    </div>
                </div>
            </div>

            <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0 border-t-[1px] border-gray-300">
                <div class="w-1/2 px-4 pb-4 ml-auto text-gray-500 sm:w-1/4">
                    <button type="submit" class="py-2 px-4  bg-[#80c8a2] hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        Simpan
                    </button>
                </div>
            </div>    
        </div>
    </form> --}}
    <form class="max-w-xl mx-auto">
        @csrf
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="name" id="create_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required />
            <label for="create_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="nip" id="create_nip" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required />
            <label for="create_nip" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NIP/NIK</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="username" id="create_username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required />
            <label for="create_username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password" id="create_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required />
            <label for="create_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kata sandi</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="repeat_password" id="create_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required />
            <label for="create_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Konfirmasi kata sandi</label>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
          <div class="relative z-0 w-full mb-5 group">
              <input type="text"  name="phone" id="create_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required />
              <label for="create_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kontak</label>
          </div>
          <div class="relative z-0 w-full mb-5 group">
              <input type="text" name="create_email" id="create_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required />
              <label for="create_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
          </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <select name="position_id" id="create_position" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required>
                    <option value="" >Pilih jabatan...</option>
                    <option value="" >option 1</option>
                    <option value="" >option 2</option>
                </select>
                <label for="create_position" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jabatan</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <select name="rank_id" id="create_rank" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required>
                    <option value="" >Pilih pangkat...</option>
                    <option value="" >option 1</option>
                    <option value="" >option 2</option>
                </select>
                <label for="create_rank" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Pangkat</label>
            </div>
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <select name="comity_id" id="create_comity" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required>
                    <option value="" >Pilih golongan ruang...</option>
                    <option value="" >option 1</option>
                    <option value="" >option 2</option>
                </select>
                <label for="create_comity" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Golongan ruang</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <select name="education_id" id="create_education" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required>
                    <option value="" >Pilih pendidikan...</option>
                    <option value="" >option 1</option>
                    <option value="" >option 2</option>
                </select>
                <label for="create_education" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-500 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Pendidikan</label>
            </div>
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <select name="department_id" id="create_department" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-500 peer" placeholder=" " required>
                    <option value="" >Pilih unit kerja...</option>
                    <option value="" >option 1</option>
                    <option value="" >option 2</option>
                </select>
                <label for="create_department" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#80c8a2] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Unit kerja</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <select name="institution_id" id="create_institution" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#80c8a2] peer" placeholder=" " required>
                    <option value="" >Pilih instansi...</option>
                    <option value="" >option 1</option>
                    <option value="" >option 2</option>
                </select>
                <label for="create_institution" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#80c8a2] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Instansi</label>
            </div>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-[#80c8a2] dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
</div>
@endsection