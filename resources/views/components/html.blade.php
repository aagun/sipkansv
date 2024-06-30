<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <title>SIPKAN</title>
</head>
<body>
    {{ $slot }}
    <script>
        function formatDateRead(date) {
                const [year, month, day] = date.split('-');
                return `${day}-${month}-${year}`;
        }

        function masterDataHandler(urlCreate, urlRead, urlDelete, urlEdit) {
             return {
                name: "",
                description: "",
                successMessage: "",
                deleteMessage: "",
                editMessage:"",
                items: [],
                errors: {},
                error: "",
                isDelete: false,
                itemToDelete: null,
                itemToEdit: null, 
                isShowForm: false, 
                isShowFormEdit: false, 
                linkPaginate: null,
                pagination: {
                    links: []
                },
                validateForm() {
                    this.errors = {};
                    if (!this.name) {
                        this.errors.name = 'Nama harus diisi.';
                    } 
                    if (!this.description) {
                        this.errors.description = 'Deskripsi harus diisi.';
                    }
                    return Object.keys(this.errors).length === 0;
                },
                //untuk membuat data
                createSubmit () {
                    if (!this.validateForm()) {
                        return;
                    }
                     axios.post(urlCreate, {
                         name: this.name,
                         description: this.description,
                     })
                     .then(response => {
                        this.successMessage = "Data berhasil ditambah!";
                        this.name = '';
                        this.description = '';
                        this.fetchData();
                        setTimeout(()=> {
                            this.successMessage = "";
                        },4000)
                     })
                     .catch(error => {
                        this.errors = {};
                        if (error.response.request.status == 400) {
                            this.errors.name = 'Nama sudah terdaftar.';
                        }
                        console.log(error);
                     })
                },
                //untuk ambil data dari database 
                fetchData(url = urlRead) {
                    this.error = "",
                    axios.post(url, { page: this.pagination.current_page, })
                    .then(response => {
                        this.items = response.data.data.data;
                        this.pagination = response.data.data;
                        console.log(this.items);
                        console.log(this.pagination.last_page);
                    })
                    .catch(error => {
                        this.error = 'Terjadi kesalahan saat mengambil data.';
                        console.error(error);
                    })
                },
                //fungsi untuk delete
                confirmDelete(id) {
                    this.itemToDelete = id;
                    this.isDelete = true;
                },
                 deleteItem() {
                    if (this.itemToDelete !== null) {
                        axios.delete(`${urlDelete}/${this.itemToDelete}`)
                        .then(response => {
                            this.deleteMessage= "Data berhasil di hapus!";
                            this.itemToDelete = null;
                            this.isDelete = false;
                            this.fetchData();
                            setTimeout(() => {
                                this.deleteMessage="";
                            }, 3000);
                        })
                    } 
                 },

                 //fungsi edit 
                 getEditData(id) {
                        axios.get(`${urlEdit}/${id}`)
                        .then(response => {
                            this.itemToEdit= response.data.data;
                            this.isShowFormEdit= true;
                            this.errors={};
                        })
                 },
                 editItem() {
                    axios.put(urlEdit , this.itemToEdit)
                    .then(response => {
                        this.editMessage="Data berhasil di ubah!";
                        this.fetchData();
                        this.isShowFormEdit=false;
                        this.itemToEdit= null,
                        setTimeout(()=> {
                            this.editMessage="";
                        }, 3000);
                        // console.log(response);
                    })
                    .catch(error => {
                        this.errors = {};
                        if (error.response.request.status == 400) {
                            this.errors.nameEdit = 'Nama sudah terdaftar.';
                        }
                        console.log(error);
                     })
                 }
            }
        }

        function activityDataHandler() {
            return {
                observationData: {},
                districtData: {},
                activityData: {},


                fetchObservationData() {
                    axios.post("http://127.0.0.1:8000/observations/search")
                    .then(response => {
                        this.observationData = response.data.data.data;
                    })
                },
                fetchDistrictData() {
                    axios.post("http://127.0.0.1:8000/districts/search", {limit: 0, offset: 1})
                    .then(response => {
                        this.districtData = response.data.data.data;
                    })
                },
                fetchActivityData() {
                    axios.post("http://127.0.0.1:8000/activity-reports/search")
                    .then(response=> {
                        this.activityData = response.data.data.data;
                    })
                },
                formatDateRead(date) {
                    const [year, month, day] = date.split('-');
                    return `${day}-${month}-${year}`;
            },
            }
        }

        function formActivityDataHandler() {
            return {
                //data input
                // bap_number: "",
                // activity_id: "",
                // observation_id: "",
                // supervisor_id: "",
                // inspection_date: "",
                // company_name: "",
                // business_entity_type_id: "",
                // address: "",
                // village_id: "",
                // sub_district_id: "",
                // district_id: "",
                // province_id: "",
                // manager_id: "",
                // nib: "",
                // effective_date: "",
                // project_code: "",
                // sub_sector: "",
                // kbli_id: "",
                // business_scale_id: "",
                // persetujuan_kesesuaian_ruang: "",
                // persetujuan_lingkungan: "",
                // pbg_slf: "",
                // pernyataan_mandiri: "",
                // investment_type_id: "",
                // latitude: "",
                // longitude: "",
                // sertifikat_standar: "",
                // kepatuhan_teknis: "",
                // perizinan_berusaha_atas_kegiatan_usaha: "",
                // persyaratan_umum_usaha: "",
                // persyaratan_khusus_usaha: "",
                // sarana: "",
                // organisasi_dan_sdm: "",
                // pelayanan: "",
                // persyaratan_produk: "",
                // sistem_manajemen_usaha: "",
                // pelaksanaan_kegiatan_usaha: "",
                // riwayat_pengenaan_sanksi: "",
                // tingkat_kepatuhan_proyek: "",
                // kategory_kepatuhan: "",
                // permasalahan_perusahaan: "",
                // hasil_pengawasan: "",
                dokumen_pendukung: "",
                // recommendation_id: "",
                input: {},
                //untuk menyimoan data dropdown input
                dataKegiatan: "",
                dataPengawasan: "",
                dataNamaPengawas: "",
                dataStatusBadanUsaha: "",
                dataProvinsi: "",
                filterProvinsi: "",
                dataKabupaten: "",
                filterKabupaten: "",
                dataKecamatan: "",
                filterKecamatan: "",
                dataDesa: "",
                filterDesa: "",
                dataNamaPenanggungJawab: "",
                dataPenanggungJawab: "",
                dataSubSektor: "",
                datakbli: "",
                datakbliBackup: "",
                carikbli: "",
                dataSkalaUsaha: "",
                dataStatusInvestasi: "",
                dataKepatuhanProyek: "",
                dataRekomendasi: "",

                //pesan respon
                createMessage: "",
                

                fetchDropdownData(url, data) {
                    axios.post(url)
                    .then(response=> {
                        this[data] = response.data.data.data;
                    })

                },

                fetchDropdownkbli(url, data) {
                    axios.post(url)
                    .then(response=> {
                        this[data] = response.data.data.data;
                        this.datakbliBackup = this.datakbli;
                    })
                },
                filterkbli() {
                    if (this.carikbli == "") {
                        this.datakbli = this.datakbliBackup;
                        return null;
                    }
                    this.datakbli = this.datakbliBackup.filter( item => item.name.toLowerCase().includes(this.carikbli.toLowerCase()) );
                },  
                //untuk ambil data dropdown daerah
                fetchKabupaten() {
                    axios.post(`http://127.0.0.1:8000/districts/search`, {province_id: this.province_id})
                    .then(response => {
                        this.dataKabupaten = response.data.data.data;
                    })
                    .catch(error => {
                    })
                } ,
                fetchKecamatan() {
                    axios.post(`http://127.0.0.1:8000/sub-districts/search`, {district_id: this.district_id})
                    .then(response => {
                        this.dataKecamatan = response.data.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
                } ,
                fetchDesa() {                 
                    axios.post(`http://127.0.0.1:8000/villages/search`, {sub_district_id: this.sub_district_id})
                    .then(response => {
                        this.dataDesa = response.data.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
                } ,
                fetchDataManager() {
                    axios.get(`http://127.0.0.1:8000/users/${this.input.manager_id}`)
                    .then(response => {
                        this.dataPenanggungJawab = response.data.data;
                    })
                },
                fileHandleChange(event) {
                    this.dokumen_pendukung= event.target.files[0];
                },
                formatDate(date) {
                    const [day, month, year] = date.split('-');
                    return `${year}-${month}-${day}`;
                },
                countKepatuhan() {
                    if ( this.input.kepatuhan_teknis && this.input.perizinan_berusaha_atas_kegiatan_usaha && this.input.persyaratan_umum_usaha && this.input.persyaratan_khusus_usaha && this.input.sarana && this.input.organisasi_dan_sdm && this.input.pelayanan && this.input.persyaratan_produk && this.input.sistem_manajemen_usaha && this.input.kepatuhan_administratif && this.input.pelaksanaan_kegiatan_usaha && this.input.riwayat_pengenaan_sanksi ) {
                        let skorKepatuhan = ( Number(this.input.kepatuhan_teknis) + Number(this.input.perizinan_berusaha_atas_kegiatan_usaha) + Number(this.input.persyaratan_umum_usaha) + Number(this.input.persyaratan_khusus_usaha) + Number(this.input.sarana) + Number(this.input.organisasi_dan_sdm) + Number(this.input.pelayanan) + Number(this.input.persyaratan_produk) + Number(this.input.sistem_manajemen_usaha) + Number(this.input.kepatuhan_administratif) + Number(this.input.pelaksanaan_kegiatan_usaha) + Number(this.input.riwayat_pengenaan_sanksi) ) / 12;

                        if (skorKepatuhan > 70) {
                            this.input.tingkat_kepatuhan_proyek = "Baik Sekali";
                            this.input.kategory_kepatuhan = "Patuh";
                        } else if (skorKepatuhan > 49 && skorKepatuhan < 71) {
                            this.input.tingkat_kepatuhan_proyek = "Baik";
                            this.input.kategory_kepatuhan = "Patuh";
                        } else if (skorKepatuhan < 50) {
                            this.input.tingkat_kepatuhan_proyek = "Kurang Baik";
                            this.input.kategory_kepatuhan = "TIdak Patuh";
                        }

                    }
                },
                
                submitHandler() {
                    this.input.inspection_date = this.formatDate(this.input.inspection_date);
                    this.input.effective_date = this.formatDate(this.input.effective_date);
                    
                    let formData = new FormData();

                    formData.append("dokumen_pendukung", this.dokumen_pendukung);
                    for (let key in this.input) {
                        formData.append(key, this.input[key]);
                    }

                    for (let pair of formData.entries()) {
                        console.log(pair[0]+ ', ' + pair[1]);
                    }

                    axios.post(`http://127.0.0.1:8000/activity-reports` , formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        console.log(response);
                        console.log(formData);
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(formData);
                    })


                }



            }
        }



        function yearDropdown() {
            const currentYear = new Date().getFullYear();
            const years = [];
            for (let i = currentYear; i >= currentYear - 20; i--) {
                years.push(i);
            }
            return {
                years: years,
                selectedYear: null
            };
        }

        // JavaScript to toggle the dropdown
        const dropdownButtonActivity = document.getElementById('dropdown-button-activity');
        const dropDownMenuActivity = document.getElementById('dropdown-menu-activity');
        const searchInputActivity = document.getElementById('search-input-activity');
        let isOpenActivity = true; // Set to true to open the dropdown by default

        const dropdownButtonKabupaten = document.getElementById('dropdown-button-kabupaten');
        const dropDownMenuKabupaten = document.getElementById('dropdown-menu-kabupaten');
        const searchInputKabupaten = document.getElementById('search-input-kabupaten');
        let isOpenKabupaten = true; // Set to true to open the dropdown by default

        function toggleDropdownkab() {
          isOpenKabupaten = !isOpenKabupaten;
          dropDownMenuKabupaten.classList.toggle('hidden', !isOpenKabupaten);
        }
        
        // Set initial state
        toggleDropdownkab();
        
        dropdownButtonKabupaten.addEventListener('click', () => {
          toggleDropdownkab();
        });
        
        // Add event listener to filter items based on input
        searchInputKabupaten.addEventListener('input', () => {
          const searchTerm = searchInputKabupaten.value.toLowerCase();
          const items = dropDownMenuKabupaten.querySelectorAll('a');
        
          items.forEach((item) => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
              item.style.display = 'block';
            } else {
              item.style.display = 'none';
            }
          });
        });

        
        // Function to toggle the dropdown state
        function toggleDropdown() {
          isOpenActivity = !isOpenActivity;
          dropDownMenuActivity.classList.toggle('hidden', !isOpenActivity);
        }
        
        // Set initial state
        toggleDropdown();
        
        dropdownButtonActivity.addEventListener('click', () => {
          toggleDropdown();
        });
        
        // Add event listener to filter items based on input
        searchInputActivity.addEventListener('input', () => {
          const searchTerm = searchInputActivity.value.toLowerCase();
          const items = dropDownMenuActivity.querySelectorAll('a');
        
          items.forEach((item) => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
              item.style.display = 'block';
            } else {
              item.style.display = 'none';
            }
          });
        });
       
     </script>
</body>
</html>