@extends('layouts.admin')

@section('title')
    Máy chủ — {{ $server->name }}: Quản lý
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Các hành động bổ sung để điều khiển máy chủ này.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Máy chủ</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Quản lý</li>
    </ol>
@endsection

@section('content')
    @include('admin.servers.partials.navigation')
    <div class="row">
        <div class="col-sm-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Cài đặt lại Máy chủ</h3>
                </div>
                <div class="box-body">
                    <p>Hành động này sẽ cài đặt lại máy chủ với các script dịch vụ đã được chỉ định. <strong>Nguy hiểm!</strong> Điều này có thể ghi đè dữ liệu máy chủ.</p>
                </div>
                <div class="box-footer">
                    @if($server->isInstalled())
                        <form action="{{ route('admin.servers.view.manage.reinstall', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">Cài đặt lại Máy chủ</button>
                        </form>
                    @else
                        <button class="btn btn-danger disabled">Máy chủ phải được cài đặt thành công để cài đặt lại</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Trạng thái Cài đặt</h3>
                </div>
                <div class="box-body">
                    <p>Nếu bạn cần thay đổi trạng thái cài đặt từ chưa cài đặt sang đã cài đặt hoặc ngược lại, bạn có thể thực hiện bằng nút bên dưới.</p>
                </div>
                <div class="box-footer">
                    <form action="{{ route('admin.servers.view.manage.toggle', $server->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary">Chuyển đổi Trạng thái Cài đặt</button>
                    </form>
                </div>
            </div>
        </div>

        @if(! $server->isSuspended())
            <div class="col-sm-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tạm ngưng Máy chủ</h3>
                    </div>
                    <div class="box-body">
                        <p>Hành động này sẽ tạm ngưng máy chủ, dừng mọi tiến trình đang chạy và ngay lập tức chặn người dùng truy cập vào các tệp của họ hoặc quản lý máy chủ thông qua panel hoặc API.</p>
                    </div>
                    <div class="box-footer">
                        <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="action" value="suspend" />
                            <button type="submit" class="btn btn-warning @if(! is_null($server->transfer)) disabled @endif">Tạm ngưng Máy chủ</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bỏ tạm ngưng Máy chủ</h3>
                    </div>
                    <div class="box-body">
                        <p>Hành động này sẽ bỏ tạm ngưng máy chủ và khôi phục quyền truy cập bình thường của người dùng.</p>
                    </div>
                    <div class="box-footer">
                        <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="action" value="unsuspend" />
                            <button type="submit" class="btn btn-success">Bỏ tạm ngưng Máy chủ</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if(is_null($server->transfer))
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chuyển Máy chủ</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            Chuyển máy chủ này sang một node khác được kết nối với panel này.
                            <strong>Cảnh báo!</strong> Tính năng này chưa được kiểm tra đầy đủ và có thể có lỗi.
                        </p>
                    </div>

                    <div class="box-footer">
                        @if($canTransfer)
                            <button class="btn btn-success" data-toggle="modal" data-target="#transferServerModal">Chuyển Máy chủ</button>
                        @else
                            <button class="btn btn-success disabled">Chuyển Máy chủ</button>
                            <p style="padding-top: 1rem;">Việc chuyển máy chủ yêu cầu phải có nhiều hơn một node được cấu hình trên panel của bạn.</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chuyển Máy chủ</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            Máy chủ này hiện đang được chuyển sang một node khác.
                            Quá trình chuyển được bắt đầu vào lúc <strong>{{ $server->transfer->created_at }}</strong>
                        </p>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-success disabled">Chuyển Máy chủ</button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="transferServerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.servers.view.manage.transfer', $server->id) }}" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Chuyển Máy chủ</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="pNodeId">Node</label>
                                <select name="node_id" id="pNodeId" class="form-control">
                                    @foreach($locations as $location)
                                        <optgroup label="{{ $location->long }} ({{ $location->short }})">
                                            @foreach($location->nodes as $node)

                                                @if($node->id != $server->node_id)
                                                    <option value="{{ $node->id }}"
                                                            @if($location->id === old('location_id')) selected @endif
                                                    >{{ $node->name }}</option>
                                                @endif

                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <p class="small text-muted no-margin">Node mà máy chủ này sẽ được chuyển đến.</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pAllocation">Allocation Mặc định</label>
                                <select name="allocation_id" id="pAllocation" class="form-control"></select>
                                <p class="small text-muted no-margin">Allocation chính sẽ được gán cho máy chủ này.</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pAllocationAdditional">Allocation Bổ sung</label>
                                <select name="allocation_additional[]" id="pAllocationAdditional" class="form-control" multiple></select>
                                <p class="small text-muted no-margin">Các allocation bổ sung để gán cho máy chủ này khi tạo.</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {!! csrf_field() !!}
                        <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success btn-sm">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}

    @if($canTransfer)
        {!! Theme::js('js/admin/server/transfer.js') !!}
    @endif
@endsection
