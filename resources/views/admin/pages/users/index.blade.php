@extends('admin.layouts.app')

@section('custom_styles')
{{ $title = '- List User' }}
<link rel="stylesheet" href="{{ asset('admin/assets/css/dataTable/jquery.dataTables.min.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="mb-3">
        <div class="row">
            <div class="col-md-8">
                <h4 class="fw-bold">Users List</h4>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('users.create') }}"><button class="bg-primary text-white btn">Add New</button></a>
            </div>
        </div>
    </div>

    <table id="datatable" class="table key-buttons text-md-nowrap">
        <thead>
            <tr>
                <th class="border-bottom-0">ID</th>
                <th class="border-bottom-0">{{ __('Role') }}</th>
                <th class="border-bottom-0">{{ __('Name') }}</th>
                <th class="border-bottom-0">{{ __('Email') }}</th>
                <th class="border-bottom-0">{{ __('Action') }}</th>
            </tr>
        </thead>
    </table>
</div>

@endsection

@section('scripts')
<script src="{{ asset('admin/assets/js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/dataTable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/basicValidation/index.js') }}"></script>
<script src="{{ asset('admin/assets/js/users/datatable.js') }}"></script>
<script>
     $(document).ready(function() {
            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif
        });
</script>
@endsection
