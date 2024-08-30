$(document).ready(function() {
    var table = $('#datatable').DataTable({
        serverSide: true,
        ajax: {
            url: baseUrl + 'tasks',
            data: function(d) {
                d.dataValue = 'yes';
                d.start_date = $('#start_date_filter').val();
                d.end_date = $('#end_date_filter').val();
            }
        },
        order: [[0, 'desc']],
        scrollX: true,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'project_manager_id', name: 'project_manager_id' },
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'start_date', name: 'start_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'status', name: 'status' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data) {
                    var editButton = '<a href="' + data.edit + '" class="bg-primary p-1 px-3 text-white">Edit</a>';
                    var viewButton = '<a href="' + data.view + '" class="bg-success p-1 mx-2 px-3 text-white">View</a>';
                    var deleteButton = '<a href="#" data-url="'+data.delete+'" class="cursor-pointer text-white p-1 px-3 mx-2 delete_url bg-danger">Delete</a>';
                    return editButton + viewButton + deleteButton;
                }
            },
        ]
    });

    $('input.change_picker').on('change', function() {
        table.ajax.reload();
    });
});

$(document).on('click', '.delete_url', function(e) {
    e.preventDefault(); 
    if (confirm('Are you sure you want to delete this user?')) {
        CommonAjax($(this).data('url'), 'DELETE', '', '');
    }
});