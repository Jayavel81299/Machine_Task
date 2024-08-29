function CommonAjax(url, method, formData, submitBtn){
    $.ajax({
        url: url,
        type: method,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: false,
        processData: false,
        success: function(response) {
            if(response.delete_type){
                $('#datatable').DataTable().ajax.reload();
            }else if(response.task_members){
                var taskMembersSelect = $('#user_ids');
                taskMembersSelect.empty(); 
                taskMembersSelect.append($('<option>', {
                    value: '',
                    text: 'Choose member'
                }));
                
                if (response.task_members && response.task_members.length > 0) {
                    $.each(response.task_members, function(index, member) {
                        taskMembersSelect.append($('<option>', {
                            value: member.id,
                            text: member.name
                        }));
                    });
                } else {
                    taskMembersSelect.append($('<option>', {
                        value: '',
                        text: 'No members found'
                    }));
                }
            }else{
                window.location.href = response.redirectUrl; 
            }
        },
        error: function(xhr) {
            submitBtn.prop('disabled', false);
            if (xhr.status === 422) {
                clrErr();
                var resJSON = xhr.responseJSON;
                $.each(resJSON.errors, function(key, value) {
                    $('#formSubmit #' + key).addClass('is-invalid');
                    $('#formSubmit .' + key + '-error').text(value);
                });
            }
        }
    });
}

function clrErr() {
    $("#formSubmit .form-control, #formSubmit .form-select").removeClass("is-invalid");
    $("#formSubmit .errors_div").text('');
}
