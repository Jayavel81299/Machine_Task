@extends('admin.layouts.app')

@section('custom_styles')
    {{ $title = isset($edit) ? '- Edit Task' : '- Add Task' }}
    <!-- select2 MultiSelect -->
    <link href="{{ asset('admin/assets/css/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks List</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ isset($edit) ? 'Edit Task' : 'Add Task' }}</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ isset($edit) ? 'Edit Task' : 'Add Task' }}</h5>
            <form id="formSubmit" action="{{ isset($edit) ? route('tasks.update', $edit->id) : route('tasks.store') }}" method="POST">
                @csrf
                @isset($edit)
                    @method('PUT')
                @endisset
                <div class="row">
                    <!-- Project Name -->
                    <div class="col-md-6">
                        <label for="name" class="col-form-label">Project Name</label>
                        <select name="project_id" id="project_id" class="form-select">
                            <option value="" disabled selected="true">Select Project</option>
                            @foreach ($projects as $item)
                                <option value="{{ $item->id }}" {{ old('name', $edit->name ?? '') === $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger project_id-error errors_div"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="col-form-label">Members</label>
                        <select name="user_ids[]" id="user_ids" class="form-select">
                            <option value="" disabled selected="true">Choose Member</option>
                        </select>
                        <div class="text-danger user_ids-error errors_div"></div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6">
                        <label for="description" class="col-form-label">Description</label>
                        <div class="col-sm-12">
                            <div class="quill-editor-default" id="description">
                                @php
                                    $description = str_replace('<p>&nbsp;</p>', '', $edit->description ??'');
                                    echo $description;
                                @endphp
                            </div>
                        </div>
                        <div class="text-danger description-error errors_div"></div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="col-form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Select Status</option>
                            <option value="pending" {{ old('status', $edit->status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="complete" {{ old('status', $edit->status ?? '') === 'complete' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <div class="text-danger status-error errors_div"></div>
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-6">
                        <label for="start_date" class="col-form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ old('start_date', $edit->start_date ?? '') }}">
                        <div class="text-danger start_date-error errors_div"></div>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6">
                        <label for="end_date" class="col-form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ old('end_date', $edit->end_date ?? '') }}" {{ isset($edit) ? '' : 'disabled' }}>
                        <div class="text-danger end_date-error errors_div"></div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary mx-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">{{ isset($edit) ? 'Update' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/js/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/basicValidation/index.js') }}"></script>
    <script src="{{ asset('admin/assets/js/projects/index.js') }}"></script>
    <script>
        $(function() {
            // Define functions
            function start_date(startDate){
                $('#end_date').prop('disabled', !startDate);
                if (startDate) {    
                    @if(isset($edit))
                        $('#end_date').attr('min', startDate);
                    @else
                        $('#end_date').attr('min', startDate).val('');
                    @endif
                }
            }
    
            function end_date(startDate, endDate){
                if (endDate && endDate < startDate) {
                    alert('End date cannot be earlier than start date.');
                    $('#end_date').val(''); 
                }
            }
    
            // Handle start date change
            $('#start_date').on('change', function() {
                start_date($(this).val());
            });
    
            // Handle end date change
            $('#end_date').on('change', function() {
                end_date($('#start_date').val(), $(this).val());
            });
            // Handle initial setup if editing
            @if(isset($edit))
                start_date($('#start_date').val());  
                end_date($('#start_date').val(), $('#end_date').val());
            @endif
        });

        $(document).on('change', 'select#project_id', function() {
            var formElement = $(this).closest('form')[0]; 
            var formData = new FormData(formElement); 
            formData.append('project_id', $(this).val());
            CommonAjax(baseUrl + 'get-members', "POST", formData, '');
        });

    </script>
    
@endsection
