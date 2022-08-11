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
                    <table class="table border text-center overflow-auto">
                        <tr>
                            <th class="align-middle">Invitation link :</th>
                            <td class="align-middle">
                                <input type="text" value="{{ url()->route('register')."?passcode=".$passcodes[0]['passcode'] }}" id="inviteLink" class="form-control" readonly>
                            </td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-primary" onclick="copyLinks('inviteLink')">COPY</button>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle">Passcode :</th>
                            <td class="align-middle">
                                <input type="text" value="{{ url('/management/account').'?passcode='.$passcodes[0]['passcode'] }}" id="accessLink" class="form-control" readonly>
                            </td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-primary" onclick="copyLinks('accessLink')">COPY</button>
                            </td>
                        </tr>
                        @if (session()->has('message'))
                            <tr>
                                <td colspan="3">
                                    <div class="w-100 p-2 bg-success rounded">
                                        <span class="w-100 text-white font-weight-bold">{{ session()->get('message') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/admin') }}" class="btn btn-primary">Back</a>
                    <a href="{{ url('/admin/passcodes/edit') }}" class="btn btn-primary">Change</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function copyLinks(id) {
        var copy_element = document.getElementById(id);
        copy_element.select();
        copy_element.setSelectionRange(0, 99999);
        document.execCommand("copy");
    }
</script>
@endsection