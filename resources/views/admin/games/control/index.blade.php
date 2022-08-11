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
                    <h5 class="text-center">Games Management</h5>
                    <form action="{{ url('/admin/games/control') }}" method="GET">
                        <div class="form-group">
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="search" id="search" class="form-control" value="{{ request('search', '') }}" placeholder="Search Game..."></td>
                                        <td><button type="submit" class="btn btn-primary btn-block">Search</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <table class="table d-table text-center mb-3">
                        <thead>
                            <tr class="d-none d-lg-table-row border border-primary">
                                <th class="align-middle">ID</th>
                                <th class="align-middle">Title</th>
                                <th class="align-middle">Release</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($games->count() > 0)
                                @foreach ($games as $game)
                                    <tr class="d-block mb-3 d-lg-table-row mb-lg-0 border border-secondary">
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">ID</span>
                                            <span>{{ $game->id }}</span>
                                        </td>
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">Title</span>
                                            <span>{{ $game->title }}</span>
                                        </td>
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">Release</span>
                                            <div class="form-group mb-0">
                                                <form action="{{ url('/admin/games/control/'.$game->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="search" value="{{ request('search', '') }}">
                                                    <input type="hidden" name="page" value="{{ request('page', '') }}">
                                                    <select name="release" id="release" class="form-control" onchange="this.form.submit();">
                                                        <option value="0" @if ($game->release === 0) selected @endif>No</option>
                                                        <option value="1" @if ($game->release === 1) selected @endif>Yes</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">Status</span>
                                            <div class="form-group mb-0">
                                                <form action="{{ url('/admin/games/control/'.$game->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="search" value="{{ request('search', '') }}">
                                                    <input type="hidden" name="page" value="{{ request('page', '') }}">
                                                    <select name="status" id="status" class="form-control" onchange="this.form.submit();">
                                                        <option value="0" @if ($game->status === 0) selected @endif>Maintenance</option>
                                                        <option value="1" @if ($game->status === 1) selected @endif>On</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="d-flex justify-content-between d-lg-table-cell align-middle">
                                            <span class="font-weight-bold d-block d-lg-none text-uppercase">Action</span>
                                            <div class="form-group mb-0">
                                                <a href="{{ url("/admin/games/control/$game->id/edit").'?page='.request('page', '').'&search='.request('search', '') }}" class="btn btn-primary">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="border">
                                    <td class="align-middle" colspan="5"><h5>No records...</h5></td>
                                </tr>
                            @endif
                            @if (session()->has('message'))
                                @foreach (session()->get('message') as $message)
                                    <tr>
                                        <td colspan="5">
                                            <div class="w-100 p-2 bg-success rounded">
                                                <span class="w-100 text-white font-weight-bold">{{ $message }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @error('release')
                        <div class="bg-danger rounded p-3 mb-3">
                            <p class="text-white mb-0">{{ $message }}</p>
                        </div>
                    @enderror
                    @error('status')
                        <div class="bg-danger rounded p-3 mb-3">
                            <p class="text-white mb-0">{{ $message }}</p>
                        </div>
                    @enderror
                    <div class="d-flex justify-content-center align-items-center">
                        {{ $games->links() }}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/admin/games') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("a.page-link").each(function() {
            var page_link = $(this).attr("href");
            page_link += "&search="+"{{ request('search', '') }}";
            $(this).attr("href", page_link);
        });
    });
</script>
@endsection