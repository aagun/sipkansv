<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{asset("assets/img/favicon.ico")}}">
    <title>Login | SIPKAN</title>
</head>
<body class="bg-gray-50">
<header>
    <nav
        class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img alt="logo_sipkan" src="{{asset("assets/img/logo.png")}}" class="h-fit w-[50px] mr-3"/>
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SIPKAN</span>
            </a>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <div
                    class="flex flex-col items-center font-medium mt-4 rounded-lg bg-gray-50 md:space-x-4 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                    @php
                        $kkpCompany = [
                            'name' => 'Kementrian Kelautan Perikanan',
                            'sector' => 'Kementrian Pemerintah Indonesia',
                            'description' => 'Kementerian Kelautan dan Perikanan (disingkat KKP atau Kemenlutkan) adalah kementerian dalam Pemerintah Indonesia yang membidangi urusan kelautan dan perikanan. Kementerian Kelautan dan Perikanan dipimpin oleh seorang Menteri Kelautan dan Perikanan (MKP).',
                            'website' => 'https://kkp.go.id',
                            'logo' => 'assets/img/eslo.png',
                            'target' => 'popover-kkp'
                        ];

                        $ossRbaCompany = [
                            'name' => 'Online Single Submission (OSS)',
                            'sector' => 'Pemerintah Indonesia',
                            'description' => 'OSS adalah layanan online yang memudahkan pengusaha untuk mendapatkan izin usaha secara cepat dan mudah. Dengan OSS, Anda dapat mengurus perizinan usaha Anda tanpa harus datang ke kantor pelayanan',
                            'website' => 'https://oss.go.id/',
                            'logo' => 'assets/img/oss-rba.svg',
                            'target' => 'popover-oss-rba'
                        ];

                        $jdihCompany = [
                            'name' => 'Jenis Dokumen Informasi dan Hukum (JDIH)',
                            'sector' => 'Pemerintah Indonesia',
                            'description' => 'Berisi Berbagai Jenis Dokumen Hukum Seperti Peraturan Perundang-Undangan, Monografi Hukum, Artikel Hukum, Putusan Pengadilan dan dokumen hukum lainnya',
                            'website' => 'https://jdihn.go.id/',
                            'logo' => 'assets/img/jdih.png',
                            'target' => 'popover-jdih'
                        ];

                        $smartJabarCompany = [
                            'name' => 'Smart Jabar',
                            'sector' => 'Pemerintah Indonesia',
                            'description' => 'SMART JABAR merupakan portal Administrasi Pemerintahan dengan teknologi Single Sign On sebagai gerbang yang memberikan kemudahan bagi aparatur Pemprov Jabar untuk melaksanakan pekerjaan dengan lebih cepat, tepat, dan efisien.',
                            'website' => 'https://smartjabar.jabarprov.go.id',
                            'logo' => 'assets/img/smart-jabar.png',
                            'target' => 'popover-smart-jabar'
                        ];
                    @endphp

                    <x-popover-company data="{{json_encode($kkpCompany)}}">
                        <img
                            data-popover-target="{{$kkpCompany['target']}}"
                            alt="logo_e_slo"
                            src="{{asset("assets/img/eslo.png")}}"
                            class="h-fit w-[30px]"/>
                    </x-popover-company>

                    <x-popover-company data="{{json_encode($ossRbaCompany)}}">
                        <img
                            data-popover-target="{{$ossRbaCompany['target']}}"
                            alt="logo_oss_rba"
                            src="{{asset($ossRbaCompany['logo'])}}"
                            class="h-fit w-[80px]"/>
                    </x-popover-company>

                    <x-popover-company data="{{json_encode($jdihCompany)}}">
                        <img
                            data-popover-target="{{$jdihCompany['target']}}"
                            alt="logo_jdih"
                            src="{{asset($jdihCompany['logo'])}}"
                            class="h-fit w-[30px]"/>
                    </x-popover-company>

                    <x-popover-company data="{{json_encode($smartJabarCompany)}}">
                        <img
                            data-popover-target="{{$smartJabarCompany['target']}}"
                            alt="logo_smart_jabar"
                            src="{{asset($smartJabarCompany['logo'])}}"
                            class="h-fit w-[150px] pl-0"/>
                    </x-popover-company>
                </div>
            </div>
        </div>
    </nav>


    <main class="flex items-center justify-center h-dvh">
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="#">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Portal SIPKAN Jabar</h5>
                <div>
                    <label for="email"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" name="username" id="username"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           required/>
                </div>
                <div>
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           required/>
                </div>
                <button type="submit"
                        class="w-full text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Login
                </button>
            </form>
        </div>
    </main>

    <x-footer class="justify-center items-center"/>
</header>
</body>
</html>
