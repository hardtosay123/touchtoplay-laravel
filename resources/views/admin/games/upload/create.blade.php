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
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/admin/games') }}" class="btn btn-primary">Exit</a>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="w-100 bg-white rounded p-3">
                    <h5 class="text-center">Games Management</h5>
                    <div class="p-3 border rounded">
                        <form action="{{ url('admin/games/upload') }}" method="POST" class="w-100">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}" placeholder="Game Title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="script">Script</label>
                                <textarea name="script" id="script" rows="20" class="form-control" placeholder="Game Script">{{ old('script') }}</textarea>
                                @error('script')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image_url">Image URL</label>
                                <input type="text" id="image_url" class="form-control" name="image_url" value="{{ old('image_url') }}" placeholder="Image's URL">
                                @error('image_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="release">Release</label>
                                <select name="release" id="release" class="form-control">
                                    <option value="0" @if (old('release', '') === '0') selected @endif>No</option>
                                    <option value="1" @if (old('release', '') === '1') selected @endif>Yes</option>
                                </select>
                                @error('release')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" @if (old('status', '') === '0') selected @endif>Maintenance</option>
                                    <option value="1" @if (old('status', '') === '1') selected @endif>On</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection