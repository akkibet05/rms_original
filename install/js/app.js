function formatNumber(value) {
    value = parseFloat(value);
    return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

function isEmpty(variable) {
    if (variable === undefined) return true;
    if (variable === null) return true;
    if (variable === "") return true;
    if (isObject(variable) == true) {
        return $.isEmptyObject(variable);
    }
    if (isArray(variable) == true) {
        return (variable.length == 0)
    }
    return false;
}

function callFunction(function_name, params) {
    if (isFunction(function_name) == true) {
        return function_name(params);
    }
    return null;
}

function isJSON(json_string) {
    try {
        JSON.parse(json_string);
    }
    catch (e) {
        return false;
    }
    return true;
}

function getObjectProperty(path, obj) {
    if (isObject(obj) == false) {
        obj = {};
    }
    return path.split('.').reduce(function (prev, curr) {
        return prev ? prev[curr] : null
    }, obj || self)
}

function getValue(path, obj, default_value) {
    var val = getObjectProperty(path, obj);
    if (val == null) {
        val = default_value;
    }
    return val;
}

function getDefaultValue(variable, default_value) {
    if (isEmpty(variable) == true) {
        return default_value;
    }
    return variable;
}

function isFunction(variable) {
    if (typeof variable === 'function') return true;
    return false;
}

function isArray(variable) {
    return (variable.constructor === Array);
}

function supportUpload() {
    return (typeof(window.FileReader) != 'undefined')
}

function isObject(variable) {
    if (variable === undefined) return true;
    if (variable === null) return true;
    return (typeof variable === 'object');
}

function isFullUrl(url) {
    return (url.indexOf('://') > 0 || url.indexOf('//') === 0);
}

function isString(variable) {
    if (typeof variable === 'string' || variable instanceof String) {
        return true;
    }
    return false;
}

function ApiResponse(response) {

    var status = "ok";
    var errors = [];
    var result = "";

    this.createEmpty = function () {
        status = "ok";
        errors = [];
        result = "";
    };

    this.init = function (response) {

        if (isEmpty(response) == true) {
            data = this.createEmpty();
            return;
        }
        if (isObject(response) == true) {
            data = response;
        } else {
            if (isJSON(response) == false) {
                errors = [];
                status = 'ok';
                result = response;
                return;
            }
            data = JSON.parse(response);
        }

        if (isEmpty(data.status) == false) {
            status = data.status;
        }
        if (isEmpty(data.errors) == false) {
            errors = data.errors;
        }
        if (isEmpty(data.result) == false) {
            result = data.result;
        }
    };

    var data = this.init(response);

    this.getResult = function () {
        return result;
    };

    this.getErrors = function () {
        return errors;
    };

    this.addError = function (error) {
        errors.push(error);
    };

    this.hasError = function () {
        return (isEmpty(errors) == false);
    };
}

function Application() {

    var host = window.location.origin;
    var dev_mode = true;
    var jwt_token = null;
    var self = this;
    var base_url = "";
    var loginPageUrl = '/members';
    var timetracker = {
        id: null,
        uuid: null,
    };

    this.url = document.head.querySelector("[property~=route][content]").content;
    this.crossDomain = true;
    this.buttonText = '';
    this.buttonWidth = '';
    this.buttonTextWithClass = '';
    this.buttonWidthWithclass = '';
    this.response;

    this.setDateFormat = function (date_format) {
        if (isEmpty(date_format) == true) {
            date_format = 'MM-DD-YYYY';
        }
        if (isEmpty($.fn.datepicker) == false) {
            $.fn.datepicker.defaults.format = date_format;
        }
    };

    this.formToObject = function (form_array) {
        var result = {};
        if (isArray(form_array) == false) {
            return result;
        }
        for (var i = 0; i < form_array.length; i++) {
            result[form_array[i]['name']] = form_array[i]['value'];
        }
        return result;
    };

    this.setBaseUrl = function (url) {
        if (isEmpty(url) == true) {
            base_url = host + "/";
        } else {
            base_url = url;
        }
    };

    this.init = function (url) {

        if (isEmpty(url) == false) {
            this.setBaseUrl(url);
        } else {
            this.setBaseUrl();
        }
        window.onload = function () {
            if (isEmpty(window.jQuery) == true) {
                console.log("Error: jQuery library missing.");
            }
        }
    };

    this.setToken = function (token) {
        jwt_token = token;
    };

    this.getToken = function () {
        return jwt_token;
    };

    this.log = function (msg) {
        if (dev_mode == true) {
            console.log(msg);
        }
    };

    this.getBaseUrl = function () {
        if (isEmpty(base_url) == true) {
            base_url = "";
        }
        return base_url;
    };

    this.getHost = function () {
        return host;
    };

    this.setHost = function (url) {
        host = url;
    };

    this.getPath = function () {
        return window.location.pathname;
    };

    this.post = function (url, data, onSuccess, onError, auth_type) {
        /*if (isString(data) == true) {
            data = $(data).serialize();
        }*/
        this.apiCall(url, 'POST', data, onSuccess, onError, auth_type);
    };

    this.get = function (url, onSuccess, onError, auth_type) {
        this.apiCall(url, 'GET', null, onSuccess, onError, auth_type);
    };

    this.delete = function (url, onSuccess, onError, auth_type) {
        this.apiCall(url, 'DELETE', null, onSuccess, onError, auth_type);
    };

    this.put = function (url, data, onSuccess, onError, auth_type) {
        if (isString(data) == true) {
            data = $(data).serialize();
        }
        this.apiCall(url, 'PUT', data, onSuccess, onError, auth_type);
    };

    this.getAuthHeader = function (auth_type) {

        if (isEmpty(jwt_token) == true) {
            return null;
        }

        var header = "Bearer " + jwt_token;
        switch (auth_type) {
            case "session": {
                header = "Bearer " + jwt_token;
                break;
            }
            case "jwt": {
                header = "Bearer " + jwt_token;
                break;
            }
            case "none": {
                header = null;
                break;
            }
        }
        return header;
    };

    /**
     * ajax call
     * @param {*} url Request relative URL
     * @param {*} method Request method (GET,POST,PUT,DELETE,PATCH)
     * @param {*} request_data Ajax Request data
     * @param {*} callback  Response handler function
     * @param {*} auth_type Authentication type (, jwt)
     */
    this.request = function (url, method, request_data, onSuccess, onError, onProgress, auth_type) {

        if (isFullUrl(url) == false) {
            url = this.getBaseUrl() + url;
        }

        var auth_header = this.getAuthHeader(auth_type);

        if (isEmpty(request_data) == true) {
            request_data = null;
        }
        var header_data = null;
        if ((method == "GET") && (isObject(request_data) == true)) {
            header_data = JSON.stringify(request_data);
            request_data = null;
        }

        var progress = function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (event) {
                callFunction(onProgress, event);
            }, false);
            return xhr;
        };

        this.log(method + ' request url: ' + url);
        var ajax_params;
        if (this.crossDomain == true) {
            ajax_params = {
                url: url,
                method: method,
                data: request_data,
                crossDomain: true,
                xhrFields: {
                    withCredentials: true
                },
                xhr: progress,
                beforeSend: function (request) {
                    request.withCredentials = true;
                    if (isEmpty(auth_header) == false) {
                        request.setRequestHeader('Authorization', auth_header);
                    }
                    if (isEmpty(header_data) == false) {
                        request.setRequestHeader('Params', header_data);
                    }
                },
                success: function (data) {
                    callFunction(onSuccess, new ApiResponse(data));
                },
                error: function (xhr, status, error) {
                    self.log("Error\n");
                    self.log("Request url: " + url + "\n");
                    self.log("Error details: " + error);
                    self.log("Response: " + xhr.responseText);
                    response = new ApiResponse();
                    response.addError(error);
                    callFunction(onError, response.getErrors());
                }
            };
        } else {
            if (isString(request_data) === true) {
                //request_data = $(request_data).serialize();
                request_data = new FormData($(request_data)[0]);
            } else if (isObject(request_data) === true) {
                var json = request_data;
                request_data = new FormData();
                request_data.append('data', JSON.stringify(json));
            }
            ajax_params = {
                url: url,
                method: method,
                data: request_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function (request) {
                    if (isEmpty(auth_header) == false) {
                        request.setRequestHeader('Authorization', auth_header);
                    }
                    if (isEmpty(header_data) == false) {
                        request.setRequestHeader('Params', header_data);
                    }
                },
                success: function (data) {
                    self.response = data;
                    callFunction(onSuccess, new ApiResponse(data));
                },
                error: function (xhr, status, error) {
                    self.log("Error\n");
                    self.log("Request url: " + url + "\n");
                    self.log("Error details: " + error);
                    self.log("Response: " + xhr.responseText);
                    response = new ApiResponse();
                    response.addError(error);
                    callFunction(onError, response.getErrors());
                }
            };
        }
        $.ajax(ajax_params);
    };

    this.apiCall = function (url, method, request_data, onSuccess, onError, auth_type, onProgress) {

        this.request(url, method, request_data, function (response) {
            if (response.hasError() == false) {
                var result = response.getResult();

                if (isEmpty(result.loged) == false) {
                    if (parseInt(result.loged) == 0) {
                        self.openLoginPage();
                    }
                }
                callFunction(onSuccess, result);
            } else {
                callFunction(onError, response.getErrors());
            }
        }, function (errors) {
            callFunction(onError, errors);
        }, onProgress, auth_type);
    };

    this.getLoader = function (loader_type) {
        var code = "";
        switch (loader_type) {
            case 'icon':
                code = "Please wait (It can take upto 30 seconds) ....";
                break;

            default:
                code = "<div class='text-center mt-40 app-loader'>Please wait ....</div>";
                break;
        }
        return code;
    };

    this.showHtml = function (element_id, content, show_type) {
        show_type = getDefaultValue(show_type, null);

        switch (show_type) {
            case 'prepend':
                $(element_id).prepend(content);
                return;
            case 'append':
                $(element_id).append(content);
                return;
            case 'replace':
                $(element_id).replaceWith(content);
                return;
        }
        $(element_id).html(content);
        return;
    };


    this.load = function (url, element_id, onSuccess, loader_type, show_type) {
        if (isEmpty(element_id) == true) {
            element_id = '#page_content';
        }
        var loader = this.getLoader(loader_type);
        $(element_id).addClass('loader');
        this.showHtml(element_id, loader, show_type);

        this.apiCall(url, 'GET', null, function (result) {
            $(element_id).removeClass('loader');
            if (isEmpty(result.loged) == false) {
                if (parseInt(result.loged) == 0) {
                    self.openLoginPage();
                }
            }
            self.showHtml(element_id, result, show_type);
            callFunction(onSuccess, result);
        }, function (error) {
            console.log(error);
        });
    };

    this.initPaginator = function (element_id) {
        if (isEmpty(element_id) == true) {
            element_id = '#page_content';
        }
        $('.page-link').off();
        $('.page-link').on('click', function () {
            var url = $(this).attr('url');
            self.load(url, element_id, function () {
                self.initPaginator(element_id);
            });
        });
    };

    this.isFormValid = function (form_id) {
        if ($(form_id).has('.has-error').length === 0) {
            return true
        }
        return false;
    };

    this.showLoader = function (button_id, width) {
        $('.errors-container').remove();
        self.buttonText = $('#' + button_id).html();
        self.buttonWidth = $('#' + button_id).width();
        self.buttonWidth = width !== '' ? width : self.buttonWidth + 27;
        $('#' + button_id).attr('disabled', true);
        $('#' + button_id).css('width', self.buttonWidth);
        $('#' + button_id).html("Please wait (It can take upto 30 seconds) ....");
    };

    this.showClassLoader = function (button_id, width) {
        $('.errors-container').remove();
        self.buttonText = $('#' + button_id).html();
        self.buttonWidth = $('#' + button_id).width();
        self.buttonWidth = width !== '' ? width : self.buttonWidth + 27;
        $('#' + button_id).attr('disabled', true);
        $('#' + button_id).css('width', self.buttonWidth);
        $('#' + button_id).html("Please wait (It can take upto 30 seconds) ....");
    };

    this.hideLoader = function (button_id) {
        $('#' + button_id).attr('disabled', false);
        $('#' + button_id).html(self.buttonText);
    };

    this.showMessagesClass = function (messages, element) {
        $('.' + element).prepend(messages);
    };

    this.showMessages = function (messages, element) {
        $('#' + element).prepend(messages);
        /*var element = getDefaultValue(element,'.form-errors');
        $(element).html("");
        $(element).show();
        if (isArray(errors) == true) {
            for (var index = 0; index < errors.length; index++) {
                var error = errors[index];
                if (isObject(error) == true) {
                    var error_label = "";
                    error = "<span>" + error_label + "</span> " + error.message;
                }
                $(element).append("<li>" + error + "</li>");
            }
        } else {
            $(element).append("<li>" + errors + "</li>");
        }*/
    };

    this.onSubmit = function (form_id, onSuccess, onError) {
        $(form_id).off();
        $(form_id).on('submit', function (e) {
            e.preventDefault();
            callFunction(onSuccess);
            /*if (self.isFormValid(form_id) == true) {
                callFunction(onSuccess);
            } else {
                callFunction(onError);
            }*/
        });
    };

    this.openLoginPage = function () {
        window.location.href = this.getBaseUrl() + loginPageUrl;
    };
}

var application = new Application();
var response = new ApiResponse();

$(document).ready(function () {
    application.crossDomain = false;
    application.init();
});
