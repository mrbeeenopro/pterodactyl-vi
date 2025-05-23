@extends('layouts.admin')

@section('title')
    Mounts
@endsection

@section('content-header')
    <h1>Mounts<small>Cấu hình và quản lý các điểm mount bổ sung cho máy chủ.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Mounts</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách Mount</h3>

                    <div class="box-tools">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newMountModal">Tạo mới</button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Nguồn</th>
                                <th>Đích</th>
                                <th class="text-center">Eggs</th>
                                <th class="text-center">Nodes</th>
                                <th class="text-center">Servers</th>
                            </tr>

                            @foreach ($mounts as $mount)
                                <tr>
                                    <td><code>{{ $mount->id }}</code></td>
                                    <td><a href="{{ route('admin.mounts.view', $mount->id) }}">{{ $mount->name }}</a></td>
                                    <td><code>{{ $mount->source }}</code></td>
                                    <td><code>{{ $mount->target }}</code></td>
                                    <td class="text-center">{{ $mount->eggs_count }}</td>
                                    <td class="text-center">{{ $mount->nodes_count }}</td>
                                    <td class="text-center">{{ $mount->servers_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newMountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.mounts') }}" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: #FFFFFF">&times;</span>
                        </button>

                        <h4 class="modal-title">Tạo Mount</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="pName" class="form-label">Tên</label>
                                <input type="text" id="pName" name="name" class="form-control" />
                                <p class="text-muted small">Tên duy nhất được sử dụng để phân biệt mount này với mount khác.</p>
                            </div>

                            <div class="col-md-12">
                                <label for="pDescription" class="form-label">Mô tả</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="4"></textarea>
                                <p class="text-muted small">Mô tả dài hơn cho mount này, phải ít hơn 191 ký tự.</p>
                            </div>

                            <div class="col-md-6">
                                <label for="pSource" class="form-label">Nguồn</label>
                                <input type="text" id="pSource" name="source" class="form-control" />
                                <p class="text-muted small">Đường dẫn tệp trên hệ thống máy chủ để mount vào container.</p>
                            </div>

                            <div class="col-md-6">
                                <label for="pTarget" class="form-label">Đích</label>
                                <input type="text" id="pTarget" name="target" class="form-control" />
                                <p class="text-muted small">Nơi mount sẽ có thể truy cập được bên trong container.</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Chỉ đọc</label>

                                <div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="pReadOnlyFalse" name="read_only" value="0" checked>
                                        <label for="pReadOnlyFalse">False</label>
                                    </div>

                                    <div class="radio radio-warning radio-inline">
                                        <input type="radio" id="pReadOnly" name="read_only" value="1">
                                        <label for="pReadOnly">True</label>
                                    </div>
                                </div>

                                <p class="text-muted small">Mount này có chỉ đọc bên trong container không?</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Người dùng có thể mount</label>

                                <div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="pUserMountableFalse" name="user_mountable" value="0" checked>
                                        <label for="pUserMountableFalse">False</label>
                                    </div>

                                    <div class="radio radio-warning radio-inline">
                                        <input type="radio" id="pUserMountable" name="user_mountable" value="1">
                                        <label for="pUserMountable">True</label>
                                    </div>
                                </div>

                                <p class="text-muted small">Người dùng có được phép tự mount cái này không?</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {!! csrf_field() !!}
                        <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success btn-sm">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
