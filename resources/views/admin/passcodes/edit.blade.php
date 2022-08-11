@extends('layouts.app')

@section('title')Passcode Management - Admin Management - {{ config('app.name', 'Touch To Play!') }}@endsection

@section('content')
<div class="min-vh-100">
    <div class="container">
        <div class="row py-3">
            <div class="col-12 mb-3">
                <div class="w-100">
                    <h3 class="border-bottom text-center">Admin Management</h3>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="w-100 bg-white rounded p-3 overflow-auto">
                    <h5 class="text-center">Passcode Management</h5>
                    <form action="{{ url('/admin/passcodes/edit') }}" method="POST" id="passcodeForm">
                        @csrf
                        @method('PUT')
                        <label for="passcode" class="h5">Change Passcode To:</label>
                        <input type="text" class="form-control @error('passcode') is-invalid @enderror" name="passcode" value="{{ old('passcode', $passcodes[0]['passcode']) }}">
                        @error('passcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </form>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/admin/passcodes') }}" class="btn btn-primary">Back</a>
                    <a href="{{ url('/admin/passcodes/edit') }}" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('passcodeForm').submit();">Submit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection