function SeePassword(params) {
    let password = params.idPassword;
    let button = params.idButton;
    let type= $(`#${password}`).attr('type')
    if(type == 'password'){
        $(`#${password}`).attr('type', 'text');
        $(`#${button}`).html('<i class="fas fa-eye"></i>')
    }else{
        $(`#${password}`).attr('type', 'password');
        $(`#${button}`).html('<i class="fas fa-eye-slash"></i>')
    }
}

function ConfirmPassword(params) {
    let password = $(`#${params.idPassword}`).val()
    let confirmPassword = $(`#${params.idConfirmPassword}`).val()

    if (password == confirmPassword) {
        return 1;
    }else{
        return 0;
    }
}

function Table(data) {
    $(data.table).DataTable().destroy();
    if (data.callbackButton) {
        if(data.parm){
            $(data.table).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: data.url,
                    data:data.parm
                },
                language: {
                    "search": "Search Data:",
                    'searchPlaceholder' : 'Search',
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                    }
                },
                columns: data.data,
                // fnDrawCallback: function() {
                //     $(`${data.callbackButton.id}`).bootstrapToggle({
                //         size:data.callbackButton.size,
                //         on:data.callbackButton.on,
                //         onstyle:data.callbackButton.onstyle,
                //         offstyle:data.callbackButton.offstyle,
                //         off:data.callbackButton.off,
                //     });
                // },
            });
        }else{
            $(data.table).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: data.url
                },
                 language: {
                    "search": "Search Data:",
                    'searchPlaceholder' : 'Search',
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                    }
                },
                columns: data.data,
                // fnDrawCallback: function() {
                //     $(`${data.callbackButton.id}`).bootstrapToggle({
                //         size:data.callbackButton.size,
                //         on:data.callbackButton.on,
                //         onstyle:data.callbackButton.onstyle,
                //         offstyle:data.callbackButton.offstyle,
                //         off:data.callbackButton.off,
                //     });
                // },
            });
        }
    } else {
        if(data.parm){
            $(data.table).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: data.url,
                    data:data.parm
                },
                 language: {
                    "search": "Search Data:",
                    'searchPlaceholder' : 'Search',
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                    }
                },
                columns: data.data,
            });
        }else{
            $(data.table).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: data.url
                },
                 language: {
                    "search": "Search Data:",
                    'searchPlaceholder' : 'Search',
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                    }
                },
                columns: data.data,
            });
        }
    }

    $(`${data.table}_filter input`).removeClass('form-control-sm')
}

function SweetAlert(data){
    let status, title

    Swal.fire(data.status, data.message, data.status)
}

function SweetQuestions(data){
    Swal.fire({
        title: data.title,
        text: data.subtitle,
        icon:'question',
        showCancelButton: false,
        showDenyButton: true,
        confirmButtonText: data.buttonConfirm,
        denyButtonText: data.buttonDeny,
        reverseButtons:false,
    }).then((result) => {
        if (result.isConfirmed) {
            if (data.confirm == 'ajax') {
                $.ajax({
                    url:data.ajax.url,
                    type:data.ajax.type,
                    data:data.ajax.data,
                    headers:data.ajax.headers,
                    success:data.ajax.success,
                    error:data.ajax.error
                })
            }else{

            }
        } else if (result.isDenied) {
            Swal.fire(data.deny.title, ' ', data.deny.icon)
        }
    })
}

function RefreshTable(data) {
    table = $(`#${data}`).DataTable();
    table.ajax.reload()
}

