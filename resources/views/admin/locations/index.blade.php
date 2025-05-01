@extends('layouts.admin')

@section('title')
    Địa điểm
@endsection

@section('content-header')
    <h1>Địa điểm<small>Tất cả các địa điểm mà các nút có thể được gán để phân loại dễ dàng hơn.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Địa điểm</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách địa điểm</h3>
                <div class="box-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newLocationModal">Tạo mới</button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Mã ngắn</th>
                            <th>Mô tả</th>
                            <th class="text-center">Nút</th>
                            <th class="text-center">Máy chủ</th>
                        </tr>
                        @foreach ($locations as $location)
                            <tr>
                                <td><code>{{ $location->id }}</code></td>
                                <td><a href="{{ route('admin.locations.view', $location->id) }}">{{ $location->short }}</a></td>
                                <td>{{ $location->long }}</td>
                                <td class="text-center">{{ $location->nodes_count }}</td>
                                <td class="text-center">{{ $location->servers_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newLocationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.locations') }}" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tạo địa điểm</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="pShortModal" class="form-label">Mã ngắn</label>
                            <input type="text" name="short" id="pShortModal" class="form-control" />
                            <p class="text-muted small">Một mã định danh ngắn được sử dụng để phân biệt địa điểm này với những địa điểm khác. Phải từ 1 đến 60 ký tự, ví dụ: <code>us.nyc.lvl3</code>.</p>
                        </div>
                        <div class="col-md-12">
                            <label for="pLongModal" class="form-label">Mô tả</label>
                            <textarea name="long" id="pLongModal" class="form-control" rows="4"></textarea>
                            <p class="text-muted small">Một mô tả dài hơn về địa điểm này. Phải ít hơn 191 ký tự.</p>
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
