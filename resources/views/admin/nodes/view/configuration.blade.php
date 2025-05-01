@extends('layouts.admin')

@section('title')
    {{ $node->name }}: Cấu hình
@endsection

@section('content-header')
    <h1>{{ $node->name }}<small>Tệp cấu hình daemon của bạn.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.nodes') }}">Nodes</a></li>
        <li><a href="{{ route('admin.nodes.view', $node->id) }}">{{ $node->name }}</a></li>
        <li class="active">Cấu hình</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="{{ route('admin.nodes.view', $node->id) }}">Thông tin</a></li>
                <li><a href="{{ route('admin.nodes.view.settings', $node->id) }}">Cài đặt</a></li>
                <li class="active"><a href="{{ route('admin.nodes.view.configuration', $node->id) }}">Cấu hình</a></li>
                <li><a href="{{ route('admin.nodes.view.allocation', $node->id) }}">Phân bổ</a></li>
                <li><a href="{{ route('admin.nodes.view.servers', $node->id) }}">Máy chủ</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tệp cấu hình</h3>
            </div>
            <div class="box-body">
                <pre class="no-margin">{{ $node->getYamlConfiguration() }}</pre>
            </div>
            <div class="box-footer">
                <p class="no-margin">Tệp này nên được đặt trong thư mục gốc của daemon (thường là <code>/etc/pterodactyl</code>) trong một tệp có tên <code>config.yml</code>.</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Tự động triển khai</h3>
            </div>
            <div class="box-body">
                <p class="text-muted small">
                    Sử dụng nút bên dưới để tạo một lệnh triển khai tùy chỉnh có thể được sử dụng để định cấu hình
                    wings trên máy chủ đích bằng một lệnh duy nhất.
                </p>
            </div>
            <div class="box-footer">
                <button type="button" id="configTokenBtn" class="btn btn-sm btn-default" style="width:100%;">Tạo Token</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#configTokenBtn').on('click', function (event) {
        $.ajax({
            method: 'POST',
            url: '{{ route('admin.nodes.view.configuration.token', $node->id) }}',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        }).done(function (data) {
            swal({
                type: 'success',
                title: 'Token đã được tạo.',
                text: '<p>Để tự động định cấu hình node của bạn, hãy chạy lệnh sau:<br /><small><pre>cd /etc/pterodactyl && sudo wings configure --panel-url {{ config('app.url') }} --token ' + data.token + ' --node ' + data.node + '{{ config('app.debug') ? ' --allow-insecure' : '' }}</pre></small></p>',
                html: true
            })
        }).fail(function () {
            swal({
                title: 'Lỗi',
                text: 'Đã xảy ra lỗi khi tạo token của bạn.',
                type: 'error'
            });
        });
    });
    </script>
@endsection
