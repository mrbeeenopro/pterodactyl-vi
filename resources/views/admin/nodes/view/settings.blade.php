@extends('layouts.admin')

@section('title')
    {{ $node->name }}: Cài đặt
@endsection

@section('content-header')
    <h1>{{ $node->name }}<small>Cấu hình cài đặt node của bạn.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.nodes') }}">Nodes</a></li>
        <li><a href="{{ route('admin.nodes.view', $node->id) }}">{{ $node->name }}</a></li>
        <li class="active">Cài đặt</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="{{ route('admin.nodes.view', $node->id) }}">Thông tin</a></li>
                <li class="active"><a href="{{ route('admin.nodes.view.settings', $node->id) }}">Cài đặt</a></li>
                <li><a href="{{ route('admin.nodes.view.configuration', $node->id) }}">Cấu hình</a></li>
                <li><a href="{{ route('admin.nodes.view.allocation', $node->id) }}">Phân bổ</a></li>
                <li><a href="{{ route('admin.nodes.view.servers', $node->id) }}">Máy chủ</a></li>
            </ul>
        </div>
    </div>
</div>
<form action="{{ route('admin.nodes.view.settings', $node->id) }}" method="POST">
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Cài đặt</h3>
                </div>
                <div class="box-body row">
                    <div class="form-group col-xs-12">
                        <label for="name" class="control-label">Tên Node</label>
                        <div>
                            <input type="text" autocomplete="off" name="name" class="form-control" value="{{ old('name', $node->name) }}" />
                            <p class="text-muted"><small>Giới hạn ký tự: <code>a-zA-Z0-9_.-</code> và <code>[Space]</code> (tối thiểu 1, tối đa 100 ký tự).</small></p>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="description" class="control-label">Mô tả</label>
                        <div>
                            <textarea name="description" id="description" rows="4" class="form-control">{{ $node->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="name" class="control-label">Vị trí</label>
                        <div>
                            <select name="location_id" class="form-control">
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ (old('location_id', $node->location_id) === $location->id) ? 'selected' : '' }}>{{ $location->long }} ({{ $location->short }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="public" class="control-label">Cho phép Phân bổ Tự động <sup><a data-toggle="tooltip" data-placement="top" title="Cho phép phân bổ tự động đến Node này?">?</a></sup></label>
                        <div>
                            <input type="radio" name="public" value="1" {{ (old('public', $node->public)) ? 'checked' : '' }} id="public_1" checked> <label for="public_1" style="padding-left:5px;">Có</label><br />
                            <input type="radio" name="public" value="0" {{ (old('public', $node->public)) ? '' : 'checked' }} id="public_0"> <label for="public_0" style="padding-left:5px;">Không</label>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="fqdn" class="control-label">Tên miền đầy đủ</label>
                        <div>
                            <input type="text" autocomplete="off" name="fqdn" class="form-control" value="{{ old('fqdn', $node->fqdn) }}" />
                        </div>
                        <p class="text-muted"><small>Vui lòng nhập tên miền (ví dụ: <code>node.example.com</code>) sẽ được sử dụng để kết nối với daemon. Địa chỉ IP chỉ có thể được sử dụng nếu bạn không sử dụng SSL cho node này.
                                <a tabindex="0" data-toggle="popover" data-trigger="focus" title="Tại sao tôi cần một FQDN?" data-content="Để bảo mật giao tiếp giữa máy chủ của bạn và node này, chúng tôi sử dụng SSL. Chúng tôi không thể tạo chứng chỉ SSL cho Địa chỉ IP và do đó bạn sẽ cần cung cấp FQDN.">Tại sao?</a>
                            </small></p>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="form-label"><span class="label label-warning"><i class="fa fa-power-off"></i></span> Giao tiếp qua SSL</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pSSLTrue" value="https" name="scheme" {{ (old('scheme', $node->scheme) === 'https') ? 'checked' : '' }}>
                                <label for="pSSLTrue"> Sử dụng kết nối SSL</label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pSSLFalse" value="http" name="scheme" {{ (old('scheme', $node->scheme) !== 'https') ? 'checked' : '' }}>
                                <label for="pSSLFalse"> Sử dụng kết nối HTTP</label>
                            </div>
                        </div>
                        <p class="text-muted small">Trong hầu hết các trường hợp, bạn nên chọn sử dụng kết nối SSL. Nếu sử dụng Địa chỉ IP hoặc bạn không muốn sử dụng SSL, hãy chọn kết nối HTTP.</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="form-label"><span class="label label-warning"><i class="fa fa-power-off"></i></span> Ẩn sau Proxy</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pProxyFalse" value="0" name="behind_proxy" {{ (old('behind_proxy', $node->behind_proxy) == false) ? 'checked' : '' }}>
                                <label for="pProxyFalse"> Không ẩn sau Proxy </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="pProxyTrue" value="1" name="behind_proxy" {{ (old('behind_proxy', $node->behind_proxy) == true) ? 'checked' : '' }}>
                                <label for="pProxyTrue"> Ẩn sau Proxy </label>
                            </div>
                        </div>
                        <p class="text-muted small">Nếu bạn đang chạy daemon phía sau proxy như Cloudflare, hãy chọn tùy chọn này để daemon bỏ qua việc tìm kiếm chứng chỉ khi khởi động.</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="form-label"><span class="label label-warning"><i class="fa fa-wrench"></i></span> Chế độ Bảo trì</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pMaintenanceFalse" value="0" name="maintenance_mode" {{ (old('maintenance_mode', $node->maintenance_mode) == false) ? 'checked' : '' }}>
                                <label for="pMaintenanceFalse"> Tắt</label>
                            </div>
                            <div class="radio radio-warning radio-inline">
                                <input type="radio" id="pMaintenanceTrue" value="1" name="maintenance_mode" {{ (old('maintenance_mode', $node->maintenance_mode) == true) ? 'checked' : '' }}>
                                <label for="pMaintenanceTrue"> Bật</label>
                            </div>
                        </div>
                        <p class="text-muted small">Nếu node được đánh dấu là 'Đang bảo trì', người dùng sẽ không thể truy cập các máy chủ trên node này.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Giới hạn Phân bổ</h3>
                </div>
                <div class="box-body row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="memory" class="control-label">Tổng Bộ nhớ</label>
                                <div class="input-group">
                                    <input type="text" name="memory" class="form-control" data-multiplicator="true" value="{{ old('memory', $node->memory) }}"/>
                                    <span class="input-group-addon">MiB</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="memory_overallocate" class="control-label">Cấp phát vượt mức</label>
                                <div class="input-group">
                                    <input type="text" name="memory_overallocate" class="form-control" value="{{ old('memory_overallocate', $node->memory_overallocate) }}"/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted small">Nhập tổng dung lượng bộ nhớ khả dụng trên node này để phân bổ cho máy chủ. Bạn cũng có thể cung cấp một tỷ lệ phần trăm cho phép phân bổ nhiều hơn bộ nhớ đã xác định.</p>
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="disk" class="control-label">Dung lượng Ổ đĩa</label>
                                <div class="input-group">
                                    <input type="text" name="disk" class="form-control" data-multiplicator="true" value="{{ old('disk', $node->disk) }}"/>
                                    <span class="input-group-addon">MiB</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="disk_overallocate" class="control-label">Cấp phát vượt mức</label>
                                <div class="input-group">
                                    <input type="text" name="disk_overallocate" class="form-control" value="{{ old('disk_overallocate', $node->disk_overallocate) }}"/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted small">Nhập tổng dung lượng ổ đĩa khả dụng trên node này để phân bổ cho máy chủ. Bạn cũng có thể cung cấp một tỷ lệ phần trăm xác định dung lượng ổ đĩa vượt quá giới hạn đã đặt.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Cấu hình Chung</h3>
                </div>
                <div class="box-body row">
                    <div class="form-group col-xs-12">
                        <label for="disk_overallocate" class="control-label">Kích thước Tải lên Tối đa trên Web</label>
                        <div class="input-group">
                            <input type="text" name="upload_size" class="form-control" value="{{ old('upload_size', $node->upload_size) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted"><small>Nhập kích thước tối đa của các tệp có thể được tải lên thông qua trình quản lý tệp dựa trên web.</small></p>
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="daemonListen" class="control-label"><span class="label label-warning"><i class="fa fa-power-off"></i></span> Cổng Daemon</label>
                                <div>
                                    <input type="text" name="daemonListen" class="form-control" value="{{ old('daemonListen', $node->daemonListen) }}"/>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="daemonSFTP" class="control-label"><span class="label label-warning"><i class="fa fa-power-off"></i></span> Cổng Daemon SFTP</label>
                                <div>
                                    <input type="text" name="daemonSFTP" class="form-control" value="{{ old('daemonSFTP', $node->daemonSFTP) }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted"><small>Daemon chạy container quản lý SFTP riêng và không sử dụng quy trình SSHd trên máy chủ vật lý chính. <Strong>Không sử dụng cùng một cổng mà bạn đã gán cho quy trình SSH của máy chủ vật lý của bạn.</strong></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lưu Cài đặt</h3>
                </div>
                <div class="box-body row">
                    <div class="form-group col-sm-6">
                        <div>
                            <input type="checkbox" name="reset_secret" id="reset_secret" /> <label for="reset_secret" class="control-label">Đặt lại Khóa Chính của Daemon</label>
                        </div>
                        <p class="text-muted"><small>Việc đặt lại khóa chính của daemon sẽ làm mất hiệu lực mọi yêu cầu đến từ khóa cũ. Khóa này được sử dụng cho tất cả các hoạt động nhạy cảm trên daemon bao gồm tạo và xóa máy chủ. Chúng tôi khuyên bạn nên thay đổi khóa này thường xuyên để bảo mật.</small></p>
                    </div>
                </div>
                <div class="box-footer">
                    {!! method_field('PATCH') !!}
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary pull-right">Lưu Thay đổi</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('[data-toggle="popover"]').popover({
        placement: 'auto'
    });
    $('select[name="location_id"]').select2();
    </script>
@endsection
