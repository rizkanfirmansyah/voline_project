$(document).ready(function() {

    let id = $('#Redirect').data('toggle')
    if(id == 'redirect'){
        $(document).ready(function() {
            Swal.fire({
                imageUrl: '/assets/img/loading.gif',
                title: 'Sedang mengalihkan',
                text: 'Tolong, isi biodata profile terlebih dahulu!',
                showConfirmButton: false,
                timer: 5000
            }).then((result)=>{
                window.location.href = '/user/profile'
            })
        })

    }

    $('#insert').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            url:'/api/v1/vaccination/refferal/insert',
            data:new FormData(this),
            type:'POST',
            contentType:false,
            processData:false,
            headers:{
                'X-CSRF-TOKEN':csrftoken
            },
            success:res=>{
                SweetAlert(res)
                window.location.href = '/user/refferal_patient/reg'
            },
            error:err=>{
                SweetAlert({message:err.responseJSON.message, status:err.status == 500 ? 'error' : 'warninng'})
            }
        })
    })
})
