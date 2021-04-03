$(document).ready(function() {

    const data = [
        {data:'DT_RowIndex', name:'DT_RowIndex', orderable:false, searchable:false},
        {data:'name', name:'name', className:'text-capitalize'},
        {data:'access', name:'access', orderable:false},
    ];
    Table({data:data, table:'#dataUsers', url:'/api/v1/access/get/users'})

    $('#dataUsers').on('click', '.btn', function() {
        let id = $(this).data('id')
        let value = $(this).data('value')
        $('#dataUsers .btn').removeClass('btn-primary');
        $('#dataUsers .btn').addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary')
        $(this).addClass('btn-primary')

        createTable({id:id, value:value})
    })

    $('#formTable').on('change', '.input-toggle', function() {
        let id = $(this).data('id');
        let value = $(this).data('value');
        let user = $(this).data('user');

        $.ajax({
            url:'/api/v1/access/users/change/'+id,
            type:'POST',
            headers:{
                'X-CSRF-TOKEN':csrftoken
            },
            data:{
                id:user,
                value:value
            },
            success:res=>{
                RefreshTable('table');
                SweetAlert(res)
            },
            error:err=>console.log(err)
        })
    })

})

function createTable(param) {
    let html
    const data = [
        {data:'DT_RowIndex', name:'DT_RowIndex', orderable:false, searchable:false},
        {data:'name', name:'name', className:'text-capitalize'},
        {data:'access', name:'access', orderable:false},
    ];
    html = `
    <table class="table table-striped table-md" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-capitalize">${param.id}</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    `;
    $('#formTable').html(html)
    Table({
        table:'#table',
        data:data,
        url:'/api/v1/access/users/'+param.id,
        parm:{
            id:param.value
        },
        callbackButton:{
            id:'.input-toggle',
            size:'small',
            on:'<i class="fas fa-check"></i> Granted',
            onstyle:'success',
            offstyle:'danger',
            off:'<i class="fas fa-times"></i> Denied',
        }
    });
}
