$(document).ready(function() {
    $('#seePassword').on('click', function() {
        SeePassword({idPassword : 'password', idButton : 'seePassword'});
    })

    $('#resetPassword').on('submit', function(e) {
        e.preventDefault()
        let checked = $('#agree').prop('checked')
        if (checked == false) {
            $('#Alert').html(` <div class="alert alert-warning alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Please!. Checked <i>I agree with the terms and conditions</i></div></div>`)
            return 0;
        }
        let confirm = ConfirmPassword({idPassword:'password', idConfirmPassword:'password2'});
        if (confirm == 0) {
            $('#Alert').html(` <div class="alert alert-warning alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Password konfirmasi tidak sama, Coba lagi!.</div></div>`)
            return 0;
        }
        let data = new FormData(this)
        data.append('email', $('#resetPassword input[name="email"]').val())
        $.ajax({
            type:'POST',
            url:'/api/v1/auth/resetpassword',
            data:data,
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
