@extends('layouts.admin')

@section('title')
    Egg &rarr; {{ $egg->name }} &rarr; Biến số
@endsection

@section('content-header')
    <h1>{{ $egg->name }}<small>Quản lý biến số cho Egg này.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Quản trị</a></li>
        <li><a href="{{ route('admin.nests') }}">Nests</a></li>
        <li><a href="{{ route('admin.nests.view', $egg->nest->id) }}">{{ $egg->nest->name }}</a></li>
        <li><a href="{{ route('admin.nests.egg.view', $egg->id) }}">{{ $egg->name }}</a></li>
        <li class="active">Biến số</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="{{ route('admin.nests.egg.view', $egg->id) }}">Cấu hình</a></li>
                <li class="active"><a href="{{ route('admin.nests.egg.variables', $egg->id) }}">Biến số</a></li>
                <li><a href="{{ route('admin.nests.egg.scripts', $egg->id) }}">Script Cài đặt</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box no-border">
            <div class="box-body">
                <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#newVariableModal">Tạo Biến số Mới</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach($egg->variables as $variable)
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $variable->name }}</h3>
                </div>
                <form action="{{ route('admin.nests.egg.variables.edit', ['egg' => $egg->id, 'variable' => $variable->id]) }}" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="form-label">Tên</label>
                            <input type="text" name="name" value="{{ $variable->name }}" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control" rows="3">{{ $variable->description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Biến Môi trường</label>
                                <input type="text" name="env_variable" value="{{ $variable->env_variable }}" class="form-control" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Giá trị Mặc định</label>
                                <input type="text" name="default_value" value="{{ $variable->default_value }}" class="form-control" />
                            </div>
                            <div class="col-xs-12">
                                <p class="text-muted small">Biến này có thể được truy cập trong lệnh khởi động bằng cách sử dụng <code>{{ $variable->env_variable }}</code>.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quyền</label>
                            <select name="options[]" class="pOptions form-control" multiple>
                                <option value="user_viewable" {{ (! $variable->user_viewable) ?: 'selected' }}>Người dùng có thể xem</option>
                                <option value="user_editable" {{ (! $variable->user_editable) ?: 'selected' }}>Người dùng có thể chỉnh sửa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quy tắc Nhập liệu</label>
                            <input type="text" name="rules" class="form-control" value="{{ $variable->rules }}" />
                            <p class="text-muted small">Các quy tắc này được định nghĩa bằng cách sử dụng các <a href="https://laravel.com/docs/5.7/validation#available-validation-rules" target="_blank">quy tắc xác thực của Laravel Framework</a>.</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button class="btn btn-sm btn-primary pull-right" name="_method" value="PATCH" type="submit">Lưu</button>
                        <button class="btn btn-sm btn-danger pull-left muted muted-hover" data-action="delete" name="_method" value="DELETE" type="submit"><i class="fa fa-trash-o"></i></button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
<div class="modal fade" id="newVariableModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tạo Biến số Mới cho Egg</h4>
            </div>
            <form action="{{ route('admin.nests.egg.variables', $egg->id) }}" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Tên <span class="field-required"></span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mô tả</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Biến Môi trường <span class="field-required"></span></label>
                            <input type="text" name="env_variable" class="form-control" value="{{ old('env_variable') }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Giá trị Mặc định</label>
                            <input type="text" name="default_value" class="form-control" value="{{ old('default_value') }}" />
                        </div>
                        <div class="col-xs-12">
                            <p class="text-muted small">Biến này có thể được truy cập trong lệnh khởi động bằng cách nhập <code>@{{environment variable value}}</code>.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Quyền</label>
                        <select name="options[]" class="pOptions form-control" multiple>
                            <option value="user_viewable">Người dùng có thể xem</option>
                            <option value="user_editable">Người dùng có thể chỉnh sửa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Quy tắc Nhập liệu <span class="field-required"></span></label>
                        <input type="text" name="rules" class="form-control" value="{{ old('rules', 'required|string|max:20') }}" placeholder="required|string|max:20" />
                        <p class="text-muted small">Các quy tắc này được định nghĩa bằng cách sử dụng các <a href="https://laravel.com/docs/5.7/validation#available-validation-rules" target="_blank">quy tắc xác thực của Laravel Framework</a>.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! csrf_field() !!}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Tạo Biến số</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('.pOptions').select2();
        $('[data-action="delete"]').on('mouseenter', function (event) {
            $(this).find('i').html(' Xóa Biến số');
        }).on('mouseleave', function (event) {
            $(this).find('i').html('');
        });
    </script>
@endsection
