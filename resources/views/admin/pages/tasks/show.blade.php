@extends('admin.layouts.app')

@section('custom_styles')
    {{ $title = isset($edit) ? '- Edit Task' : '- Add Task' }}
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Task List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show Task -</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Task - {{ $edit->project->name }}</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card p-3">
                        <table class="table">
                            <tr>
                                <td>Project</td>
                                <td>{{ $edit->project->name }}</td>
                            </tr>
                            <tr>
                                <td>Project Manager</td>
                                <td>{{ $manager??'' }}</td>
                            </tr>
                            <tr>
                                <td>Task Description</td>
                                <td>
                                    @php
                                        $description = str_replace('<p>&nbsp;</p>', '', $edit->description ??'');
                                        echo $description;
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td>{{ $edit->start_date }}</td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td>{{ $edit->end_date }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $edit->status }}</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
