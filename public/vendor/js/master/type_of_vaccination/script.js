$(document).ready(function() {
    const data = [
        {data:'id', name:'id'},
        {data:'name', name:'name'},
        {data:'created_by', name:'created_by'},
        {data:'created_at', name:'created_at'},
        {data:'btn', name:'btn'},
    ];
    let id

    Table({table:'table', data:data, url:'/api/v1/vaccination/type/get'})

    $('#buttonNew').on('click', function() {
        $('#modalForm').modal('show')
        $('#modalForm form input[name="name"]').val(' ')
        $('#modalFormLabel').text('Tambah Jenis Vaksin');
        $('#modalForm form').attr('id', 'insert')
    })

    $('#modalForm').on('submit', '#insert', function(e) {
        e.preventDefault()
        $.ajax({
            url:'/api/v1/vaccination/type/insert',
            data:new FormData(this),
            type:'POST',
            contentType:false,
            processData:false,
            headers:{
                'X-CSRF-TOKEN':csrftoken
            },
            success:res=>{
                SweetAlert(res)
                RefreshTable('table')
            },
            error:err=>{
                SweetAlert({message:err.responseJSON.message, status:err.status == 500 ? 'error' : 'warninng'})
            }
        })
    })

    $('#table').on('click', '#Edit', function() {
        let id= $(this).data('id')
        $.ajax({
            url:'/api/v1/vaccination/type/get/'+id,
            success:res=>{
                $('#modalForm').modal('show')
                $('#modalFormLabel').text('Edit Jenis Vaksin');
                $('#modalForm form').attr('id', 'update')
                $('#modalForm form input[name="name"]').val(res.values.name)
                $('#modalForm form input[name="id"]').val(res.values.id)
            },
            error:err=>console.log(err.responseJSON)
        })
    })

    $('#table').on('click', '#Hapus', function() {
        let id= $(this).data('id')
        SweetQuestions({
            title : 'Apakah anda yakin?',
            subtitle : 'Apakah anda ingin menghapus data vaksin ini?',
            buttonConfirm : 'Yes',
            buttonDeny: 'No',
            confirm : 'ajax',
            deny : {
                icon:'error',
                title : 'Gagal menghapus'
            },
            ajax : {
                url:'/api/v1/vaccination/type/delete',
                type:'DELETE',
                data:{
                    id:id,
                },
                headers:{
                    'X-CSRF-TOKEN':csrftoken
                },
                success:res=>{
                    SweetAlert(res)
                    RefreshTable('table')
                },
                error:err=>{
                    SweetAlert({message:err.responseJSON.message, status:err.status == 500 ? 'error' : 'warninng'})
                }
            }
        })
    })

    $('#modalForm').on('submit', '#update', function(e) {
        e.preventDefault()
        $.ajax({
            url:'/api/v1/vaccination/type/update',
            type:'PUT',
            data:{
                id:$('#modalForm form input[name="id"]').val(),
                name:$('#modalForm form input[name="name"]').val()
            },
            headers:{
                'X-CSRF-TOKEN':csrftoken
            },
            success:res=>{
                SweetAlert(res)
                RefreshTable('table')
            },
            error:err=>{
                SweetAlert({message:err.responseJSON.message, status:err.status == 500 ? 'error' : 'warninng'})
            }
        })
    })

})
