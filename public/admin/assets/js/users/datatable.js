$(document).ready(function() {
    $('#datatable').DataTable({
        serverSide: true,
        ajax: {
            url: baseUrl + 'users',
            data: function(d) {
                d.dataValue = 'yes';
            }
        },
        order: [[0, 'desc']],
        scrollX: true,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'role', name: 'role' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data) {
                    var name = (data.status == 'Active') ? 'bg-success' : 'bg-danger';
                    var editButton = '<a href="' + data.edit + '" class="bg-primary p-1 px-3 text-white">Edit</a>';
                    var deleteButton = '<a href="#" data-url='+data.delete+' class="cursor-pointer text-white p-1 px-3 mx-2 delete_url bg-danger">Delete</a>';
                    return editButton + deleteButton;
                }
            },
        ]
    });
});

$(document).on('click', '.delete_url', function(e) {
    e.preventDefault(); 
    if (confirm('Are you sure you want to delete this user?')) {
        CommonAjax($(this).data('url'), 'DELETE', '', '');
    }
});
