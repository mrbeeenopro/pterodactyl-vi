@section('settings::notice')
    @if(config('pterodactyl.load_environment_only', false))
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    Bảng điều khiển của bạn hiện đang được cấu hình để chỉ đọc cài đặt từ môi trường. Bạn cần đặt <code>APP_ENVIRONMENT_ONLY=false</code> trong tệp môi trường của mình để tải cài đặt một cách động.
                </div>
            </div>
        </div>
    @endif
@endsection
