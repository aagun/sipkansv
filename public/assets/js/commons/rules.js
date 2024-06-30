const _sipkan_validateRule = {
    required: (value) => _sipkan_isNotNull(value)
}

function _sipkan_isNotNull(value) {
    return !_sipkan_isNull(value)
}

function _sipkan_isNull(value) {
    return (value === null || value === undefined) ||
        (typeof value === 'object' && Object.keys(value).length === 0) ||
        (Array.isArray(value) && value.length === 0) ||
        (typeof value === 'string' && value.trim() === '');
}
