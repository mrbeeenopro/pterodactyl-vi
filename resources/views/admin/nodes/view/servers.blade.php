@extends('layouts.admin')

@section('title')
    {{ $node->name }}: Máy chủ
@endsection

@section('content-header')
    <h1>{{ $node->name }}<small>Tất cả các máy chủ hiện đang được gán cho node này.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.nodes') }}">Nodes</a></li>
        <li><a href="{{ route('admin.nodes.view', $node->id) }}">{{ $node->name }}</a></li>
        <li class="active">Máy chủ</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="{{ route('admin.nodes.view', $node->id) }}">Thông tin</a></li>
                <li><a href="{{ route('admin.nodes.view.settings', $node->id) }}">Cài đặt</a></li>
                <li><a href="{{ route('admin.nodes.view.configuration', $node->id) }}">Cấu hình</a></li>
                <li><a href="{{ route('admin.nodes.view.allocation', $node->id) }}">Phân bổ</a></li>
                <li class="active"><a href="{{ route('admin.nodes.view.servers', $node->id) }}">Máy chủ</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Quản lý tiến trình</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Tên máy chủ</th>
                        <th>Chủ sở hữu</th>
                        <th>Dịch vụ</th>
                    </tr>
                    @foreach($servers as $server)
                        <tr data-server="{{ $server->uuid }}">
                            <td><code>{{ $server->uuidShort }}</code></td>
                            <td><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></td>
                            <td><a href="{{ route('admin.users.view', $server->owner_id) }}">{{ $server->user->username }}</a></td>
                            <td>{{ $server->nest->name }} ({{ $server->egg->name }})</td>
                        </tr>
                    @endforeach
                </table>
                @if($servers->hasPages())
                    <div class="box-footer with-border">
                        <div class="col-md-12 text-center">{!! $servers->render() !!}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
