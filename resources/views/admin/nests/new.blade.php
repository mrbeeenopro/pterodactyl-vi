@extends('layouts.admin')

@section('title')
    Nest Mới
@endsection

@section('content-header')
    <h1>Nest Mới<small>Cấu hình một nest mới để triển khai tới tất cả các node.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.nests') }}">Nests</a></li>
        <li class="active">Mới</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.nests.new') }}" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Nest Mới</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label">Tên</label>
                        <div>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                            <p class="text-muted"><small>Đây nên là một tên danh mục mô tả bao gồm tất cả các egg trong nest.</small></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mô tả</label>
                        <div>
                            <textarea name="description" class="form-control" rows="6">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary pull-right">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
