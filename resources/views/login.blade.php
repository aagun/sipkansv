<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <title>Login | SIPKAN</title>
</head>
<body class="bg-gray-50">
<header x-data="loginHandler()">
    <nav
        class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <img alt="logo_sipkan" src="./img/logo.png" class="h-fit w-[50px] mr-3"/>
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SIPKAN</span>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <div
                    class="flex flex-col items-center font-medium mt-4 rounded-lg bg-gray-50 md:space-x-4 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                    <img alt="logo_e_slo" src="./img/eslo.png" class="h-fit w-[30px]"/>
                    <img alt="logo_oss_rba" src="./img/oss-rba.svg" class="h-fit w-[80px]"/>
                    <img alt="logo_jdhi" src="./img/jdhi.png" class="h-fit w-[30px]"/>
                    <img alt="logo_smart_jabar" src="./img/smart-jabar.png" class="h-fit w-[150px] pl-0"/>
                </div>
            </div>
        </div>
    </nav>


    <main class="flex items-center justify-center h-dvh">
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" @submit.prevent="login" novalidate>
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Portal SIPKAN Jabar</h5>
                <div>
                    <label for="username"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Induk Pegawai</label>
                    <input type="text" name="username" x-model="username" id="username"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           required/>
                           <span x-show="errors.username" x-text="errors.username" class="text-red-500"></span>
                </div>
                <div>
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                    <input type="password" name="password" x-model="password" id="password"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           required/>
                           <span x-show="errors.password" x-text="errors.password" class="text-red-500"></span>
                </div>
                <button type="submit"
                        class="w-full text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Masuk ke Aplikasi
                </button>
            </form>
        </div>
    </main>
    <script>
        function loginHandler () {
            return {
                data: {admin: "admin", password: "123456"},
                username: "",
                password: "",
                errors: {},
                validateForm () {
                    this.errors = {};
                    if (this.data.admin != this.username) {
                        this.errors.username = "NIP yang anda masukkan salah!";
                    } else {
                        this.errors.username = "";
                    }
                    if (this.data.password != this.password && this.password != null && this.data.admin == this.username) {
                        this.errors.password = "Kata sandi yang anda masukkan salah!";
                    } else {
                        this.errors.password = "";
                    }
                    return Object.keys(this.errors).length === 0;
                },
                login () {
                    // if (!this.validateForm()) {
                    //     return;
                    // }
                    console.log("tes");
                    return window.location.href = "http://127.0.0.1:8000/dashboard";
                }
            }
        }
    </script>

</header>
</body>
</html>
