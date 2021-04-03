$(document).ready(function(){
    $('#seePassword').on('click', function() {
        SeePassword({idPassword : 'password', idButton : 'seePassword'});
    })

    $('#register select[name="provinsi"]').on('change', function() {
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
                $('#register select[name="kota"]').html('<option value disabled selected>== Pilih Kota ==</option>'+html)
            },
            error:err=>console.log(err)
        })
    })

    $('#register select[name="kota"]').on('change', function() {
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
                $('#register select[name="kecamatan"]').html('<option value disabled selected>== Pilih Kecamatan ==</option>'+html)
            },
            error:err=>console.log(err)
        })
    })

    $('#register select[name="kecamatan"]').on('change', function() {
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
                $('#register select[name="area_code"]').html('<option value disabled selected>== Pilih Desa/Kelurahan ==</option>'+html)
            },
            error:err=>console.log(err)
        })
    })

    $('#register').on('submit', function(e) {
        e.preventDefault();
        $('#Alert').html(` <div class="alert alert-secondary alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Tunggu! proses ini akan memakan waktu 10 detik.</div></div>`)
        let confirm = ConfirmPassword({idPassword:'password', idConfirmPassword:'password2'});
        if (confirm == 0) {
            $('#Alert').html(` <div class="alert alert-danger alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Password konfirmasi tidak sama, Coba lagi!.</div></div>`)
            return 0;
        }
        $.ajax({
            type:'POST',
            data:new FormData(this),
            url : '/api/v1/auth/register',
            contentType:false,
            processData:false,
            headers:{
                'X-CSRF-TOKEN' : csrftoken,
            },
            success:res=>{
               $('#Alert').html(` <div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>${res.message}.</div></div>`)
            },
            error:err=>{
                $('#Alert').html(` <div class="alert alert-danger alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>${err.responseJSON.message}.</div></div>`)
            }
        })
    })
})
