@extends('layouts.admin')

@section('title')
    Máy chủ — {{ $server->name }}: Chi tiết cấu hình
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Quản lý các allocation và tài nguyên hệ thống cho máy chủ này.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Máy chủ</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Cấu hình Build</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <form action="{{ route('admin.servers.view.build', $server->id) }}" method="POST">
        <div class="col-sm-5">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Quản lý tài nguyên</h3>
                </div>
                <div class="box-body">
                <div class="form-group">
                        <label for="cpu" class="control-label">Giới hạn CPU</label>
                        <div class="input-group">
                            <input type="text" name="cpu" class="form-control" value="{{ old('cpu', $server->cpu) }}"/>
                            <span class="input-group-addon">%</span>
                        </div>
                        <p class="text-muted small">Mỗi core <em>ảo</em> (luồng) trên hệ thống được coi là <code>100%</code>. Đặt giá trị này thành <code>0</code> sẽ cho phép máy chủ sử dụng thời gian CPU mà không bị hạn chế.</p>
                    </div>
                    <div class="form-group">
                        <label for="threads" class="control-label">CPU Pinning</label>
                        <div>
                            <input type="text" name="threads" class="form-control" value="{{ old('threads', $server->threads) }}"/>
                        </div>
                        <p class="text-muted small"><strong>Nâng cao:</strong> Nhập các core CPU cụ thể mà tiến trình này có thể chạy hoặc để trống để cho phép tất cả các core. Đây có thể là một số duy nhất hoặc danh sách phân tách bằng dấu phẩy. Ví dụ: <code>0</code>, <code>0-1,3</code> hoặc <code>0,1,3,4</code>.</p>
                    </div>
                    <div class="form-group">
                        <label for="memory" class="control-label">Bộ nhớ được cấp phát</label>
                        <div class="input-group">
                            <input type="text" name="memory" data-multiplicator="true" class="form-control" value="{{ old('memory', $server->memory) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">Dung lượng bộ nhớ tối đa được phép cho container này. Đặt giá trị này thành <code>0</code> sẽ cho phép bộ nhớ không giới hạn trong một container.</p>
                    </div>
                    <div class="form-group">
                        <label for="swap" class="control-label">Bộ nhớ Swap được cấp phát</label>
                        <div class="input-group">
                            <input type="text" name="swap" data-multiplicator="true" class="form-control" value="{{ old('swap', $server->swap) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">Đặt giá trị này thành <code>0</code> sẽ tắt không gian swap trên máy chủ này. Đặt thành <code>-1</code> sẽ cho phép swap không giới hạn.</p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">Giới hạn dung lượng ổ đĩa</label>
                        <div class="input-group">
                            <input type="text" name="disk" class="form-control" value="{{ old('disk', $server->disk) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">Máy chủ này sẽ không được phép khởi động nếu đang sử dụng nhiều hơn dung lượng này. Nếu một máy chủ vượt quá giới hạn này trong khi chạy, nó sẽ bị dừng một cách an toàn và bị khóa cho đến khi có đủ dung lượng. Đặt thành <code>0</code> để cho phép sử dụng ổ đĩa không giới hạn.</p>
                    </div>
                    <div class="form-group">
                        <label for="io" class="control-label">Tỷ lệ Block IO</label>
                        <div>
                            <input type="text" name="io" class="form-control" value="{{ old('io', $server->io) }}"/>
                        </div>
                        <p class="text-muted small"><strong>Nâng cao</strong>: Hiệu suất IO của máy chủ này so với các container <em>đang chạy</em> khác trên hệ thống. Giá trị phải nằm trong khoảng <code>10</code> và <code>1000</code>.</p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">OOM Killer</label>
                        <div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pOomKillerEnabled" value="0" name="oom_disabled" @if(!$server->oom_disabled)checked @endif>
                                <label for="pOomKillerEnabled">Bật</label>
                            </div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pOomKillerDisabled" value="1" name="oom_disabled" @if($server->oom_disabled)checked @endif>
                                <label for="pOomKillerDisabled">Tắt</label>
                            </div>
                            <p class="text-muted small">
                                Bật OOM killer có thể khiến các tiến trình của máy chủ thoát đột ngột.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Giới hạn tính năng ứng dụng</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label for="database_limit" class="control-label">Giới hạn Database</label>
                                    <div>
                                        <input type="text" name="database_limit" class="form-control" value="{{ old('database_limit', $server->database_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">Tổng số database mà người dùng được phép tạo cho máy chủ này.</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="allocation_limit" class="control-label">Giới hạn Allocation</label>
                                    <div>
                                        <input type="text" name="allocation_limit" class="form-control" value="{{ old('allocation_limit', $server->allocation_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">Tổng số allocation mà người dùng được phép tạo cho máy chủ này.</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="backup_limit" class="control-label">Giới hạn Backup</label>
                                    <div>
                                        <input type="text" name="backup_limit" class="form-control" value="{{ old('backup_limit', $server->backup_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">Tổng số backup có thể được tạo cho máy chủ này.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Quản lý Allocation</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pAllocation" class="control-label">Game Port</label>
                                <select id="pAllocation" name="allocation_id" class="form-control">
                                    @foreach ($assigned as $assignment)
                                        <option value="{{ $assignment->id }}"
                                            @if($assignment->id === $server->allocation_id)
                                                selected="selected"
                                            @endif
                                        >{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                    @endforeach
                                </select>
                                <p class="text-muted small">Địa chỉ kết nối mặc định sẽ được sử dụng cho máy chủ trò chơi này.</p>
                            </div>
                            <div class="form-group">
                                <label for="pAddAllocations" class="control-label">Gán thêm Port</label>
                                <div>
                                    <select name="add_allocations[]" class="form-control" multiple id="pAddAllocations">
                                        @foreach ($unassigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">Xin lưu ý rằng do giới hạn của phần mềm, bạn không thể gán các port giống hệt nhau trên các IP khác nhau cho cùng một máy chủ.</p>
                            </div>
                            <div class="form-group">
                                <label for="pRemoveAllocations" class="control-label">Xóa Port</label>
                                <div>
                                    <select name="remove_allocations[]" class="form-control" multiple id="pRemoveAllocations">
                                        @foreach ($assigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">Chỉ cần chọn các port bạn muốn xóa khỏi danh sách trên. Nếu bạn muốn gán một port trên một IP khác đã được sử dụng, bạn có thể chọn nó từ bên trái và xóa nó ở đây.</p>
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary pull-right">Cập nhật cấu hình Build</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pAddAllocations').select2();
    $('#pRemoveAllocations').select2();
    $('#pAllocation').select2();
    </script>
@endsection
