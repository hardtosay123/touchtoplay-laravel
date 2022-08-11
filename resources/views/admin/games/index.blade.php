@extends('layouts.app')

@section('title')Games Management - Admin Management - {{ config('app.name', 'Touch To Play!') }}@endsection

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
                <div class="w-100 bg-white rounded p-3">
                    <h5 class="text-center">Games Management Dashboard</h5>
                    <table class="table border mb-0">
                        <tr>
                            <th class="align-middle">Games Control</th>
                            <td class="align-middle">
                                <a href="{{ url('/admin/games/control') }}" class="btn btn-primary">Access</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle">Games Upload</th>
                            <td class="align-middle">
                                <a href="{{ url('/admin/games/upload') }}" class="btn btn-primary">Access</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="col-12 p-2 bg-success rounded mb-3">
                    <span class="w-100 text-white font-weight-bold">{{ session()->get('message') }}</span>
                </div>
            @endif
            <div class="col-12">
                <a href="{{ url('/admin') }}" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection