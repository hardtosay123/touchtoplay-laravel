@extends('layouts.app')

@section('title')Accounts Management - Admin Management - {{ config('app.name', 'Touch To Play!') }}@endsection

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
                    <h5 class="text-center">Account Management</h5>
                    <form action="{{ url('/admin/accounts') }}" method="GET">
                        <div class="form-group">
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="search" id="search" class="form-control" value="{{ request('search', '') }}" placeholder="Search Email..."></td>
                                        <td><button type="submit" class="btn btn-primary btn-block">Search</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <table class="table d-table text-center">
                        <thead>
                            <tr class="d-none d-lg-table-row border border-primary">
                                <th class="align-middle">ID</th>
                                <th class="align-middle">Username</th>
                                <th class="align-middle">Email</th>
                                <th class="align-middle">Create Time</th>
                                <th class="align-middle">Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($accounts->count() > 0)
                                @foreach ($accounts as $account)
                                    <tr class="d-block mb-3 d-lg-table-row mb-lg-0 border border-secondary">
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">ID</span>
                                            <span>{{ $account->id }}</span>
                                        </td>
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">Name</span>
                                            <span>{{ $account->name }}</span>
                                        </td>
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">Email</span>
                                            <span>{{ $account->email }}</span>
                                        </td>
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">Create Time</span>
                                            <span>{{ $account->created_at }}</span>
                                        </td>
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">Admin</span>
                                            <div class="form-group mb-0">
                                                <form action="{{ url('/admin/accounts/'.$account->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="search" value="{{ request('search', '') }}">
                                                    <select name="admin" id="admin" class="form-control" onchange="this.form.submit();">
                                                        <option value="0" @if ($account->is_admin === 0) selected @endif>No</option>
                                                        <option value="1" @if ($account->is_admin === 1) selected @endif>Yes</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="border">
                                    <td class="align-middle" colspan="5"><h5>No records...</h5></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @error('admin')
                        <div class="bg-danger rounded p-3 mb-3">
                            <p class="text-white mb-0">{{ $message }}</p>
                        </div>
                    @enderror
                    <div class="d-flex justify-content-center align-items-center">
                        {{ $accounts->links() }}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/admin') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection