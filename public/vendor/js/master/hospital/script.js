$(document).ready(function() {
    const data = [
        {data:'id', name:'id'},
        {data:'name', name:'name'},
        {data:'address', name:'address'},
        {data:'area_code', name:'area_code'},
        {data:'created_at', name:'created_at'},
        {data:'btn', name:'btn'},
    ];
    Table({table:'table', data:data, url:'/api/v1/hospital/get'})

    $('#buttonNew').on('click', function() {
        $('#modalForm').modal('show')
        $('#modalForm form input').val(' ')
        $('#modalFormLabel').text('Tambah Data Rumah Sakit');
        $('#modalForm form').attr('id', 'insert')
    })

    $('#modalForm').on('submit', '#insert', function(e) {
        e.preventDefault()
        $.ajax({
            url:'/api/v1/hospital/insert',
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
            url:'/api/v1/hospital/get/'+id,
            success:res=>{
                $('#modalForm').modal('show')
                $('#modalFormLabel').text('Edit Jenis Vaksin');
                $('#modalForm form').attr('id', 'update')
                $('#modalForm form input[name="name"]').val(res.values.name)
                $('#modalForm form input[name="id"]').val(res.values.id)
                $('#modalForm form input[name="address"]').val(res.values.address)
                $('#modalForm form select option').attr('selected', false)
                $('#modalForm form select option[value="'+res.values.area_code+'"]').attr('selected', true)
            },
            error:err=>console.log(err.responseJSON)
        })
    })

    $('#table').on('click', '#Hapus', function() {
        let id= $(this).data('id')
        SweetQuestions({
            title : 'Apakah anda yakin?',
            subtitle : 'Apakah anda ingin menghapus data rumah sakit ini?',
            buttonConfirm : 'Yes',
            buttonDeny: 'No',
            confirm : 'ajax',
            deny : {
                icon:'error',
                title : 'Gagal menghapus'
            },
            ajax : {
                url:'/api/v1/hospital/delete',
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
            url:'/api/v1/hospital/update',
            type:'POST',
            data:new FormData(this),
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

})
