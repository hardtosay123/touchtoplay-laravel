@extends('layouts.app')

@section('title')Community - {{ config('app.name', 'Touch To Play!') }}@endsection

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
                        <a href="{{ url('/community') }}" class="btn btn-primary">Community Home</a>
                        <a href="{{ url('/community/create') }}" class="btn btn-secondary">Add Posts</a>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="col-12 mb-3">
                                <div class="p-3 bg-white border rounded">
                                    <table class="table mb-0 border rounded">
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ url("/account"."/".$post->user->id) }}" class="mb-0 font-weight-bold text-break">{{ $post->user->name }} <span class="text-dark font-italic"><small>(user ID : {{ $post->user->id }})</small></span></a>
                                                    <span class="text-secondary font-italic">
                                                        <small>{{ $post->created_at }}</small>
                                                    </span>
                                                </div>
                                                @if (Auth::check() && ($post->user->id === Auth::id() || Auth::user()->is_admin === 1))
                                                    <div class="d-flex justify-content-end">
                                                        <div>
                                                            <a href="{{ url("/community/$post->id") }}" class="mr-2" onclick="event.preventDefault();
                                                                document.getElementById('deleteForm{{ $post->id }}').submit();">Delete</a>
                                                            <a href="{{ url("/community/$post->id/edit") }}">Edit</a>
                                                            <form id="deleteForm{{ $post->id }}" action="{{ url("/community/$post->id") }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="w-100 border-bottom mb-2">
                                                    <a href="{{ url("/community/$post->id") }}" class="mb-0 font-weight-bold text-dark text-break">#{{ $post->id }} {{ $post->title }}</a>
                                                    @if ($post->updated_at != $post->created_at)
                                                        <span class="text-secondary font-italic"><small>(edited)</small></span>
                                                    @endif
                                                </div>
                                                <div class="w-100">
                                                    <p class="mb-0 text-break">{!! nl2br(e($post->description)) !!}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="table mb-0 border rounded">
                                                    <tbody id="comment-container-{{ $post->id }}">
                                                        @foreach ($post->comments as $comment)
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
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <script>
                                                    $(document).ready(function() {
                                                        setInterval(function() {
                                                            getComment('{{ $post->id }}');
                                                        }, 5000);
                                                    });
                                                </script>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="w-100">
                                                    <form class="row mx-0" action="{{ url("/community/$post->id/reply") }}" method="POST">
                                                        @csrf
                                                        <div class="col-9 px-0 form-group mb-0">
                                                            <input type="text" name="comment" id="comment" class="form-control" placeholder="Leave a comment...">
                                                        </div>
                                                        <button type="submit" class="col-3 px-0 btn btn-primary">Reply</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="col-12 col-lg-8 p-3 bg-white border rounded">
                                <h4 class="mb-0 text-center">No community posts here in a while...</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center">
                    {{ $posts->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function getComment(id) {
        var account_url = '{{ url("/account") }}/';
        $.ajax({
            url: '{{ url("/api/community") }}/'+id+'/getcomments',
            type: "GET",
            dataType: 'json',
            success: function(results) {
                if (results.length > 0) {
                    $("#comment-container-"+id).html("");
                    for (var i = 0; i < results.length; i++) {
                        var commentHTML = "";
                        var date = new Date(results[i].created_at);
                        var dateTime = date.getFullYear() + "-" + ("0"+(date.getMonth()+1).toString()).substr(-2) + "-" + ("0"+(date.getDate()).toString()).substr(-2) + " " + ("0"+(date.getHours()).toString()).substr(-2) + ":" + ("0"+(date.getMinutes()).toString()).substr(-2) + ":" + ("0"+(date.getSeconds()).toString()).substr(-2);
                        commentHTML += '<tr>'+
                                            '<td>'+
                                                '<div class="w-100 border-bottom mb-2">'+
                                                    '<a href="' + account_url + results[i].user_id + '" class="mb-0 font-weight-bold text-break">'+ results[i].user_name +' <span class="text-dark font-italic"><small>(user ID : '+ results[i].user_id +')</small></span></a>'+
                                                    '<p class="mb-0 font-italic text-secondary"><small>'+ dateTime +'</small></p>'+
                                                '</div>'+
                                                '<div class="w-100">'+
                                                    '<p id="comment-'+ id +'-'+ i +'" class="mb-0 text-break"></p>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>';
                        $("#comment-container-"+id).append(commentHTML);
                        $("#comment-"+id+"-"+i).text(results[i].comment);
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            }
        });
    }
</script>
@endsection