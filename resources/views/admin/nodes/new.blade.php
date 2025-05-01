@extends('layouts.admin')

@section('title')
    Nodes &rarr; Mới
@endsection

@section('content-header')
    <h1>Node Mới<small>Tạo một node cục bộ hoặc từ xa mới để cài đặt máy chủ.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.nodes') }}">Nodes</a></li>
        <li class="active">Mới</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.nodes.new') }}" method="POST">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chi tiết cơ bản</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Tên</label>
                        <input type="text" name="name" id="pName" class="form-control" value="{{ old('name') }}"/>
                        <p class="text-muted small">Giới hạn ký tự: <code>a-zA-Z0-9_.-</code> và <code>[Space]</code> (tối thiểu 1, tối đa 100 ký tự).</p>
                    </div>
                    <div class="form-group">
                        <label for="pDescription" class="form-label">Mô tả</label>
                        <textarea name="description" id="pDescription" rows="4" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="pLocationId" class="form-label">Vị trí</label>
                        <select name="location_id" id="pLocationId">
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $location->id != old('location_id') ?: 'selected' }}>{{ $location->short }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Khả năng hiển thị của Node</label>
                        <div>
                            <div class="radio radio-success radio-inline">

                                <input type="radio" id="pPublicTrue" value="1" name="public" checked>
                                <label for="pPublicTrue"> Công khai </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pPublicFalse" value="0" name="public">
                                <label for="pPublicFalse"> Riêng tư </label>
                            </div>
                        </div>
                        <p class="text-muted small">Bằng cách đặt một node thành <code>riêng tư</code>, bạn sẽ từ chối khả năng tự động triển khai đến node này.
                    </div>
                    <div class="form-group">
                        <label for="pFQDN" class="form-label">FQDN</label>
                        <input type="text" name="fqdn" id="pFQDN" class="form-control" value="{{ old('fqdn') }}"/>
                        <p class="text-muted small">Vui lòng nhập tên miền (ví dụ: <code>node.example.com</code>) sẽ được sử dụng để kết nối với daemon. Địa chỉ IP có thể được sử dụng <em>chỉ</em> khi bạn không sử dụng SSL cho node này.</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Giao tiếp qua SSL</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pSSLTrue" value="https" name="scheme" checked>
                                <label for="pSSLTrue"> Sử dụng kết nối SSL</label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pSSLFalse" value="http" name="scheme" @if(request()->isSecure()) disabled @endif>
                                <label for="pSSLFalse"> Sử dụng kết nối HTTP</label>
                            </div>
                        </div>
                        @if(request()->isSecure())
                            <p class="text-danger small">Panel của bạn hiện được định cấu hình để sử dụng kết nối an toàn. Để trình duyệt kết nối với node của bạn, nó <strong>phải</strong> sử dụng kết nối SSL.</p>
                        @else
                            <p class="text-muted small">Trong hầu hết các trường hợp, bạn nên chọn sử dụng kết nối SSL. Nếu sử dụng Địa chỉ IP hoặc bạn không muốn sử dụng SSL, hãy chọn kết nối HTTP.</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ẩn sau Proxy</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pProxyFalse" value="0" name="behind_proxy" checked>
                                <label for="pProxyFalse"> Không ẩn sau Proxy </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="pProxyTrue" value="1" name="behind_proxy">
                                <label for="pProxyTrue"> Ẩn sau Proxy </label>
                            </div>
                        </div>
                        <p class="text-muted small">Nếu bạn đang chạy daemon sau proxy như Cloudflare, hãy chọn tùy chọn này để daemon bỏ qua việc tìm kiếm chứng chỉ khi khởi động.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cấu hình</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDaemonBase" class="form-label">Thư mục tệp máy chủ Daemon</label>
                            <input type="text" name="daemonBase" id="pDaemonBase" class="form-control" value="/var/lib/pterodactyl/volumes" />
                            <p class="text-muted small">Nhập thư mục nơi các tệp máy chủ sẽ được lưu trữ. <strong>Nếu bạn sử dụng OVH, bạn nên kiểm tra sơ đồ phân vùng của mình. Bạn có thể cần sử dụng <code>/home/daemon-data</code> để có đủ dung lượng.</strong></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pMemory" class="form-label">Tổng bộ nhớ</label>
                            <div class="input-group">
                                <input type="text" name="memory" data-multiplicator="true" class="form-control" id="pMemory" value="{{ old('memory') }}"/>
                                <span class="input-group-addon">MiB</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pMemoryOverallocate" class="form-label">Cấp phát vượt mức bộ nhớ</label>
                            <div class="input-group">
                                <input type="text" name="memory_overallocate" class="form-control" id="pMemoryOverallocate" value="{{ old('memory_overallocate') }}"/>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">Nhập tổng dung lượng bộ nhớ khả dụng cho máy chủ mới. Nếu bạn muốn cho phép cấp phát vượt mức bộ nhớ, hãy nhập tỷ lệ phần trăm bạn muốn cho phép. Để tắt kiểm tra cấp phát vượt mức, hãy nhập <code>-1</code> vào trường. Nhập <code>0</code> sẽ ngăn việc tạo máy chủ mới nếu nó khiến node vượt quá giới hạn.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDisk" class="form-label">Tổng dung lượng đĩa</label>
                            <div class="input-group">
                                <input type="text" name="disk" data-multiplicator="true" class="form-control" id="pDisk" value="{{ old('disk') }}"/>
                                <span class="input-group-addon">MiB</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pDiskOverallocate" class="form-label">Cấp phát vượt mức dung lượng đĩa</label>
                            <div class="input-group">
                                <input type="text" name="disk_overallocate" class="form-control" id="pDiskOverallocate" value="{{ old('disk_overallocate') }}"/>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">Nhập tổng dung lượng đĩa khả dụng cho máy chủ mới. Nếu bạn muốn cho phép cấp phát vượt mức dung lượng đĩa, hãy nhập tỷ lệ phần trăm bạn muốn cho phép. Để tắt kiểm tra cấp phát vượt mức, hãy nhập <code>-1</code> vào trường. Nhập <code>0</code> sẽ ngăn việc tạo máy chủ mới nếu nó khiến node vượt quá giới hạn.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDaemonListen" class="form-label">Cổng Daemon</label>
                            <input type="text" name="daemonListen" class="form-control" id="pDaemonListen" value="8080" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pDaemonSFTP" class="form-label">Cổng Daemon SFTP</label>
                            <input type="text" name="daemonSFTP" class="form-control" id="pDaemonSFTP" value="2022" />
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">Daemon chạy vùng chứa quản lý SFTP riêng và không sử dụng quy trình SSHd trên máy chủ vật lý chính. <Strong>Không sử dụng cùng một cổng mà bạn đã chỉ định cho quy trình SSH của máy chủ vật lý của mình.</strong> Nếu bạn sẽ chạy daemon sau CloudFlare&reg;, bạn nên đặt cổng daemon thành <code>8443</code> để cho phép ủy quyền websocket qua SSL.</p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-success pull-right">Tạo Node</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('#pLocationId').select2();
    </script>
@endsection
