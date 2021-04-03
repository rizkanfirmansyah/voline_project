$(document).ready(function() {
    const data = [
        {data:'no_reg', name:'no_reg'},
        {data:'name', name:'name'},
        {data:'address', name:'address'},
        {data:'hospital', name:'hospital'},
        {data:'vaccination', name:'vaccination'},
        {data:'status', name:'status'},
        {data:'step', name:'step'},
        {data:'btn', name:'btn'},
    ];
    Table({table:'table', data:data, url:'/api/v1/refferal/get'})

    $('#table').on('click', '#Konfirmasi', function() {
        let id = $(this).data('id')
        Swal.fire({
            imageUrl: '/assets/img/loading.gif',
            title: 'Tunggu data sedang di proses!',
            showConfirmButton: false,
            timer: 8000
          })
        $.ajax({
            url:'/api/v1/refferal/confirm',
            data:{
                id:id
            },
            success:res=>{
                RefreshTable('table')
                SweetAlert(res)
            },
            error:err=>{
                SweetAlert({status:'error', message:err.responseJSON.message})
            }
        })
    })

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
                window.location.href = '/dashboard/pattient'
            },
            error:err=>{
                SweetAlert({message:err.responseJSON.message, status:err.status == 500 ? 'error' : 'warninng'})
            }
        })
    })

    $('#message').on('submit', function(e) {
        e.preventDefault()
        Swal.fire({
            imageUrl: '/assets/img/loading.gif',
            title: 'Tunggu data sedang di proses!',
            showConfirmButton: false,
            timer: 10000
          }).then((result)=>{
              $('#modalMessage').modal('hide')
          })
        $.ajax({
            url:'/api/v1/vaccination/refferal/message',
            data:new FormData(this),
            type:'POST',
            contentType:false,
            processData:false,
            headers:{
                'X-CSRF-TOKEN':csrftoken
            },
            success:res=>{
                // SweetAlert(res)
                RefreshTable('table')
            },
            error:err=>{
                SweetAlert({message:err.responseJSON.message, status:err.status == 500 ? 'error' : 'warninng'})
            }
        })

    })
})
