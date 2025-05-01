@extends('layouts.admin')

@section('title')
    Nests &rarr; Egg: {{ $egg->name }}
@endsection

@section('content-header')
    <h1>{{ $egg->name }}<small>{{ str_limit($egg->description, 50) }}</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.nests') }}">Nests</a></li>
        <li><a href="{{ route('admin.nests.view', $egg->nest->id) }}">{{ $egg->nest->name }}</a></li>
        <li class="active">{{ $egg->name }}</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ route('admin.nests.egg.view', $egg->id) }}">Cấu hình</a></li>
                <li><a href="{{ route('admin.nests.egg.variables', $egg->id) }}">Biến</a></li>
                <li><a href="{{ route('admin.nests.egg.scripts', $egg->id) }}">Script cài đặt</a></li>
            </ul>
        </div>
    </div>
</div>
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" enctype="multipart/form-data" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-group no-margin-bottom">
                                <label for="pName" class="control-label">Tệp Egg</label>
                                <div>
                                    <input type="file" name="import_file" class="form-control" style="border: 0;margin-left:-10px;" />
                                    <p class="text-muted small no-margin-bottom">Nếu bạn muốn thay thế các cài đặt cho Egg này bằng cách tải lên một tệp JSON mới, chỉ cần chọn nó ở đây và nhấn "Cập nhật Egg". Thao tác này sẽ không thay đổi bất kỳ chuỗi khởi động hoặc hình ảnh Docker hiện có nào cho các máy chủ hiện có.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            {!! csrf_field() !!}
                            <button type="submit" name="_method" value="PUT" class="btn btn-sm btn-danger pull-right">Cập nhật Egg</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Cấu hình</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pName" class="control-label">Tên <span class="field-required"></span></label>
                                <input type="text" id="pName" name="name" value="{{ $egg->name }}" class="form-control" />
                                <p class="text-muted small">Một tên đơn giản, dễ đọc để sử dụng làm mã định danh cho Egg này.</p>
                            </div>
                            <div class="form-group">
                                <label for="pUuid" class="control-label">UUID</label>
                                <input type="text" id="pUuid" readonly value="{{ $egg->uuid }}" class="form-control" />
                                <p class="text-muted small">Đây là mã định danh duy nhất trên toàn cầu cho Egg này mà Daemon sử dụng làm mã định danh.</p>
                            </div>
                            <div class="form-group">
                                <label for="pAuthor" class="control-label">Tác giả</label>
                                <input type="text" id="pAuthor" readonly value="{{ $egg->author }}" class="form-control" />
                                <p class="text-muted small">Tác giả của phiên bản Egg này. Tải lên cấu hình Egg mới từ một tác giả khác sẽ thay đổi điều này.</p>
                            </div>
                            <div class="form-group">
                                <label for="pDockerImage" class="control-label">Ảnh Docker <span class="field-required"></span></label>
                                <textarea id="pDockerImages" name="docker_images" class="form-control" rows="4">{{ implode(PHP_EOL, $images) }}</textarea>
                                <p class="text-muted small">
                                    Các ảnh docker có sẵn cho các máy chủ sử dụng egg này. Nhập mỗi ảnh trên một dòng. Người dùng
                                    sẽ có thể chọn từ danh sách ảnh này nếu có nhiều hơn một giá trị được cung cấp.
                                    Tùy chọn, có thể cung cấp tên hiển thị bằng cách thêm tiền tố vào ảnh bằng tên
                                    theo sau là một ký tự dấu gạch dọc, sau đó là URL của ảnh. Ví dụ: <code>Display Name|ghcr.io/my/egg</code>
                                </p>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-primary no-margin-bottom">
                                    <input id="pForceOutgoingIp" name="force_outgoing_ip" type="checkbox" value="1" @if($egg->force_outgoing_ip) checked @endif />
                                    <label for="pForceOutgoingIp" class="strong">Buộc IP public</label>
                                    <p class="text-muted small">
                                        Buộc tất cả lưu lượng mạng public phải có IP nguồn được NAT thành IP của IP phân bổ chính của máy chủ.
                                        Bắt buộc để một số trò chơi hoạt động bình thường khi Node có nhiều địa chỉ IP công cộng.
                                        <br>
                                        <strong>
                                            Việc bật tùy chọn này sẽ tắt mạng nội bộ cho bất kỳ máy chủ nào sử dụng egg này,
                                            khiến chúng không thể truy cập nội bộ các máy chủ khác trên cùng một node.
                                        </strong>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pDescription" class="control-label">Mô tả</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="8">{{ $egg->description }}</textarea>
                                <p class="text-muted small">Mô tả về Egg này sẽ được hiển thị trong toàn bộ Panel khi cần.</p>
                            </div>
                            <div class="form-group">
                                <label for="pStartup" class="control-label">Lệnh khởi động <span class="field-required"></span></label>
                                <textarea id="pStartup" name="startup" class="form-control" rows="8">{{ $egg->startup }}</textarea>
                                <p class="text-muted small">Lệnh khởi động mặc định nên được sử dụng cho các máy chủ mới sử dụng Egg này.</p>
                            </div>
                             <div class="form-group">
                                <label for="pConfigFeatures" class="control-label">Tính năng</label>
                                <div>
                                    <select class="form-control" name="features[]" id="pConfigFeatures" multiple>
                                        @foreach(($egg->features ?? []) as $feature)
                                            <option value="{{ $feature }}" selected>{{ $feature }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted small">Các tính năng bổ sung thuộc về egg. Hữu ích cho việc định cấu hình các sửa đổi panel bổ sung.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Quản lý tiến trình</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="alert alert-warning">
                                <p>Không nên chỉnh sửa các tùy chọn cấu hình sau trừ khi bạn hiểu cách hệ thống này hoạt động. Nếu sửa đổi sai, daemon có thể bị hỏng.</p>
                                <p>Tất cả các trường đều bắt buộc trừ khi bạn chọn một tùy chọn riêng biệt từ danh sách thả xuống 'Sao chép cài đặt từ', trong trường hợp đó, các trường có thể để trống để sử dụng các giá trị từ Egg đó.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFrom" class="form-label">Sao chép cài đặt từ</label>
                                <select name="config_from" id="pConfigFrom" class="form-control">
                                    <option value="">Không có</option>
                                    @foreach($egg->nest->eggs as $o)
                                        <option value="{{ $o->id }}" {{ ($egg->config_from !== $o->id) ?: 'selected' }}>{{ $o->name }} &lt;{{ $o->author }}&gt;</option>
                                    @endforeach
                                </select>
                                <p class="text-muted small">Nếu bạn muốn mặc định các cài đặt từ một Egg khác, hãy chọn nó từ menu trên.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStop" class="form-label">Lệnh dừng</label>
                                <input type="text" id="pConfigStop" name="config_stop" class="form-control" value="{{ $egg->config_stop }}" />
                                <p class="text-muted small">Lệnh sẽ được gửi đến các tiến trình máy chủ để dừng chúng một cách duyên dáng. Nếu bạn cần gửi <code>SIGINT</code>, bạn nên nhập <code>^C</code> vào đây.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigLogs" class="form-label">Cấu hình nhật ký</label>
                                <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" class="form-control" rows="6">{{ ! is_null($egg->config_logs) ? json_encode(json_decode($egg->config_logs), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">Đây phải là biểu diễn JSON về nơi lưu trữ các tệp nhật ký và liệu daemon có nên tạo nhật ký tùy chỉnh hay không.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFiles" class="form-label">Tệp cấu hình</label>
                                <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" class="form-control" rows="6">{{ ! is_null($egg->config_files) ? json_encode(json_decode($egg->config_files), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">Đây phải là biểu diễn JSON của các tệp cấu hình cần sửa đổi và những phần nào cần thay đổi.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStartup" class="form-label">Cấu hình khởi động</label>
                                <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" class="form-control" rows="6">{{ ! is_null($egg->config_startup) ? json_encode(json_decode($egg->config_startup), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">Đây phải là biểu diễn JSON về những giá trị mà daemon sẽ tìm kiếm khi khởi động máy chủ để xác định quá trình hoàn thành.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" name="_method" value="PATCH" class="btn btn-primary btn-sm pull-right">Lưu</button>
                    <a href="{{ route('admin.nests.egg.export', $egg->id) }}" class="btn btn-sm btn-info pull-right" style="margin-right:10px;">Xuất</a>
                    <button id="deleteButton" type="submit" name="_method" value="DELETE" class="btn btn-danger btn-sm muted muted-hover">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pConfigFrom').select2();
    $('#deleteButton').on('mouseenter', function (event) {
        $(this).find('i').html(' Xóa Egg');
    }).on('mouseleave', function (event) {
        $(this).find('i').html('');
    });
    $('textarea[data-action="handle-tabs"]').on('keydown', function(event) {
        if (event.keyCode === 9) {
            event.preventDefault();

            var curPos = $(this)[0].selectionStart;
            var prepend = $(this).val().substr(0, curPos);
            var append = $(this).val().substr(curPos);

            $(this).val(prepend + '    ' + append);
        }
    });
     $('#pConfigFeatures').select2({
        tags: true,
        selectOnClose: false,
        tokenSeparators: [',', ' '],
    });
    </script>
@endsection
