@extends('layouts.app')

@section('title')My Comments - Community - {{ config('app.name', 'Touch To Play!') }}@endsection

@section('content')
<div class="min-vh-100">
    <div class="container">
        <div class="row py-3">

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="nav-item dropdown">
                            <a href="#" id="mypostsDropdown" class="nav-link btn btn-primary dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Comments</a>
                            <div class="dropdown-menu" aria-labelledby="mypostsDropdown">
                                <a href="{{ url('/myposts') }}" class="dropdown-item">My Posts</a>
                                <a href="{{ url('/mycomments') }}" class="dropdown-item">My Comments</a>
                            </div>
                        </div>
                        <a href="{{ url('/community') }}" class="btn btn-secondary">Community Home</a>
                        <a href="{{ url('/community/create') }}" class="btn btn-secondary">Add Posts</a>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    @if ($comments->count() > 0)
                        @foreach ($comments as $comment)
                            <div class="col-12 mb-3">
                                <div class="p-3 bg-white border rounded">
                                    <table class="table border mb-0">
                                        <tr>
                                            <td>
                                                <div class="w-100 border-bottom mb-2">
                                                    <a href="{{ url("/community/$comment->blog_id") }}" class="mb-0 font-weight-bold text-dark text-break">#{{ $comment->blog->id }} {{ $comment->blog->title }}</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="table mb-0 border rounded">
                                                    <tr>
                                                        <td>
                                                            <div class="w-100 border-bottom mb-2">
                                                                <a href="{{ url("/account"."/".$comment->user->id) }}" class="mb-0 font-weight-bold text-break">{{ $comment->user->name }} <span class="text-dark font-italic"><small>(user ID : {{ $comment->user->id }})</small></span></a>
                                                                <p class="mb-0 font-italic text-secondary"><small>{{ $comment->created_at }}</small></p>
                                                            </div>
                                                            <div class="w-100">
                                                                <p class="mb-0 text-break">{{ $comment->comment }}</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="col-12 col-lg-8 p-3 bg-white border rounded">
                                <h4 class="mb-0 text-center">You do no reply any comments yet...</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center">
                    {{ $comments->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')

@endsection