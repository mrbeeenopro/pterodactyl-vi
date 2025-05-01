@extends('layouts.admin')

@section('title')
    Máy chủ cơ sở dữ liệu &rarr; Xem &rarr; {{ $host->name }}
@endsection

@section('content-header')
    <h1>{{ $host->name }}<small>Xem các cơ sở dữ liệu liên kết và chi tiết cho máy chủ cơ sở dữ liệu này.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Quản trị</a></li>
        <li><a href="{{ route('admin.databases') }}">Máy chủ cơ sở dữ liệu</a></li>
        <li class="active">{{ $host->name }}</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.databases.view', $host->id) }}" method="POST">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chi tiết máy chủ</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Tên</label>
                        <input type="text" id="pName" name="name" class="form-control" value="{{ old('name', $host->name) }}" />
                    </div>
                    <div class="form-group">
                        <label for="pHost" class="form-label">Máy chủ</label>
                        <input type="text" id="pHost" name="host" class="form-control" value="{{ old('host', $host->host) }}" />
                        <p class="text-muted small">Địa chỉ IP hoặc FQDN được sử dụng khi kết nối tới máy chủ MySQL này <em>từ bảng điều khiển</em> để thêm cơ sở dữ liệu mới.</p>
                    </div>
                    <div class="form-group">
                        <label for="pPort" class="form-label">Cổng</label>
                        <input type="text" id="pPort" name="port" class="form-control" value="{{ old('port', $host->port) }}" />
                        <p class="text-muted small">Cổng mà MySQL đang chạy trên máy chủ này.</p>
                    </div>
                    <div class="form-group">
                        <label for="pNodeId" class="form-label">Nút liên kết</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <option value="">Không có</option>
                            @foreach($locations as $location)
                                <optgroup label="{{ $location->short }}">
                                    @foreach($location->nodes as $node)
                                        <option value="{{ $node->id }}" {{ $host->node_id !== $node->id ?: 'selected' }}>{{ $node->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <p class="text-muted small">Cài đặt này chỉ mặc định sử dụng máy chủ cơ sở dữ liệu này khi thêm cơ sở dữ liệu vào máy chủ trên nút đã chọn.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chi tiết người dùng</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pUsername" class="form-label">Tên người dùng</label>
                        <input type="text" name="username" id="pUsername" class="form-control" value="{{ old('username', $host->username) }}" />
                        <p class="text-muted small">Tên người dùng của tài khoản có đủ quyền để tạo người dùng và cơ sở dữ liệu mới trên hệ thống.</p>
                    </div>
                    <div class="form-group">
                        <label for="pPassword" class="form-label">Mật khẩu</label>
                        <input type="password" name="password" id="pPassword" class="form-control" />
                        <p class="text-muted small">Mật khẩu của tài khoản đã định. Để trống để tiếp tục sử dụng mật khẩu đã được gán.</p>
                    </div>
                    <hr />
                    <p class="text-danger small text-left">Tài khoản được định nghĩa cho máy chủ cơ sở dữ liệu này <strong>bắt buộc</strong> phải có quyền <code>WITH GRANT OPTION</code>. Nếu tài khoản không có quyền này, yêu cầu tạo cơ sở dữ liệu <em>sẽ</em> thất bại. <strong>Không sử dụng cùng thông tin tài khoản MySQL đã được định nghĩa cho bảng điều khiển này.</strong></p>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">Lưu</button>
                    <button name="_method" value="DELETE" class="btn btn-sm btn-danger pull-left muted muted-hover"><i class="fa fa-trash-o"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Cơ sở dữ liệu</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Máy chủ</th>
                        <th>Tên cơ sở dữ liệu</th>
                        <th>Tên người dùng</th>
                        <th>Kết nối từ</th>
                        <th>Kết nối tối đa</th>
                        <th></th>
                    </tr>
                    @foreach($databases as $database)
                        <tr>
                            <td class="middle"><a href="{{ route('admin.servers.view', $database->getRelation('server')->id) }}">{{ $database->getRelation('server')->name }}</a></td>
                            <td class="middle">{{ $database->database }}</td>
                            <td class="middle">{{ $database->username }}</td>
                            <td class="middle">{{ $database->remote }}</td>
                            @if($database->max_connections != null)
                                <td class="middle">{{ $database->max_connections }}</td>
                            @else
                                <td class="middle">Không giới hạn</td>
                            @endif
                            <td class="text-center">
                                <a href="{{ route('admin.servers.view.database', $database->getRelation('server')->id) }}">
                                    <button class="btn btn-xs btn-primary">Quản lý</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if($databases->hasPages())
                <div class="box-footer with-border">
                    <div class="col-md-12 text-center">{!! $databases->render() !!}</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('#pNodeId').select2();
    </script>
@endsection
