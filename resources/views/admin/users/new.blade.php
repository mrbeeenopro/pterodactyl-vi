@extends('layouts.admin')

@section('title')
    Tạo Người Dùng
@endsection

@section('content-header')
    <h1>Tạo Người Dùng<small>Thêm một người dùng mới vào hệ thống.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.users') }}">Người Dùng</a></li>
        <li class="active">Tạo</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <form method="post">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cá nhân</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <div>
                            <input type="text" autocomplete="off" name="email" value="{{ old('email') }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="control-label">Tên đăng nhập</label>
                        <div>
                            <input type="text" autocomplete="off" name="username" value="{{ old('username') }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_first" class="control-label">Tên Khách Hàng</label>
                        <div>
                            <input type="text" autocomplete="off" name="name_first" value="{{ old('name_first') }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_last" class="control-label">Họ Khách Hàng</label>
                        <div>
                            <input type="text" autocomplete="off" name="name_last" value="{{ old('name_last') }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ngôn ngữ mặc định</label>
                        <div>
                            <select name="language" class="form-control">
                                @foreach($languages as $key => $value)
                                    <option value="{{ $key }}" @if(config('app.locale') === $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            <p class="text-muted"><small>Ngôn ngữ mặc định được sử dụng khi hiển thị Panel cho người dùng này.</small></p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <input type="submit" value="Tạo Người Dùng" class="btn btn-success btn-sm">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Quyền</h3>
                </div>
                <div class="box-body">
                    <div class="form-group col-md-12">
                        <label for="root_admin" class="control-label">Quản trị viên</label>
                        <div>
                            <select name="root_admin" class="form-control">
                                <option value="0">@lang('strings.no')</option>
                                <option value="1">@lang('strings.yes')</option>
                            </select>
                            <p class="text-muted"><small>Chọn 'Có' để cấp cho người dùng toàn quyền quản trị.</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Mật khẩu</h3>
                </div>
                <div class="box-body">
                    <div class="alert alert-info">
                        <p>Cung cấp mật khẩu cho người dùng là không bắt buộc. Email người dùng mới nhắc người dùng tạo mật khẩu khi đăng nhập lần đầu tiên. Nếu mật khẩu được cung cấp ở đây, bạn sẽ cần tìm một phương pháp khác để cung cấp nó cho người dùng.</p>
                    </div>
                    <div id="gen_pass" class=" alert alert-success" style="display:none;margin-bottom: 10px;"></div>
                    <div class="form-group">
                        <label for="pass" class="control-label">Mật khẩu</label>
                        <div>
                            <input type="password" name="password" class="form-control" />
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
    <script>$("#gen_pass_bttn").click(function (event) {
            event.preventDefault();
            $.ajax({
                type: "GET",
                url: "/password-gen/12",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
               },
                success: function(data) {
                    $("#gen_pass").html('<strong>Mật khẩu đã tạo:</strong> ' + data).slideDown();
                    $('input[name="password"], input[name="password_confirmation"]').val(data);
                    return false;
                }
            });
            return false;
        });
    </script>
@endsection
