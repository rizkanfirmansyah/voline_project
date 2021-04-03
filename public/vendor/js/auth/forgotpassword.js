$(document).ready(function() {
    $('#forgotPassword').on('submit', function(e) {
        e.preventDefault()
        $('#Alert').html(` <div class="alert alert-secondary alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Tunggu! proses ini akan memakan waktu 10 detik.</div></div>`)
        $.ajax({
            type:'POST',
            url:'/api/v1/auth/forgotpassword',
            data:new FormData(this),
            contentType:false,
            processData:false,
            headers:{
                'X-CSRF-TOKEN':csrftoken
            },
            success:res=>{
                $('#Alert').html(` <div class="alert alert-${res.status} alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>${res.message}.</div></div>`)
            },
            error:err=>{
                $('#Alert').html(` <div class="alert alert-danger alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>${err.responseJSON.message}.</div></div>`)
            }
        })
    })
})
