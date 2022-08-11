@extends('layouts.app')

@section('title')Add Post - Community - {{ config('app.name', 'Touch To Play!') }}@endsection

@section('content')
<div class="min-vh-100">
    <div class="container">
        <div class="row py-3">

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="nav-item dropdown">
                            <a href="#" id="mypostsDropdown" class="nav-link btn btn-secondary dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Posts</a>
                            <div class="dropdown-menu" aria-labelledby="mypostsDropdown">
                                <a href="{{ url('/myposts') }}" class="dropdown-item">My Posts</a>
                                <a href="{{ url('/mycomments') }}" class="dropdown-item">My Comments</a>
                            </div>
                        </div>
                        <a href="{{ url('/community') }}" class="btn btn-secondary">Community Home</a>
                        <a href="{{ url('/community/create') }}" class="btn btn-primary">Add Posts</a>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-2">
                <h3 class="border-bottom text-center">Add Post</h3>
            </div>

            <form action="{{ url('/community') }}" method="POST" class="col-12">
                @csrf

                <div class="row">
    
                    <div class="col-12 mb-3">
                        <div class="w-100 p-3 bg-white border rounded">
    
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="content"><h5>Post</h5></label>
                                <textarea name="description" id="content" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" value="{{ old('description') }}" placeholder="Post Description..."></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection