$(document).ready(function() {
    role()

    $('#dataRole').on('click', '.nav-link', function() {
        let html
        $('#dataRole .nav-link').removeClass('active')
        $(this).addClass('active', true)
        let id = $(this).data('value')
        html = `
            <a href="#" class="btn btn-outline-primary text-capitalize" data-value="${id}" id="sectionRole">section</a>
            <a href="#" class="btn btn-outline-primary text-capitalize" data-value="${id}" id="menuRole">menu</a>
            <a href="#" class="btn btn-outline-primary text-capitalize" data-value="${id}" id="submenuRole">submenu</a>
        `;
        $('#btnGroup').html(html)
    })

    $('.btn-group').on('click', ' a.btn', function() {
        let data = $(this).text()
        let id = $(this).data('value')
        $('.btn-group a.btn').removeClass('btn-primary');
        $('.btn-group a.btn').addClass('btn-outline-primary')
        $(this).removeClass('btn-outline-primary')
        $(this).addClass('btn-primary')
        if (id == null) {
            return SweetAlert({status:'info', message :'Please choice role!'});
        }
        createTable({data:data, id:id})
    })

    $('#formTable').on('change', '.input-toggle', function() {
        let type = $(this).data('id')
        let value = $(this).data('value')
        let roleid = $(this).data('role')

        $.ajax({
            data:{
                value:value,
                roleid:roleid,
            },
            url:'/api/v1/access/change/'+type,
            headers:{
                'X-CSRF-TOKEN':csrftoken
            },
            type:'POST',
            success:res=>{
                RefreshTable('table');
                SweetAlert(res);
            },
            error:err=>console.log(err)
        })
    })

})

function role() {
    $.ajax({
        url:'/api/v1/role/all',
        success:res=>{
            let html =' '
            res.data.forEach(response=>{
                html += `<li class="nav-item"><a href="#" class="nav-link" data-value="${response.id}">${response.name}</a></li>`;
            })

            $('#dataRole').html(html)
        }
    });
}

function createTable(param) {
    const data = [
        {data:'DT_RowIndex', name:'DT_RowIndex', orderable:false, searchable:false},
        {data:'name', name:'name', className:'text-capitalize'},
        {data:'access', name:'access', orderable:false},
    ];

    let table = `
    <table class="table table-striped" id="table">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th class="text-capitalize">${param.data}</th>
                <th class="text-capitalize">access</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    `;
    $('#formTable').html(table);
    Table({
        table:'#table',
        data:data,
        url:'/api/v1/access/get/'+param.data,
        parm:{
            id:param.id
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
