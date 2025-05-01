@extends('layouts.admin')

@section('title')
    Quản trị
@endsection

@section('content-header')
    <h1>Tổng quan về quản trị<small>Xem nhanh hệ thống của bạn.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Quản trị</a></li>
        <li class="active">Trang chủ</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box
            @if($version->isLatestPanel())
                box-success
            @else
                box-danger
            @endif
        ">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin hệ thống</h3>
            </div>
            <div class="box-body">
                @if ($version->isLatestPanel())
                    Bạn đang chạy phiên bản Pterodactyl Panel <code>{{ config('app.version') }}</code>. Panel của bạn đã được cập nhật!
                @else
                    Panel của bạn <strong>chưa được cập nhật!</strong> Phiên bản mới nhất là <a href="https://github.com/Pterodactyl/Panel/releases/v{{ $version->getPanel() }}" target="_blank"><code>{{ $version->getPanel() }}</code></a> và bạn hiện đang chạy phiên bản <code>{{ config('app.version') }}</code>.
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="{{ $version->getDiscord() }}"><button class="btn btn-warning" style="width:100%;"><i class="fa fa-fw fa-support"></i> Nhận trợ giúp <small>(qua Discord)</small></button></a>
    </div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="https://pterodactyl.io"><button class="btn btn-primary" style="width:100%;"><i class="fa fa-fw fa-link"></i> Tài liệu</button></a>
    </div>
    <div class="clearfix visible-xs-block">&nbsp;</div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="https://github.com/pterodactyl/panel"><button class="btn btn-primary" style="width:100%;"><i class="fa fa-fw fa-support"></i> GitHub</button></a>
    </div>
    <div class="clearfix visible-xs-block">&nbsp;</div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="https://github.com/mrbeeenopro/pterodactyl-vi"><button class="btn btn-primary" style="width:100%;"><i class="fa fa-fw fa-support"></i> GitHub transition</button></a>
    </div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="{{ $version->getDonations() }}"><button class="btn btn-success" style="width:100%;"><i class="fa fa-fw fa-money"></i> Ủng hộ dự án</button></a>
    </div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="https://cdn.discordapp.com/attachments/1327280534992322620/1367335772897673246/LXRMNFV.png?ex=6814362c&is=6812e4ac&hm=0e6bfed43eb3627536e907e62d04d9456262da74176059ada4ab866229e57f9e&"><button class="btn btn-success" style="width:100%;"><i class="fa fa-fw fa-money"></i> Ủng hộ người việt hoá</button></a>
    </div>

</div>
@endsection
