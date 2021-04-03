$(document).ready(function(){
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
                $('#register select[name="kota"]').html('<option value disabled selected>==Pilih Kota==</option>'+html)
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
                $('#register select[name="kecamatan"]').html('<option value disabled selected>==Pilih Kecamatan==</option>'+html)
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
                $('#register select[name="area_code"]').html('<option value disabled selected>==Pilih Desa/Kelurahan==</option>'+html)
            },
            error:err=>console.log(err)
        })
    })


    $('#register').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url:'/api/v1/register/profile',
            type:'POST',
            processData:false,
            contentType:false,
            data:new FormData(this),
            headers:{
                'X-CSRF-TOKEN' : csrftoken
            },
            success:res=>{
                Swal.fire({
                    icon:'success',
                    text:res.message,
                    title:'success'
                }).then((result) =>  {
                    $('.card-body').html('<h1 class="text-center">Anda Telah Terdaftar</h1>')
                })
            },
            error:err=>{
                console.log(err)
            }
        })
    })

})
