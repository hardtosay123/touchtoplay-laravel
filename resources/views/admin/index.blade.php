@extends('layouts.app')

@section('title')Admin Management - {{ config('app.name', 'Touch To Play!') }}@endsection

@section('content')
<div class="min-vh-100">
    <div class="container">
        <div class="row py-3">
            <div class="col-12 mb-3">
                <div class="w-100">
                    <h3 class="border-bottom text-center">Admin Management</h3>
                </div>
            </div>
            <div class="col-12">
                <div class="w-100 bg-white rounded p-3">
                    <h5 class="text-center">Dashboard</h5>
                    <table class="table border mb-0">
                        <tr>
                            <th class="align-middle">Games Management</th>
                            <td class="align-middle">
                                <a href="{{ url('/admin/games') }}" class="btn btn-primary">Access</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle">Accounts Management</th>
                            <td class="align-middle">
                                <a href="{{ url('/admin/accounts') }}" class="btn btn-primary">Access</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle">Sites Passcode</th>
                            <td class="align-middle">
                                <a href="{{ url('/admin/passcodes') }}" class="btn btn-primary">Access</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection