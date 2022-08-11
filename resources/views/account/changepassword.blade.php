@extends('layouts.app')

@section('title')Password Change - Account Management - {{ config('app.name', 'Touch To Play!') }}@endsection

@section('content')
<div class="min-vh-100">
    <div class="container">
        <div class="row py-3">
            <div class="col-12 mb-3">
                <div class="w-100">
                    <h3 class="border-bottom text-center">Account Management - Password Change</h3>
                </div>
            </div>
            <div class="col-12">
                <div class="w-100 bg-white rounded p-3">
                    <form action="{{ url('/management/account/passwordchange') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <table class="table border">
                            <tr>
                                <th>Current Password</th>
                                <td>
                                    <div class="w-100">
                                        <div class="form-group">
                                            <input type="password" class="form-control @error('currentpassword') is-invalid @enderror" name="currentpassword">
                                            @error('currentpassword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>New Password</th>
                                <td>
                                    <div class="w-100">
                                        <div class="form-group">
                                            <input type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword">
                                            @error('newpassword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Confirmation Password</th>
                                <td>
                                    <div class="w-100">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="newpassword_confirmation">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="w-100">
                                        <button class="btn btn-primary btn-block">Change Password</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection