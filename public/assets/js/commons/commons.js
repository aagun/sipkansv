function _sipkan_getSotreData($storeKey) {
    return Alpine.store($storeKey);
}

function _spikan_getData($storeKey) {
    return Alpine.store($storeKey).options.data.reduce((obj, curr) => ({...obj, [curr.name]: curr.value}), {} );
}

function _sipkan_getElementLabel(id) {
    return $('label[for="' + id + '"]');
}

function _sipkan_getElementInput(id) {
    return $('input[id="' + id + '"]');
}

function _sipkan_getElementLabelText(id) {
    const label = _sipkan_getElementLabel(id).text();
    if (_sipkan_isNull(label)) return null;
    return label.replace('*', '').trim();

}
function _sipkan_getErrorMessage(rule, attribute, elementId) {
    let label = _sipkan_getElementLabelText(elementId);
    return _sipkan_messages.error[rule](label)
}

function _sipkan_isValidInput(rule, value) {
    return _sipkan_validateRule[rule](value);
}

function _sipkan_setMessageAlertList(id, messages) {
    const objParentErrorList = $(`#${id}_alert_list`)
    const objErrorList = $('ul.list-inside', objParentErrorList);

    objErrorList.empty();
    objParentErrorList.removeClass('opacity-0 hidden');


    if (typeof messages === 'string') {
        objErrorList.append(messages);
    } else {
        objErrorList.append(messages
            .reduce((acc, curr) => acc + `<li>${curr}</li>`, '')
        );
    }
}

function _sipkan_setErrorMessages(id, listError) {
    const objParentErrorList = $(`#${id}_alert_list`)
    const objErrorList = $('ul.list-inside', objParentErrorList);

    objErrorList.empty();

    const messageBag = listError.map((error) => {
        error.objParent.addClass('sipkan__has-error')
        return error.message;
    });

    objParentErrorList.removeClass('opacity-0 hidden');
    objErrorList.append(messageBag.join(''));

    return {objAlertList: objErrorList, messageBag};
}

function _sipkan_setGlobalMessage(id, message) {
    const objParentErrorList = $(`#${id}`)
    objParentErrorList.removeClass('opacity-0 hidden');

    const messageBox = $('div[data-message]', objParentErrorList);
    messageBox.empty();
    messageBox.append(message);
}

function _sipkan_setGlobalMessageError(message) {
    _sipkan_setGlobalMessage('sipkanGlobalMessageError_alert', message);
}

function _sipkan_setGlobalMessageSuccess(message) {
    _sipkan_setGlobalMessage('sipkanGlobalMessageSuccess_alert', message);
}

function _sipkan_clearGolbalMessage(id) {
    document.querySelector(`[data-dismiss-target="#${id}"]`).click();
    const objParentErrorList = $(`#${id}`)
    $('div[data-message]', objParentErrorList).empty();
}

function _sipkan_clearGolbalMessageError() {
    _sipkan_clearGolbalMessage('sipkanGlobalMessageError_alert');
}

function _sipkan_clearGolbalMessageSuccess() {
    _sipkan_clearGolbalMessage('sipkanGlobalMessageSuccess_alert');
}

function _sipkan_setAlertMessage(id, message) {
    const objParentErrorList = $(`#${id}_alert`)
    objParentErrorList.removeClass('opacity-0 hidden');

    const messageBox = $('div[data-message]', objParentErrorList);
    messageBox.empty();
    messageBox.append(message);

    return {objAlert: messageBox};
}
function _sipkan_validateFormData(storeKey) {
    const {options, prefix} = _sipkan_getSotreData(storeKey);
    const data = options.data;
    const errors = [];

    if (options?.rules) {
        for (const [attribute, rules] of Object.entries(options.rules)) {
            for (const rule of rules) {
                const value = data[attribute].value;
                const elementId = data[attribute].id;
                if (!_sipkan_isValidInput(rule, value)) {
                    errors.push({
                        objParent: _sipkan_getElementLabel(elementId).parent(),
                        message: `<li>${_sipkan_getErrorMessage(rule, attribute, elementId)}</li>`
                    });
                }
            }
        }
    }

    const hasError = _sipkan_isNotNull(errors);
    let responseError = {}

    if (hasError) {
        responseError = _sipkan_setErrorMessages(prefix, errors);
    }

    return {data, hasError, ...responseError};
}

function _sipkan_closeModal(id) {
    document.querySelector(`[data-modal-toggle="${id}"]`).click();
}

function _sipkan_toggleModal(id) {
    document.querySelector(`[data-modal-toggle="${id}"]`).click();
}

function _sipkan_cleanInputs(data) {
    Object.entries(data)
        .forEach(([key, detail]) => $(`#${detail.id}`).val(''));
}

function _sipkan_cleanAlert(id) {
    const objParentError = $(`#${id}_alert`)
    $('div[data-message]', objParentError).empty();
}

function _sipkan_clearAlertList(id) {
    const alertList = $(`#${id}_alert_list`);
    alertList.addClass('opacity-0 hidden')
    $('ul.list-inside', alertList).empty();
}

function _sipkan_clearAlert(id) {
    const alertList = $(`#${id}_alert`);
    alertList.addClass('opacity-0 hidden')
    $('div[data-message]', alertList).empty();
}

function _sipkan_closeAlert(id) {
    document.querySelector(`[data-dismiss-target="#${id}_alert"]`).click();
}

function _sipkan_cleanAlertList(id) {
    const objParentErrorList = $(`#${id}_alert_list`)
    $('ul.list-inside', objParentErrorList).empty();
}

function _sipkan_closeAlertList(id) {
    document.querySelector(`[data-dismiss-target="#${id}_alert_list"]`).click();
}

function _sipkan_ok(response) {
    return response.data.status === 'success';
}
