@extends('layouts.app')

@section('content')
<h2 class="card-title d-none">{{ _lang('Add New') }}</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="post" autocomplete="off" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('First Name') }}</label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Last Name') }}</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Email') }}</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Password') }}</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Confirm Password') }}</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('User Type') }}</label>
                                <select class="form-control select2" name="user_type" data-selected="{{ old('user_type') }}" required>
                                    <option value="">{{ _lang('Select One') }}</option>
                                    <option value="admin">{{ _lang('Admin') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Status') }}</label>
                                <select class="form-control select2" name="status" required>
                                    <option value="1">{{ _lang('Active') }}</option>
                                    <option value="0">{{ _lang('In-Active') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image') }}</label>
                                <input type="file" class="form-control dropify" name="image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger btn-sm">{{ _lang('Reset') }}</button>
                                <button type="submit" class="btn btn-primary btn-sm">{{ _lang('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

