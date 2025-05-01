@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'advanced'])

@section('title')
    Cài Đặt Nâng Cao
@endsection

@section('content-header')
    <h1>Cài Đặt Nâng Cao<small>Cấu hình các cài đặt nâng cao cho Pterodactyl.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Cài Đặt</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="" method="POST">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">reCAPTCHA</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Trạng Thái</label>
                                <div>
                                    <select class="form-control" name="recaptcha:enabled">
                                        <option value="true">Bật</option>
                                        <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>Tắt</option>
                                    </select>
                                    <p class="text-muted small">Nếu được bật, các biểu mẫu đăng nhập và biểu mẫu đặt lại mật khẩu sẽ thực hiện kiểm tra captcha im lặng và hiển thị captcha nếu cần.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Khóa Trang Web</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:website_key" value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Khóa Bí Mật</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:secret_key" value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}">
                                    <p class="text-muted small">Được sử dụng để giao tiếp giữa trang web của bạn và Google. Hãy giữ bí mật.</p>
                                </div>
                            </div>
                        </div>
                        @if($showRecaptchaWarning)
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning no-margin">
                                        Bạn hiện đang sử dụng các khóa reCAPTCHA được cung cấp cùng với Panel này. Để cải thiện bảo mật, bạn nên <a href="https://www.google.com/recaptcha/admin">tạo khóa reCAPTCHA ẩn mới</a> được liên kết cụ thể với trang web của bạn.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kết Nối HTTP</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Thời Gian Chờ Kết Nối</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:connect_timeout" value="{{ old('pterodactyl:guzzle:connect_timeout', config('pterodactyl.guzzle.connect_timeout')) }}">
                                    <p class="text-muted small">Khoảng thời gian tính bằng giây để chờ kết nối được mở trước khi đưa ra lỗi.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Thời Gian Chờ Yêu Cầu</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:timeout" value="{{ old('pterodactyl:guzzle:timeout', config('pterodactyl.guzzle.timeout')) }}">
                                    <p class="text-muted small">Khoảng thời gian tính bằng giây để chờ yêu cầu hoàn thành trước khi đưa ra lỗi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tự Động Tạo Allocation</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Trạng Thái</label>
                                <div>
                                    <select class="form-control" name="pterodactyl:client_features:allocations:enabled">
                                        <option value="false">Tắt</option>
                                        <option value="true" @if(old('pterodactyl:client_features:allocations:enabled', config('pterodactyl.client_features.allocations.enabled'))) selected @endif>Bật</option>
                                    </select>
                                    <p class="text-muted small">Nếu được bật, người dùng sẽ có tùy chọn tự động tạo các allocation mới cho máy chủ của họ thông qua giao diện người dùng.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Cổng Bắt Đầu</label>
                                <div>
                                    <input type="number" class="form-control" name="pterodactyl:client_features:allocations:range_start" value="{{ old('pterodactyl:client_features:allocations:range_start', config('pterodactyl.client_features.allocations.range_start')) }}">
                                    <p class="text-muted small">Cổng bắt đầu trong phạm vi có thể được tự động cấp phát.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Cổng Kết Thúc</label>
                                <div>
                                    <input type="number" class="form-control" name="pterodactyl:client_features:allocations:range_end" value="{{ old('pterodactyl:client_features:allocations:range_end', config('pterodactyl.client_features.allocations.range_end')) }}">
                                    <p class="text-muted small">Cổng kết thúc trong phạm vi có thể được tự động cấp phát.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
