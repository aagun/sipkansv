const _sipkan_messages = {
    error: {
        server: "Server bermasalah silahkan hubungi admin.",
        required: (attribute = '') => `Field:attribute harus diisi.`.replace(':attribute', attribute ? ` ${attribute}` : attribute)
    }
}
