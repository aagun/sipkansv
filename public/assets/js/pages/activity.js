const url= "http://127.0.0.1:8000";

function activityDataHandler() {

    return {
        observationData: {},
        districtData: {},
        districtDataBackup: {},
        activityData: {},
        exportData: {},
        filterData: {},
        search: {},
        cariKabupaten: "",
        years: {},
        isDelete: false,

        yearDropdown() {
            const currentYear = new Date().getFullYear();
            const years= [];
            for (let i = currentYear; i >= currentYear - 20; i--) {
                years.push(i);
            }
            this.years = years;
        },  

        filterActivity() { 
            this.filterData.limit = 0;
            this.filterData.search = this.search;
            axios.post(`${url}/activity-reports/search`, this.filterData)
            .then(response=> {
                this.activityData = response.data.data.data;
                console.log(this.activityData);
            })

        },
        filterKabupaten() {
            if (this.cariKabupaten == "") {
                this.districtData = this.districtDataBackup;
                return null;
            }
            this.districtData = this.districtDataBackup.filter( item => item.district_name.toLowerCase().includes(this.cariKabupaten.toLowerCase()) );
        },
        fetchObservationData() {
            axios.post(`${url}/observations/search`, {limit: 0})
            .then(response => {
                this.observationData = response.data.data.data;
            })
        },
        fetchDistrictData() {
            axios.post(`${url}/districts/search`, {limit: 0})
            .then(response => {
                this.districtData = response.data.data.data;
                this.districtDataBackup = this.districtData;
            })
        },
        fetchActivityData() {
            axios.post(`${url}/activity-reports/search`, {limit: 0})
            .then(response=> {
                this.activityData = response.data.data.data;
            })

            axios.get(`${url}/activity-reports/export`)
            .then(response => {
                this.exportData = response.data.data;
            })
        },
        formatDateRead(date) {
            const [year, month, day] = date.split('-');
            return `${day}-${month}-${year}`;
        },
        editButtonHandler(index) {
            window.location.href = `${url}/dashboard/kegiatan/ubah/${this.activityData[index].activity_report_id}`;
        },
        exportFile() {
            var a = document.createElement('a');
            a.id = "downloadLink_" + Date.now(); // Generate a unique ID based on timestamp
            a.href = this.exportData.content;
            a.download = this.exportData.filename;
            a.click();
        
            document.body.removeChild(a); 
        }
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

        //variabel untuk edit
        

        fetchDropdownData(url, data) {
            axios.post(url, {limit: 0})
            .then(response=> {
                this[data] = response.data.data.data;
            })

        },

        fetchDropdownkbli(url, data) {
            console.log(this.input.sub_sector_id);
            axios.post(url, {search: {sub_sector_id: this.input.sub_sector_id},limit: 0})
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
            console.log(`provinsi: ${this.input.province_id}`);
            axios.post(`http://127.0.0.1:8000/districts/search`, {search: {province_id: this.input.province_id}, limit: 0})
            .then(response => {
                this.dataKabupaten = response.data.data.data;
            })
            .catch(error => {
            })
        } ,
        fetchKecamatan() {
            axios.post(`http://127.0.0.1:8000/sub-districts/search`, {search: {district_id: this.input.district_id}, limit: 0})
            .then(response => {
                this.dataKecamatan = response.data.data.data;
            })
            .catch(error => {
                console.log(error);
            })
        },
        fetchDesa() {                 
            axios.post(`http://127.0.0.1:8000/villages/search`, {search: {sub_district_id: this.input.sub_district_id}, limit: 0})
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
        formatDateCreate(date) {
            const [day, month, year] = date.split('-');
            return `${year}-${month}-${day}`;
        },
        countKepatuhan() {
            const validNumber = /^[0-9]*\.?[0-9]*$/;
            let value = event.target.value;
            console.log(event.target.value);
            if (!validNumber.test(value)) {
                value = "";
            }

            if (this.input.perizinan_berusaha_atas_kegiatan_usaha && this.input.persyaratan_umum_usaha && this.input.persyaratan_khusus_usaha && this.input.sarana && this.input.organisasi_dan_sdm && this.input.pelayanan && this.input.persyaratan_produk && this.input.sistem_manajemen_usaha) {
                let penilaianPemenuhanStandarPelaksanaanKegiatanUsaha = ( Number(this.input.persyaratan_umum_usaha) + Number(this.input.persyaratan_khusus_usaha) + Number(this.input.sarana) + Number(this.input.organisasi_dan_sdm) + Number(this.input.pelayanan) + Number(this.input.persyaratan_produk) + Number(this.input.sistem_manajemen_usaha) ) / 7 ;

                let penilaianKepatuhanTeknis = (penilaianPemenuhanStandarPelaksanaanKegiatanUsaha + Number(this.input.perizinan_berusaha_atas_kegiatan_usaha) ) / 2; 
                this.input.kepatuhan_teknis = penilaianKepatuhanTeknis;

            }

            if (this.input.pelaksanaan_kegiatan_usaha && this.input.riwayat_pengenaan_sanksi) {
                let penilaianKepatuhanAdministratif = ( Number(this.input.pelaksanaan_kegiatan_usaha) + Number(this.input.riwayat_pengenaan_sanksi) ) / 2 ;
                this.input.kepatuhan_administratif = penilaianKepatuhanAdministratif;
            }

            if ( this.input.kepatuhan_teknis && this.input.kepatuhan_administratif ) {

                let penilaianKepatuhan = ( this.input.kepatuhan_teknis + this.input.kepatuhan_administratif ) / 2;

                if (penilaianKepatuhan > 70) {
                    this.input.tingkat_kepatuhan_proyek = "Baik Sekali";
                    this.input.kategory_kepatuhan = "Patuh";
                } else if (penilaianKepatuhan > 49 && penilaianKepatuhan < 71) {
                    this.input.tingkat_kepatuhan_proyek = "Baik";
                    this.input.kategory_kepatuhan = "Patuh";
                } else if (penilaianKepatuhan < 50) {
                    this.input.tingkat_kepatuhan_proyek = "Kurang Baik";
                    this.input.kategory_kepatuhan = "TIdak Patuh";
                }

            }
        },
        
        submitHandler() {
            this.input.inspection_date = this.formatDateCreate(this.input.inspection_date);
            this.input.effective_date = this.formatDateCreate(this.input.effective_date);
           
            let formData = new FormData();
            
            if (this.dokumen_pendukung != undefined) {
                formData.append("dokumen_pendukung", this.dokumen_pendukung);
            }
            for (let key in this.input) {
                formData.append(key, this.input[key]);
            }

            axios.post(`http://127.0.0.1:8000/activity-reports` , formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                this.createMessage = "Berhasil menambah data";
                window.location.href = `${url}/dashboard/kegiatan`;
                this.input = {};
                setTimeout(() => {
                    this.createMessage = "";
                }, 4000);
            })
            .catch(error => {
                console.log(error);
                console.log(formData);
            })


        },
        fetchDataEdit() {
            let path = window.location.pathname.split("/");
            let id = path[path.length - 1];
    
            axios.get(`${url}/activity-reports/${id}`)
            .then((response) => {
                this.input = response.data.data;
                //hitung tingkat kepatuhan teknis
                let penilaianPemenuhanStandarPelaksanaanKegiatanUsaha = ( Number(this.input.persyaratan_umum_usaha) + Number(this.input.persyaratan_khusus_usaha) + Number(this.input.sarana) + Number(this.input.organisasi_dan_sdm) + Number(this.input.pelayanan) + Number(this.input.persyaratan_produk) + Number(this.input.sistem_manajemen_usaha) ) / 7 ;

                let penilaianKepatuhanTeknis = (penilaianPemenuhanStandarPelaksanaanKegiatanUsaha + Number(this.input.perizinan_berusaha_atas_kegiatan_usaha) ) / 2; 
                this.input.kepatuhan_teknis = penilaianKepatuhanTeknis;

                //hitung tingkat kepatuhan administratif
                let penilaianKepatuhanAdministratif = ( Number(this.input.pelaksanaan_kegiatan_usaha) + Number(this.input.riwayat_pengenaan_sanksi) ) / 2 ;
                this.input.kepatuhan_administratif = penilaianKepatuhanAdministratif;

                this.input.inspection_date = this.formatDateCreate(this.input.inspection_date);
                this.input.effective_date = this.formatDateCreate(this.input.effective_date);
            })
            .catch(() => {

            })
        }, 
        editSubmitHandler() {
            this.input.inspection_date = this.formatDateCreate(this.input.inspection_date);
            this.input.effective_date = this.formatDateCreate(this.input.effective_date);

            let path = window.location.pathname.split("/");
            let id = path[path.length - 1];
            
            let formData = new FormData();
            
            if (this.dokumen_pendukung != undefined) {
                formData.append("dokumen_pendukung", this.dokumen_pendukung);
            }

            formData.append("id", id);
            formData.append("_method", "put");
            console.log(id);

            for (let key in this.input) {
                formData.append(key, this.input[key]);
            }

            axios.post(`/activity-reports` , formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                this.createMessage = "Berhasil mengubah data";
                window.location.href = `${url}/kegiatan`;
                this.input = {};
                setTimeout(() => {
                    this.createMessage = "";
                }, 4000);
            })
            .catch(error => {
                console.log(error);
                console.log(formData);
                this.input.inspection_date = this.formatDateCreate(this.input.inspection_date);
                this.input.effective_date = this.formatDateCreate(this.input.effective_date);
            })
        }



    }
}
