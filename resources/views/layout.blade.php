<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href={{asset("/assets/img/favicon.ico")}}>
    <title>@yield('title') | SIPKAN</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body>
    @php
        $fullName = 'Fulan bin Fulan';
        $photo = 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png';
        $position = 'Administrator'
    @endphp

    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar :$fullName :$photo :$position/>
        <x-sidebar/>
        <main class="p-4 lg:ml-64 h-auto pt-40 mt-8">
            @yield('content')
        </main>
        <x-footer/>
    </div>
</body>

@vite(['resources/js/app.js', 'resources/js/common.js'])
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@stack("scripts")
</html>


{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    @vite(['resources/js/app.js', 'resources/css/app.css'])--}}
{{--    <link--}}
{{--        rel="stylesheet"--}}
{{--        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"--}}
{{--        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="--}}
{{--        crossorigin="anonymous"--}}
{{--        referrerpolicy="no-referrer"--}}
{{--    />--}}
{{--    <title>SIPKAN</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--    {{ $slot }}--}}
{{--    <script>--}}
{{--        function masterDataHandler(urlCreate, urlRead, urlDelete, urlEdit) {--}}
{{--             return {--}}
{{--                name: "",--}}
{{--                description: "",--}}
{{--                successMessage: "",--}}
{{--                deleteMessage: "",--}}
{{--                editMessage:"",--}}
{{--                items: [],--}}
{{--                errors: {},--}}
{{--                error: "",--}}
{{--                isDelete: false,--}}
{{--                itemToDelete: null,--}}
{{--                itemToEdit: null, --}}
{{--                isShowForm: false, --}}
{{--                isShowFormEdit: false, --}}
{{--                validateForm() {--}}
{{--                    this.errors = {};--}}
{{--                    if (!this.name) {--}}
{{--                        this.errors.name = 'Nama harus diisi.';--}}
{{--                    } --}}
{{--                    if (!this.description) {--}}
{{--                        this.errors.description = 'Deskripsi harus diisi.';--}}
{{--                    }--}}
{{--                    return Object.keys(this.errors).length === 0;--}}
{{--                },--}}
{{--                //untuk membuat data--}}
{{--                createSubmit () {--}}
{{--                    if (!this.validateForm()) {--}}
{{--                        return;--}}
{{--                    }--}}
{{--                     axios.post(urlCreate, {--}}
{{--                         name: this.name,--}}
{{--                         description: this.description,--}}
{{--                     })--}}
{{--                     .then(response => {--}}
{{--                        this.successMessage = "Data berhasil ditambah!";--}}
{{--                        this.name = '';--}}
{{--                        this.description = '';--}}
{{--                        this.fetchData();--}}
{{--                        setTimeout(()=> {--}}
{{--                            this.successMessage = "";--}}
{{--                        },4000)--}}
{{--                     })--}}
{{--                     .catch(error => {--}}
{{--                        this.errors = {};--}}
{{--                        if (error.response.request.status == 400) {--}}
{{--                            this.errors.name = 'Nama sudah terdaftar.';--}}
{{--                        }--}}
{{--                        console.log(error);--}}
{{--                     })--}}
{{--                },--}}
{{--                //untuk ambil data dari database --}}
{{--                fetchData() {--}}
{{--                    this.error = "",--}}
{{--                    axios.post(urlRead)--}}
{{--                    .then(response => {--}}
{{--                        this.items = response.data.data;--}}
{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        this.error = 'Terjadi kesalahan saat mengambil data.';--}}
{{--                        console.error(error);--}}
{{--                    })--}}
{{--                },--}}
{{--                //fungsi untuk delete--}}
{{--                confirmDelete(id) {--}}
{{--                    this.itemToDelete = id;--}}
{{--                    this.isDelete = true;--}}
{{--                },--}}
{{--                 deleteItem() {--}}
{{--                    if (this.itemToDelete !== null) {--}}
{{--                        axios.delete(`${urlDelete}/${this.itemToDelete}`)--}}
{{--                        .then(response => {--}}
{{--                            this.deleteMessage= "Data berhasil di hapus!";--}}
{{--                            this.itemToDelete = null;--}}
{{--                            this.isDelete = false;--}}
{{--                            this.fetchData();--}}
{{--                            setTimeout(() => {--}}
{{--                                this.deleteMessage="";--}}
{{--                            }, 3000);--}}
{{--                        })--}}
{{--                    } --}}
{{--                 },--}}

{{--                 //fungsi edit --}}
{{--                 getEditData(id) {--}}
{{--                        axios.get(`${urlEdit}/${id}`)--}}
{{--                        .then(response => {--}}
{{--                            this.itemToEdit= response.data.data;--}}
{{--                            this.isShowFormEdit= true;--}}
{{--                            this.errors={};--}}
{{--                        })--}}
{{--                 },--}}
{{--                 editItem() {--}}
{{--                    axios.put(urlEdit , this.itemToEdit)--}}
{{--                    .then(response => {--}}
{{--                        this.editMessage="Data berhasil di ubah!";--}}
{{--                        this.fetchData();--}}
{{--                        this.isShowFormEdit=false;--}}
{{--                        this.itemToEdit= null,--}}
{{--                        setTimeout(()=> {--}}
{{--                            this.editMessage="";--}}
{{--                        }, 3000);--}}
{{--                        console.log(response);--}}
{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        this.errors = {};--}}
{{--                        if (error.response.request.status == 400) {--}}
{{--                            this.errors.nameEdit = 'Nama sudah terdaftar.';--}}
{{--                        }--}}
{{--                        console.log(error);--}}
{{--                     })--}}
{{--                 }--}}
{{--            }--}}
{{--        }--}}
{{--     </script>--}}
{{--</body>--}}
{{--</html>--}}
