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
                    <a href="{{ url('/admin/games/control').'?page='.request('page', '').'&search='.request('search', '') }}" class="btn btn-primary">Exit</a>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="w-100 bg-white rounded p-3">
                    <h5 class="text-center">Games Management</h5>
                    @if (session()->has('message'))
                        <div class="w-100 p-2 bg-success rounded mb-3">
                            <span class="w-100 text-white font-weight-bold">{{ session()->get('message') }}</span>
                        </div>
                    @endif
                    <div class="p-3 border rounded">
                        <form action="{{ url("/admin/games/control/$game->id/edit").'?page='.request('page', '').'&search='.request('search', '') }}" method="POST" class="w-100">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="game_id">ID</label>
                                <input type="text" id="game_id" class="form-control" name="game_id" value="{{ $game->id }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="{{ old('title', $game->title) }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="script">Script</label>
                                <textarea name="script" id="script" rows="20" class="form-control" placeholder="Your Script">{{ old('script', $game->script) }}</textarea>
                                @error('script')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image_url">Image URL</label>
                                <input type="text" id="image_url" class="form-control" name="image_url" value="{{ old('image_url', $game->image_url) }}">
                                @error('image_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="release">Release</label>
                                <select name="release" id="release" class="form-control">
                                    <option value="0" @if ((old('release', $game->release)) == 0) selected @endif>No</option>
                                    <option value="1" @if ((old('release', $game->release)) == 1) selected @endif>Yes</option>
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
                                    <option value="0" @if ((old('status', $game->status)) == 0) selected @endif>Maintenance</option>
                                    <option value="1" @if ((old('status', $game->status)) == 1) selected @endif>On</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created at</label>
                                <input type="text" id="created_at" class="form-control" name="created_at" value="{{ $game->created_at }}" disabled>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                    <div class="p-3 border rounded">
                        <button type="button" id="debug" class="btn btn-danger btn-block">Debugging</button>
                    </div>
                    <div class="p-3 border rounded">
                        <button type="button" id="viewHistory" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">View Debug History</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $game->title }} - Game - Debugging History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="modalcontainer" class="modal-body" style="overflow-y:auto; max-height: 50vh;">
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    </div>
</div>
</div>
<div id="gamecontainer" style="position: absolute; top: 0px; left: 0px; max-width:0px; max-height:0px;"></div>
@endsection

@section('script')
<script>
    function debugIframe(result_id) {
        var debug_url = '{{ url("/admin/games/control") }}/' + result_id + "/edit/debug";
        var IframeHTML = '<iframe id="gameIframe" src="' + debug_url + '" frameborder="0" style="background-color: white;" width="100%" height="100%"></iframe>';
        $("#gamecontainer").html(IframeHTML);
        var elem = document.getElementById('gameIframe');
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        }
        else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        }
        else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
    }
    function copyScript(scriptId) {
        var copy_element = document.getElementById("copy"+scriptId);
        copy_element.select();
        copy_element.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert("Copied!");
    }
    $(document).ready(function() {
        var metaToken = '{{ csrf_token() }}';
        var model_passcode = '{{ (Auth::check() && Auth::user()->is_admin === 1) ? $passcode[0]->passcode : '' }}';
        var model_script = "";
        var model_user = {{ Auth::id() }};
        $("#debug").click(function() {
            model_script = $("#script").val();
            var formDataRequest = {
                _token: metaToken,
                passcode: model_passcode,
                script: model_script,
                user_id: model_user
            };
            if (model_script != "") {
                $.ajax({
                    url: '{{ url("/api/admin/games/control/$game->id/edit/debug") }}',
                    type: "POST",
                    dataType: 'json',
                    contentType: "application/json",
                    data: JSON.stringify(formDataRequest),
                    success: function(results) {
                        debugIframe(results.success.id);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == 400) {
                            alert(JSON.stringify(jqXHR.responseJSON.error));
                        }
                        else if (jqXHR.status == 401) {
                            alert("Unauthorized!");
                        }
                        else {
                            alert("Failed to connect server!");
                        }
                    }
                });
            }
            else {
                alert("Script can not be empty.");
            }
        });
        $("#viewHistory").click(function() {
            $("#modalcontainer").html("o o o");
            var getHistory = {
                _token: metaToken,
                passcode: model_passcode
            };
            $.ajax({
                url: '{{ url("/api/admin/games/control/$game->id/edit/debug/history") }}',
                type: "POST",
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify(getHistory),
                success: function(results) {
                    if (results.length > 0) {
                        var history_html = "";
                        for (var i = 0; i < results.length; i++) {
                            var account_url = '{{ url("/account") }}/';
                            var date = new Date(results[i].created_at);
                            var dateTime = date.getFullYear() + "-" + ("0"+(date.getMonth()+1).toString()).substr(-2) + "-" + ("0"+(date.getDate()).toString()).substr(-2) + " " + ("0"+(date.getHours()).toString()).substr(-2) + ":" + ("0"+(date.getMinutes()).toString()).substr(-2) + ":" + ("0"+(date.getSeconds()).toString()).substr(-2);
                            history_html += '<table class="table border text-center">'+
                                                '<tr>'+
                                                    '<th class="align-middle text-uppercase">ID</th>'+
                                                    '<td class="align-middle">'+results[i].id+'</td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<th class="align-middle text-uppercase">Script</th>'+
                                                    '<textarea style="position: absolute; top: 0px; left: 0px; z-index: -1030; max-width: 0px; max-height:0px" id="copy'+results[i].id+'">'+results[i].script+'</textarea>'+
                                                    '<td class="align-middle"><button class="btn btn-primary" onclick="copyScript('+results[i].id+')">Copy</button></td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<th class="align-middle text-uppercase">User</th>'+
                                                    '<td class="align-middle"><a href="' + account_url + results[i].user_id + '" class="mb-0 text-break" target="_blank">'+results[i].user_name+'</a></td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<th class="align-middle text-uppercase">Time</th>'+
                                                    '<td class="align-middle"><p class="mb-0 text-break">'+dateTime+'</p></td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<th class="align-middle text-uppercase">Debug</th>'+
                                                    '<td class="align-middle"><button class="btn btn-danger" onclick="debugIframe('+results[i].id+')">View</button></td>'+
                                                '</tr>'+
                                            '</table>';
                        }
                        $("#modalcontainer").hide();
                        $("#modalcontainer").html(history_html);
                        $("#modalcontainer").fadeIn(2000);
                    }
                    else {
                        $("#modalcontainer").hide();
                        $("#modalcontainer").html("No record!");
                        $("#modalcontainer").fadeIn(2000);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 401) {
                        $("#modalcontainer").hide();
                        $("#modalcontainer").html("Unauthorized!");
                        $("#modalcontainer").fadeIn(2000);
                    }
                    else {
                        $("#modalcontainer").hide();
                        $("#modalcontainer").html("Failed to connect server!");
                        $("#modalcontainer").fadeIn(2000);
                    }
                }
            });
        });
    });
</script>
@endsection