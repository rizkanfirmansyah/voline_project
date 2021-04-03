$(document).ready(function() {
    $('#seePassword').on('click', function() {
        SeePassword({idPassword : 'password', idButton : 'seePassword'});
    })

    $('#login').on('submit', function(e) {
        e.preventDefault();
        $.ajax  ({
            url: '/api/v1/auth/login',
            type:'POST',
            data:new FormData(this),
            processData:false,
            contentType:false,
            headers:{
                'X-CSRF-TOKEN':csrftoken
            },
            success:res=>{
                    window.location.href = '/dashboard/index';
            },
            error:err=>{
                $('#Alert').html(`<div class="alert alert-${err.status == 404 ? 'warning' : 'danger'} alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${err.responseJSON.message}.</div>`)
            }
        })
    })
})
