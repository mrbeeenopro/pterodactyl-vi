@extends('layouts.admin')

@section('title')
    Máy Chủ Cơ Sở Dữ Liệu
@endsection

@section('content-header')
    <h1>Máy Chủ Cơ Sở Dữ Liệu<small>Các máy chủ cơ sở dữ liệu mà các máy chủ có thể tạo cơ sở dữ liệu trên đó.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Quản Trị</a></li>
        <li class="active">Máy Chủ Cơ Sở Dữ Liệu</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Danh Sách Máy Chủ</h3>
                <div class="box-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newHostModal">Tạo Mới</button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Máy Chủ</th>
                            <th>Cổng</th>
                            <th>Tên Người Dùng</th>
                            <th class="text-center">Cơ Sở Dữ Liệu</th>
                            <th class="text-center">Node</th>
                        </tr>
                        @foreach ($hosts as $host)
                            <tr>
                                <td><code>{{ $host->id }}</code></td>
                                <td><a href="{{ route('admin.databases.view', $host->id) }}">{{ $host->name }}</a></td>
                                <td><code>{{ $host->host }}</code></td>
                                <td><code>{{ $host->port }}</code></td>
                                <td>{{ $host->username }}</td>
                                <td class="text-center">{{ $host->databases_count }}</td>
                                <td class="text-center">
                                    @if(! is_null($host->node))
                                        <a href="{{ route('admin.nodes.view', $host->node->id) }}">{{ $host->node->name }}</a>
                                    @else
                                        <span class="label label-default">Không Có</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newHostModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.databases') }}" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tạo Máy Chủ Cơ Sở Dữ Liệu Mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Tên</label>
                        <input type="text" name="name" id="pName" class="form-control" />
                        <p class="text-muted small">Một định danh ngắn để phân biệt vị trí này với các vị trí khác. Phải từ 1 đến 60 ký tự, ví dụ, <code>us.nyc.lvl3</code>.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pHost" class="form-label">Máy Chủ</label>
                            <input type="text" name="host" id="pHost" class="form-control" />
                            <p class="text-muted small">Địa chỉ IP hoặc FQDN được sử dụng khi kết nối đến máy chủ MySQL này <em>từ bảng điều khiển</em> để thêm cơ sở dữ liệu mới.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPort" class="form-label">Cổng</label>
                            <input type="text" name="port" id="pPort" class="form-control" value="3306"/>
                            <p class="text-muted small">Cổng mà MySQL đang chạy trên máy chủ này.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pUsername" class="form-label">Tên Người Dùng</label>
                            <input type="text" name="username" id="pUsername" class="form-control" />
                            <p class="text-muted small">Tên người dùng của tài khoản có đủ quyền để tạo người dùng và cơ sở dữ liệu mới trên hệ thống.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPassword" class="form-label">Mật Khẩu</label>
                            <input type="password" name="password" id="pPassword" class="form-control" />
                            <p class="text-muted small">Mật khẩu của tài khoản đã định nghĩa.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pNodeId" class="form-label">Node Liên Kết</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <option value="">Không Có</option>
                            @foreach($locations as $location)
                                <optgroup label="{{ $location->short }}">
                                    @foreach($location->nodes as $node)
                                        <option value="{{ $node->id }}">{{ $node->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <p class="text-muted small">Cài đặt này không làm gì khác ngoài việc mặc định sử dụng máy chủ cơ sở dữ liệu này khi thêm cơ sở dữ liệu vào một máy chủ trên node đã chọn.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="text-danger small text-left">Tài khoản được định nghĩa cho máy chủ cơ sở dữ liệu này <strong>phải</strong> có quyền <code>WITH GRANT OPTION</code>. Nếu tài khoản được định nghĩa không có quyền này, các yêu cầu tạo cơ sở dữ liệu <em>sẽ</em> thất bại. <strong>Không sử dụng cùng thông tin tài khoản MySQL mà bạn đã định nghĩa cho bảng điều khiển này.</strong></p>
                    {!! csrf_field() !!}
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success btn-sm">Tạo</button>
                </div>
            </form>
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
