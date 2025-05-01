@extends('layouts.admin')

@section('title')
    Máy chủ — {{ $server->name }}: Cơ sở dữ liệu
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Quản lý cơ sở dữ liệu máy chủ.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Máy chủ</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Cơ sở dữ liệu</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <div class="col-sm-7">
        <div class="alert alert-info">
            Mật khẩu cơ sở dữ liệu có thể được xem khi <a href="/server/{{ $server->uuidShort }}/databases">truy cập máy chủ này</a> ở giao diện người dùng.
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Cơ sở dữ liệu đang hoạt động</h3>
            </div>
            <div class="box-body table-responsible no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Cơ sở dữ liệu</th>
                        <th>Tên người dùng</th>
                        <th>Kết nối từ</th>
                        <th>Máy chủ</th>
                        <th>Số lượng kết nối tối đa</th>
                        <th></th>
                    </tr>
                    @foreach($server->databases as $database)
                        <tr>
                            <td>{{ $database->database }}</td>
                            <td>{{ $database->username }}</td>
                            <td>{{ $database->remote }}</td>
                            <td><code>{{ $database->host->host }}:{{ $database->host->port }}</code></td>
                            @if($database->max_connections != null)
                                <td>{{ $database->max_connections }}</td>
                            @else
                                <td>Không giới hạn</td>
                            @endif
                            <td class="text-center">
                                <button data-action="reset-password" data-id="{{ $database->id }}" class="btn btn-xs btn-primary"><i class="fa fa-refresh"></i></button>
                                <button data-action="remove" data-id="{{ $database->id }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Tạo cơ sở dữ liệu mới</h3>
            </div>
            <form action="{{ route('admin.servers.view.database', $server->id) }}" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="pDatabaseHostId" class="control-label">Máy chủ cơ sở dữ liệu</label>
                        <select id="pDatabaseHostId" name="database_host_id" class="form-control">
                            @foreach($hosts as $host)
                                <option value="{{ $host->id }}">{{ $host->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-muted small">Chọn máy chủ cơ sở dữ liệu mà cơ sở dữ liệu này sẽ được tạo trên đó.</p>
                    </div>
                    <div class="form-group">
                        <label for="pDatabaseName" class="control-label">Cơ sở dữ liệu</label>
                        <div class="input-group">
                            <span class="input-group-addon">s{{ $server->id }}_</span>
                            <input id="pDatabaseName" type="text" name="database" class="form-control" placeholder="database" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pRemote" class="control-label">Kết nối</label>
                        <input id="pRemote" type="text" name="remote" class="form-control" value="%" />
                        <p class="text-muted small">Địa chỉ IP mà kết nối được phép từ đó. Sử dụng ký hiệu MySQL tiêu chuẩn. Nếu không chắc chắn, hãy để là <code>%</code>.</p>
                    </div>
                    <div class="form-group">
                        <label for="pmax_connections" class="control-label">Kết nối đồng thời</label>
                        <input id="pmax_connections" type="text" name="max_connections" class="form-control"/>
                        <p class="text-muted small">Số lượng kết nối đồng thời tối đa từ người dùng này đến cơ sở dữ liệu. Để trống để không giới hạn.</p>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <p class="text-muted small no-margin">Tên người dùng và mật khẩu cho cơ sở dữ liệu này sẽ được tạo ngẫu nhiên sau khi gửi biểu mẫu.</p>
                    <input type="submit" class="btn btn-sm btn-success pull-right" value="Tạo cơ sở dữ liệu" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pDatabaseHost').select2();
    $('[data-action="remove"]').click(function (event) {
        event.preventDefault();
        var self = $(this);
        swal({
            title: '',
            type: 'warning',
            text: 'Bạn có chắc chắn muốn xóa cơ sở dữ liệu này không? Không có đường quay lại, tất cả dữ liệu sẽ bị xóa ngay lập tức.',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                method: 'DELETE',
                url: '/admin/servers/view/{{ $server->id }}/database/' + self.data('id') + '/delete',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            }).done(function () {
                self.parent().parent().slideUp();
                swal.close();
            }).fail(function (jqXHR) {
                console.error(jqXHR);
                swal({
                    type: 'error',
                    title: 'Ối!',
                    text: (typeof jqXHR.responseJSON.error !== 'undefined') ? jqXHR.responseJSON.error : 'Đã xảy ra lỗi khi xử lý yêu cầu này.'
                });
            });
        });
    });
    $('[data-action="reset-password"]').click(function (e) {
        e.preventDefault();
        var block = $(this);
        $(this).addClass('disabled').find('i').addClass('fa-spin');
        $.ajax({
            type: 'PATCH',
            url: '/admin/servers/view/{{ $server->id }}/database',
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            data: { database: $(this).data('id') },
        }).done(function (data) {
            swal({
                type: 'success',
                title: '',
                text: 'Mật khẩu cho cơ sở dữ liệu này đã được đặt lại.',
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error(jqXHR);
            var error = 'Đã xảy ra lỗi khi cố gắng xử lý yêu cầu này.';
            if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                error = jqXHR.responseJSON.error;
            }
            swal({
                type: 'error',
                title: 'Ối!',
                text: error
            });
        }).always(function () {
            block.removeClass('disabled').find('i').removeClass('fa-spin');
        });
    });
    </script>
@endsection
