@extends('admin.layouts.app')

@section('custom_styles')
    {{ $title = '- List task' }}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTable/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="mb-3">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="fw-bold">Task List</h4>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('tasks.create') }}"><button class="bg-primary text-white btn">Add New</button></a>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="start_date">Start Date : <input type="date" id="start_date_filter" class="change_picker"></label>
            <label for="start_date">End Date : <input type="date" id="end_date_filter" class="change_picker"></label>
        </div>

        <table id="datatable" class="table key-buttons text-md-nowrap">
            <thead>
                <tr>
                    <th class="border-bottom-0">ID</th>
                    <th class="border-bottom-0">{{ __('Project Manager') }}</th>
                    <th class="border-bottom-0">{{ __('Project Name') }}</th>
                    <th class="border-bottom-0">{{ __('description') }}</th>
                    <th class="border-bottom-0">{{ __('start_date') }}</th>
                    <th class="border-bottom-0">{{ __('end_date') }}</th>
                    <th class="border-bottom-0">{{ __('status') }}</th>
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
    <script src="{{ asset('admin/assets/js/projects/datatable.js') }}"></script>
@endsection
