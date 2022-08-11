@extends('layouts.app')

@section('title')Account Management - {{ config('app.name', 'Touch To Play!') }}@endsection

@section('content')
<div class="min-vh-100">
    <div class="container">
        <div class="row py-3">
            <div class="col-12 mb-3">
                <div class="w-100">
                    <h3 class="border-bottom text-center">Account Management</h3>
                </div>
            </div>
            <div class="col-12">
                <div class="w-100 bg-white rounded p-3">
                    <table class="table border mb-0">
                        <tr>
                            <th>Account Name</th>
                            <td>
                                <form action="{{ url('/management/account/namechange') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('newname') is-invalid @enderror" name="newname" value="{{ old('newname', $account->name) }}">
                                        @error('newname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Change</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>Account Email</th>
                            <td>
                                <span class="text-break">{{ $account->email }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Account Password</th>
                            <td>
                                <div class="w-100">
                                    <a id="changeinput" href="{{ url("/management/account/passwordchange") }}">Change Password</a>
                                </div>
                            </td>
                        </tr>
                        @if (session()->has('message'))
                            <tr>
                                <td colspan="2">
                                    <div class="w-100 p-2 bg-success rounded">
                                        <span class="w-100 text-white font-weight-bold">{{ session()->get('message') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection