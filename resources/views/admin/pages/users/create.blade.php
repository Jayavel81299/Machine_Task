@extends('admin.layouts.app')

@section('custom_styles')
{{ $title = isset($edit) ? '- Edit User' : '- Add User' }}
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users List</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ isset($edit) ? 'Edit User' : 'Add User' }}</li>
    </ol>
  </nav>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ isset($edit) ? 'Edit User' : 'Add User' }}</h5>
        <form id="formSubmit" action="{{ isset($edit) ? route('users.update', $edit->id) : route('users.store') }}" method="POST">
            @csrf
            @if(isset($edit))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="col-form-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" name="name" data-required="on" id="name" class="form-control" value="{{ $edit->name ?? '' }}" autocomplete="off">
                        <div class="text-danger name-error errors_div"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="col-form-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" name="email" data-required="on" id="email" class="form-control" value="{{ $edit->email ?? '' }}" autocomplete="off">
                        <div class="text-danger email-error errors_div"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="role" class="col-form-label">Role</label>
                    <div class="col-sm-12">
                        <select name="role" id="role" class="form-select" data-required="on">
                            <option value="" disabled {{ $edit->role ?? '' ? '' : 'selected' }}>Choose Role</option>
                            <option value="admin" {{ $edit->role ?? '' == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="project_manager" {{ $edit->role ?? '' == 'project_manager' ? 'selected' : '' }}>Project Manager</option>
                            <option value="team_member" {{ $edit->role ?? '' == 'team_member' ? 'selected' : '' }}>Team Member</option>
                        </select>
                        <div class="text-danger role-error errors_div"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password" class="col-form-label">Password</label>
                    <div class="col-sm-12">
                        <input type="password" name="password" id="password" data-required="{{ isset($edit) ? 'off' : 'on' }}" class="form-control" autocomplete="off">
                        <div class="text-danger password-error errors_div"></div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-secondary mx-3">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ isset($edit) ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admin/assets/js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/basicValidation/index.js') }}"></script>
<script src="{{ asset('admin/assets/js/users/index.js') }}"></script>
@endsection
