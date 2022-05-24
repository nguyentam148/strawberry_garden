const appHelpers = {
    initEditor: function (selectorId) {
        return ClassicEditor
            .create(document.querySelector(selectorId), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'imageInsert',
                        'mediaEmbed',
                        'undo',
                        'redo'
                    ]
                },
                language: 'vi',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                licenseKey: '',
            })
            .catch(error => {
                console.log(error);
            });
    },
    getMessageTool: function () {
        return Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
    },
    fireMessage: function (msg, type) {
        if (!msg.length) {
            return;
        }

        appHelpers.getMessageTool().fire({
            icon: type,
            title: msg
        })
    },
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
