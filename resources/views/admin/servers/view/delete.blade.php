@extends('layouts.admin')

@section('title')
    Máy chủ — {{ $server->name }}: Xóa
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Xóa máy chủ này khỏi panel.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Máy chủ</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Xóa</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Xóa Máy Chủ An Toàn</h3>
            </div>
            <div class="box-body">
                <p>Hành động này sẽ cố gắng xóa máy chủ khỏi cả panel và daemon. Nếu một trong hai báo cáo lỗi, hành động sẽ bị hủy.</p>
                <p class="text-danger small">Xóa một máy chủ là một hành động không thể đảo ngược. <strong>Tất cả dữ liệu máy chủ</strong> (bao gồm các tập tin và người dùng) sẽ bị xóa khỏi hệ thống.</p>
            </div>
            <div class="box-footer">
                <form id="deleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button id="deletebtn" class="btn btn-danger">Xóa Máy Chủ Này An Toàn</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Buộc Xóa Máy Chủ</h3>
            </div>
            <div class="box-body">
                <p>Hành động này sẽ cố gắng xóa máy chủ khỏi cả panel và daemon. Nếu daemon không phản hồi hoặc báo cáo lỗi, việc xóa sẽ tiếp tục.</p>
                <p class="text-danger small">Xóa một máy chủ là một hành động không thể đảo ngược. <strong>Tất cả dữ liệu máy chủ</strong> (bao gồm các tập tin và người dùng) sẽ bị xóa khỏi hệ thống. Phương pháp này có thể để lại các tập tin lủng lẳng trên daemon của bạn nếu nó báo cáo lỗi.</p>
            </div>
            <div class="box-footer">
                <form id="forcedeleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="force_delete" value="1" />
                    <button id="forcedeletebtn"" class="btn btn-danger">Buộc Xóa Máy Chủ Này</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#deletebtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '',
            type: 'warning',
            text: 'Bạn có chắc chắn muốn xóa máy chủ này không? Không có đường quay lại, tất cả dữ liệu sẽ bị xóa ngay lập tức.',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false
        }, function () {
            $('#deleteform').submit()
        });
    });

    $('#forcedeletebtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '',
            type: 'warning',
            text: 'Bạn có chắc chắn muốn xóa máy chủ này không? Không có đường quay lại, tất cả dữ liệu sẽ bị xóa ngay lập tức.',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false
        }, function () {
            $('#forcedeleteform').submit()
        });
    });
    </script>
@endsection
