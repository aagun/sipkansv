const _sipkan_http_config = axios.create({
    baseURL: 'http://localhost:8000'
})

const _sipkan_http = {
    get: async (endpoint, data = null, config = null) => _sipkan_http_config.get(endpoint, config),
    delete: async (endpoint, data = null, config = null) => _sipkan_http_config.delete(endpoint, config),
    post: async (endpoint, data, config = null) => _sipkan_http_config.post(endpoint, data, config),
    put: async (endpoint, data, config = null) => {
        if (data instanceof FormData) {
            data.appendChild('_method', 'put');
        } else {
            data = {...data, _method: 'put'}
        }

        return _sipkan_http_config.post(endpoint, data, config);
    }
}
