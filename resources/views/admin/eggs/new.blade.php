@extends('layouts.admin')

@section('title')
    Nests &rarr; Egg Mới
@endsection

@section('content-header')
    <h1>Egg Mới<small>Tạo một Egg mới để gán cho các máy chủ.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Quản trị</a></li>
        <li><a href="{{ route('admin.nests') }}">Nests</a></li>
        <li class="active">Egg Mới</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.nests.egg.new') }}" method="POST">
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
                                <label for="pNestId" class="form-label">Nest Liên kết</label>
                                <div>
                                    <select name="nest_id" id="pNestId">
                                        @foreach($nests as $nest)
                                            <option value="{{ $nest->id }}" {{ old('nest_id') != $nest->id ?: 'selected' }}>{{ $nest->name }} &lt;{{ $nest->author }}&gt;</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted small">Hãy nghĩ về Nest như một danh mục. Bạn có thể đặt nhiều Egg trong một Nest, nhưng hãy cân nhắc chỉ đặt các Egg liên quan đến nhau trong mỗi Nest.</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pName" class="form-label">Tên</label>
                                <input type="text" id="pName" name="name" value="{{ old('name') }}" class="form-control" />
                                <p class="text-muted small">Một tên đơn giản, dễ đọc để sử dụng làm định danh cho Egg này. Đây là những gì người dùng sẽ thấy như loại máy chủ trò chơi của họ.</p>
                            </div>
                            <div class="form-group">
                                <label for="pDescription" class="form-label">Mô tả</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="8">{{ old('description') }}</textarea>
                                <p class="text-muted small">Mô tả về Egg này.</p>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-primary no-margin-bottom">
                                    <input id="pForceOutgoingIp" name="force_outgoing_ip" type="checkbox" value="1" {{ \Pterodactyl\Helpers\Utilities::checked('force_outgoing_ip', 0) }} />
                                    <label for="pForceOutgoingIp" class="strong">Buộc IP Gửi đi</label>
                                    <p class="text-muted small">
                                        Buộc tất cả lưu lượng mạng gửi đi phải có IP nguồn NATed thành IP phân bổ chính của máy chủ.
                                        Cần thiết cho một số trò chơi hoạt động đúng khi Node có nhiều địa chỉ IP công cộng.
                                        <br>
                                        <strong>
                                            Bật tùy chọn này sẽ vô hiệu hóa mạng nội bộ cho bất kỳ máy chủ nào sử dụng Egg này,
                                            khiến chúng không thể truy cập nội bộ vào các máy chủ khác trên cùng một Node.
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pDockerImage" class="control-label">Docker Images</label>
                                <textarea id="pDockerImages" name="docker_images" rows="4" placeholder="quay.io/pterodactyl/service" class="form-control">{{ old('docker_images') }}</textarea>
                                <p class="text-muted small">Các Docker images có sẵn cho các máy chủ sử dụng Egg này. Nhập một dòng cho mỗi image. Người dùng sẽ có thể chọn từ danh sách này nếu có nhiều giá trị được cung cấp.</p>
                            </div>
                            <div class="form-group">
                                <label for="pStartup" class="control-label">Lệnh Khởi động</label>
                                <textarea id="pStartup" name="startup" class="form-control" rows="10">{{ old('startup') }}</textarea>
                                <p class="text-muted small">Lệnh khởi động mặc định nên được sử dụng cho các máy chủ mới được tạo với Egg này. Bạn có thể thay đổi điều này theo từng máy chủ nếu cần.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigFeatures" class="control-label">Tính năng</label>
                                <div>
                                    <select class="form-control" name="features[]" id="pConfigFeatures" multiple>
                                    </select>
                                    <p class="text-muted small">Các tính năng bổ sung thuộc về Egg. Hữu ích để cấu hình các sửa đổi bảng điều khiển bổ sung.</p>
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
                    <h3 class="box-title">Quản lý Quy trình</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="alert alert-warning">
                                <p>Tất cả các trường là bắt buộc trừ khi bạn chọn một tùy chọn khác từ danh sách 'Sao chép Cài đặt từ', trong trường hợp đó các trường có thể để trống để sử dụng các giá trị từ tùy chọn đó.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFrom" class="form-label">Sao chép Cài đặt từ</label>
                                <select name="config_from" id="pConfigFrom" class="form-control">
                                    <option value="">Không có</option>
                                </select>
                                <p class="text-muted small">Nếu bạn muốn mặc định sử dụng cài đặt từ một Egg khác, hãy chọn nó từ danh sách trên.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStop" class="form-label">Lệnh Dừng</label>
                                <input type="text" id="pConfigStop" name="config_stop" class="form-control" value="{{ old('config_stop') }}" />
                                <p class="text-muted small">Lệnh nên được gửi đến các quy trình máy chủ để dừng chúng một cách nhẹ nhàng. Nếu bạn cần gửi một <code>SIGINT</code>, bạn nên nhập <code>^C</code> ở đây.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigLogs" class="form-label">Cấu hình Nhật ký</label>
                                <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" class="form-control" rows="6">{{ old('config_logs') }}</textarea>
                                <p class="text-muted small">Đây nên là một biểu diễn JSON của nơi lưu trữ các tệp nhật ký và liệu daemon có nên tạo nhật ký tùy chỉnh hay không.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFiles" class="form-label">Tệp Cấu hình</label>
                                <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" class="form-control" rows="6">{{ old('config_files') }}</textarea>
                                <p class="text-muted small">Đây nên là một biểu diễn JSON của các tệp cấu hình cần sửa đổi và các phần nào nên được thay đổi.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStartup" class="form-label">Cấu hình Khởi động</label>
                                <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" class="form-control" rows="6">{{ old('config_startup') }}</textarea>
                                <p class="text-muted small">Đây nên là một biểu diễn JSON của các giá trị mà daemon nên tìm kiếm khi khởi động một máy chủ để xác định hoàn thành.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-success btn-sm pull-right">Tạo</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}
    <script>
    $(document).ready(function() {
        $('#pNestId').select2().change();
        $('#pConfigFrom').select2();
    });
    $('#pNestId').on('change', function (event) {
        $('#pConfigFrom').html('<option value="">Không có</option>').select2({
            data: $.map(_.get(Pterodactyl.nests, $(this).val() + '.eggs', []), function (item) {
                return {
                    id: item.id,
                    text: item.name + ' <' + item.author + '>',
                };
            }),
        });
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
