const websiteHelpers = {
    loading: {
        hide: function () {
            $(".page-loader div").fadeOut();
            $(".page-loader").fadeOut("slow");
        },
        show: function () {
            $(".page-loader div").fadeIn();
            $(".page-loader").fadeIn("slow");
        }
    },
    statusCode: {
        Success: 200,
        UnprocessableEntity: 422,
        Unauthorized: 401,
        InternalServerError: 500,
    }
};

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document)
        .ajaxStart(function () {
            websiteHelpers.loading.show();
        })
        .ajaxStop(function () {
            websiteHelpers.loading.hide();
        });
});

// Register student.
$(document).on('submit', 'form#register_form', function (event) {
    event.preventDefault();

    const form = $(this);

    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        beforeSend: function () {
            form.find('input').removeClass('is-invalid');
            form.find('input').siblings('span').remove();
        },
        success: function (data) {
            if (data.status) {
                window.location.reload();
            } else if (data.statusCode === websiteHelpers.statusCode.UnprocessableEntity) {
                const errors = data.message;

                $.each(errors, function (inputName, messages) {
                    const input = form.find('input[name="' + inputName + '"]');
                    const inputDiv = input.closest('div.form-item');

                    input.addClass('is-invalid');
                    inputDiv.append('<span class="text-danger">' + messages.join(',') + '</span>');
                });
            } else if (data.statusCode === websiteHelpers.statusCode.Unauthorized) {
                window.location.reload();
            } else {
                toastr.error(data.message + ': ' + data.error);
            }
        },
        error: function () {
            toastr.error("Đã có lỗi xảy ra!!");
        },
    });
});

// Login student.
$(document).on('submit', 'form#login_form', function (event) {
    event.preventDefault();

    const form = $(this);

    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        beforeSend: function () {
            form.find('input').removeClass('is-invalid');
            form.find('input').siblings('span').remove();
        },
        success: function (data) {
            if (data.status) {
                if (data.data && data.data.redirectUrl) {
                    window.location.href = data.data.redirectUrl;
                } else {
                    window.location.reload();
                }
            } else if (data.statusCode === websiteHelpers.statusCode.UnprocessableEntity) {
                const errors = data.message;

                $.each(errors, function (inputName, messages) {
                    const input = form.find('input[name="' + inputName + '"]');
                    const inputDiv = input.closest('div.form-item');

                    input.addClass('is-invalid');
                    inputDiv.append('<span class="text-danger">' + messages.join(',') + '</span>');
                });
            } else if (data.statusCode === websiteHelpers.statusCode.Unauthorized) {
                window.location.reload();
            } else {
                toastr.error(data.message + ': ' + data.error);
            }
        },
        error: function () {
            toastr.error("Đã có lỗi xảy ra!!");
        },
    });
});

// Update Student
$(document).on('submit', 'form#account_edit_form', function (event) {
    event.preventDefault();

    const form = $(this);

    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        beforeSend: function () {
            form.find('input').removeClass('is-invalid');
            form.find('input').siblings('span').remove();
        },
        success: function (data) {
            if (data.status) {
                window.location.reload();
            } else if (data.statusCode === websiteHelpers.statusCode.UnprocessableEntity) {
                const errors = data.message;

                $.each(errors, function (inputName, messages) {
                    const input = form.find('input[name="' + inputName + '"]');
                    const inputDiv = input.closest('div.form-item');

                    input.addClass('is-invalid');
                    inputDiv.append('<span class="text-danger">' + messages.join(',') + '</span>');
                });
            } else if (data.statusCode === websiteHelpers.statusCode.Unauthorized) {
                window.location.reload();
            } else {
                toastr.error(data.message + ': ' + data.error);
            }
        },
        error: function () {
            toastr.error('Đã có lỗi xảy ra!!');
        },
    });
});

// Register Course by Student
$(document).on('click', '.js_register_course', function (event) {
    event.preventDefault();

    const button = $(this);

    $.ajax({
        type: 'POST',
        url: button.data('url'),
        data: {},
        success: function (data) {
            if (data.status) {
                button.closest('.modal').modal('hide');

                const buttonOpenModal = $('#js_register_course');
                buttonOpenModal.html('Chờ xác nhận');
                buttonOpenModal.attr('disabled', true);
                buttonOpenModal.attr('href', 'javascript:void(0);');
                buttonOpenModal.removeAttr('data-toggle')
                buttonOpenModal.removeAttr('data-target');

                toastr.success(data.message);
            } else {
                toastr.error(data.message + ': ' + data.error);
            }
        },
        error: function () {
            toastr.error('Đã có lỗi xảy ra!!');
        },
    });
});
setTimeout(function () {
    $('.item-course').css('position', 'relative')
    $('.item-course').css('left', 'unset')
    $('.item-course').css('top', 'unset')
}, 50)

