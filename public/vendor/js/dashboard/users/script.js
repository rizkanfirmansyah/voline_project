$(document).ready(function() {
    const data = [
        {data:'id', name:'id'},
        {data:'name', name:'name'},
        {data:'email', name:'email'},
        {data:'address', name:'address'},
        {data:'status', name:'status'},
        {data:'created_at', name:'created_at'},
        {data:'btn', name:'btn'},
    ];
    Table({table:'table', data:data, url:'/api/v1/pattient/get'})

    $('#buttonNew').on('click', function() {
        $('#modalForm').modal('show')
        $('#modalForm form').attr('id', 'register')
        $('#modalForm input').val(' ')
        $('#modalForm select[name="kecamatan"]').html('<option value disabled selected>== Pilih Kecamatan ==</option>')
        $('#modalForm select[name="kota"]').html('<option value disabled selected>== Pilih Kota ==</option>')
        $('#modalForm select[name="area_code"]').html('<option value disabled selected>== Pilih Kelurahan ==</option>')
        $('#modalForm select[name="provinsi"] option').attr('selected', false)
        $('#modalFormLabel').text('Tambah pengguna baru')
    })

    $('#modalForm select[name="provinsi"]').on('change', function() {
        $.ajax({
            url:'/api/v1/area/regencies',
            data:{
                province_id:$(this).val()
            },
            success:res=>{
                let html
                res.values.forEach(value=>{
                    html += `<option value="${value.id}">${value.name}</option>`
                })
                $('#modalForm select[name="kota"]').html('<option value disabled selected>== Pilih Kota ==</option>'+html)
            },
            error:err=>console.log(err)
        })
    })

    $('#modalForm select[name="kota"]').on('change', function() {
        $.ajax({
            url:'/api/v1/area/districts',
            data:{
                regency_id:$(this).val()
            },
            success:res=>{
                let html
                res.values.forEach(value=>{
                    html += `<option value="${value.id}">${value.name}</option>`
                })
                $('#modalForm select[name="kecamatan"]').html('<option value disabled selected>== Pilih Kecamatan ==</option>'+html)
            },
            error:err=>console.log(err)
        })
    })

    $('#modalForm select[name="kecamatan"]').on('change', function() {
        $.ajax({
            url:'/api/v1/area/villages',
            data:{
                district_id:$(this).val()
            },
            success:res=>{
                let html
                res.values.forEach(value=>{
                    html += `<option value="${value.id}">${value.name}</option>`
                })
                $('#modalForm select[name="area_code"]').html('<option value disabled selected>== Pilih Desa/Kelurahan ==</option>'+html)
            },
            error:err=>console.log(err)
        })
    })

    $('#modalForm').on('submit', '#register', function(e) {
        e.preventDefault();
        $.ajax({
            url:'/api/v1/pattient/insert',
            data:new FormData(this),
            contentType:false,
            processData:false,
            headers:{
                'X-CSRF-TOKEN' :csrftoken,
            },
            type:'POST',
            success:res=>{
                SweetAlert(res)
                RefreshTable('table')
            },
            error:err=>console.log(err)
        })
    })

    $('#modalForm').on('submit', '#update', function(e) {
        e.preventDefault();
        $.ajax({
            url:'/api/v1/pattient/update',
            data:new FormData(this),
            contentType:false,
            processData:false,
            headers:{
                'X-CSRF-TOKEN' :csrftoken,
            },
            type:'POST',
            success:res=>{
                SweetAlert(res)
                RefreshTable('table')
            },
            error:err=>console.log(err)
        })
    })

    $('#table').on('click', '#Hapus', function() {
        let id = $(this).data('id')
        SweetQuestions({
            title : 'Apakah anda yakin?',
            subtitle : 'Apakah anda ingin menghapus data pengguna ini?',
            buttonConfirm : 'Yes',
            buttonDeny: 'No',
            confirm : 'ajax',
            deny : {
                icon:'error',
                title : 'Gagal menghapus'
            },
            ajax : {
                url:'/api/v1/pattient/delete',
                data:{
                    id:id
                },
                headers:{
                    'X-CSRF-TOKEN' :csrftoken,
                },
                type:'DELETE',
                success:res=>{
                    SweetAlert(res)
                    RefreshTable('table')
                },
                error:err=>console.log(err)
            }
        })
    })

    $('#table').on('click', '#Edit', function(e) {
        $.ajax({
            url:'/api/v1/pattient/get/' + $(this).data('id'),
            success:res=>{
                $('#modalForm').modal('show')
                $('#modalForm form').attr('id', 'update')
                $('#modalFormLabel').text('Edit pengguna baru')
                $('#modalForm input[name="username"]').val(res.values.user.name)
                $('#modalForm form').append(`<input type="hidden" name="id" value="${res.values.user.id}">`)
                $('#modalForm input[name="email"]').val(res.values.user.email)
                $('#modalForm input[name="name"]').val(res.values.profile.name)
                $('#modalForm input[name="telepon"]').val(res.values.profile.telepon)
                $('#modalForm input[name="identity"]').val(res.values.profile.identity)
                $('#modalForm input[name="address"]').val(res.values.profile.address)
                $('#modalForm input[name="hospital_sheet"]').val(res.values.profile.hospital_sheet)
                $('#modalForm select[name="provinsi"] option[value="'+res.values.province+'"]').attr('selected', true)
                editArea(res.values.profile.area_code)
            },
            error:err=>console.log(err)
        })
    })

})

function editArea(id) {
    $.ajax({
        url:'/api/v1/area/villages',
        data:{
            id:id,
            parm : 'first'
        },
        success:res=>{
            $('#modalForm select[name="area_code"]').attr('disabled')
            $('#modalForm select[name="area_code"]').html('<option value="'+res.values.id+'" selected> '+res.values.name+'</option>')
            editKecamatan(res.values.district_id)
        },
        error:err=>console.log(err)
    })
}

function editKecamatan(id) {
    $.ajax({
        url:'/api/v1/area/districts',
        data:{
            id:id,
            parm : 'first'
        },
        success:res=>{
            $('#modalForm select[name="kecamatan"]').attr('disabled')
            $('#modalForm select[name="kecamatan"]').html('<option value="'+res.values.id+'" selected> '+res.values.name+'</option>')
            editKota(res.values.regency_id)
        },
        error:err=>console.log(err)
    })
}

function editKota(id) {
    $.ajax({
        url:'/api/v1/area/regencies',
        data:{
            id:id,
            parm : 'first'
        },
        success:res=>{
            $('#modalForm select[name="kota"]').attr('disabled')
            $('#modalForm select[name="kota"]').html('<option value="'+res.values.id+'" selected> '+res.values.name+'</option>')
        },
        error:err=>console.log(err)
    })
}

