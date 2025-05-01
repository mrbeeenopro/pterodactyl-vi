@extends('layouts.admin')

@section('title')
    API Ứng Dụng
@endsection

@section('content-header')
    <h1>API Ứng Dụng<small>Quản lý thông tin truy cập để điều khiển Bảng điều khiển này qua API.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Quản trị</a></li>
        <li class="active">API Ứng Dụng</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh Sách Thông Tin Truy Cập</h3>
                    <div class="box-tools">
                        <a href="{{ route('admin.api.new') }}" class="btn btn-sm btn-primary">Tạo Mới</a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Khóa</th>
                            <th>Ghi chú</th>
                            <th>Lần Sử Dụng Cuối</th>
                            <th>Ngày Tạo</th>
                            <th></th>
                        </tr>
                        @foreach($keys as $key)
                            <tr>
                                <td><code>{{ $key->identifier }}{{ decrypt($key->token) }}</code></td>
                                <td>{{ $key->memo }}</td>
                                <td>
                                    @if(!is_null($key->last_used_at))
                                        @datetimeHuman($key->last_used_at)
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td>@datetimeHuman($key->created_at)</td>
                                <td>
                                    <a href="#" data-action="revoke-key" data-attr="{{ $key->identifier }}">
                                        <i class="fa fa-trash-o text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('[data-action="revoke-key"]').click(function (event) {
                var self = $(this);
                event.preventDefault();
                swal({
                    type: 'error',
                    title: 'Thu hồi Khóa API',
                    text: 'Khi khóa API này bị thu hồi, bất kỳ ứng dụng nào đang sử dụng nó sẽ ngừng hoạt động.',
                    showCancelButton: true,
                    allowOutsideClick: true,
                    closeOnConfirm: false,
                    confirmButtonText: 'Thu hồi',
                    confirmButtonColor: '#d9534f',
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        method: 'DELETE',
                        url: '/admin/api/revoke/' + self.data('attr'),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).done(function () {
                        swal({
                            type: 'success',
                            title: '',
                            text: 'Khóa API đã được thu hồi.'
                        });
                        self.parent().parent().slideUp();
                    }).fail(function (jqXHR) {
                        console.error(jqXHR);
                        swal({
                            type: 'error',
                            title: 'Rất tiếc!',
                            text: 'Đã xảy ra lỗi khi cố gắng thu hồi khóa này.'
                        });
                    });
                });
            });
        });
    </script>
@endsection
