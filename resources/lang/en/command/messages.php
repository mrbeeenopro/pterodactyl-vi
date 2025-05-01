<?php

return [
    'location' => [
        'no_location_found' => 'Không thể tìm thấy bản ghi phù hợp với mã ngắn được cung cấp.',
        'ask_short' => 'Mã ngắn của vị trí',
        'ask_long' => 'Mô tả vị trí',
        'created' => 'Đã tạo thành công một vị trí mới (:name) với ID :id.',
        'deleted' => 'Đã xóa thành công vị trí được yêu cầu.',
    ],
    'user' => [
        'search_users' => 'Nhập Tên người dùng, ID người dùng, hoặc Địa chỉ Email',
        'select_search_user' => 'ID người dùng để xóa (Nhập \'0\' để tìm kiếm lại)',
        'deleted' => 'Người dùng đã được xóa khỏi Bảng điều khiển.',
        'confirm_delete' => 'Bạn có chắc chắn muốn xóa người dùng này khỏi Bảng điều khiển không?',
        'no_users_found' => 'Không tìm thấy người dùng nào với từ khóa tìm kiếm được cung cấp.',
        'multiple_found' => 'Nhiều tài khoản được tìm thấy với thông tin đã cung cấp, không thể xóa người dùng do cờ --no-interaction.',
        'ask_admin' => 'Người dùng này có phải là quản trị viên không?',
        'ask_email' => 'Địa chỉ Email',
        'ask_username' => 'Tên người dùng',
        'ask_name_first' => 'Tên',
        'ask_name_last' => 'Họ',
        'ask_password' => 'Mật khẩu',
        'ask_password_tip' => 'Nếu bạn muốn tạo tài khoản với mật khẩu ngẫu nhiên được gửi qua email cho người dùng, hãy chạy lại lệnh này (CTRL+C) và thêm cờ `--no-password`.',
        'ask_password_help' => 'Mật khẩu phải có ít nhất 8 ký tự và chứa ít nhất một chữ cái viết hoa và một số.',
        '2fa_help_text' => [
            'Lệnh này sẽ vô hiệu hóa xác thực hai yếu tố cho tài khoản của người dùng nếu nó đang được bật. Chỉ sử dụng như một lệnh khôi phục tài khoản nếu người dùng bị khóa tài khoản của họ.',
            'Nếu không phải điều bạn muốn làm, nhấn CTRL+C để thoát.',
        ],
        '2fa_disabled' => 'Xác thực hai yếu tố đã bị vô hiệu hóa cho :email.',
    ],
    'schedule' => [
        'output_line' => 'Thực hiện công việc cho tác vụ đầu tiên trong `:schedule` (:hash).',
    ],
    'maintenance' => [
        'deleting_service_backup' => 'Xóa tệp sao lưu dịch vụ :file.',
    ],
    'server' => [
        'rebuild_failed' => 'Yêu cầu xây dựng lại cho ":name" (#:id) trên node ":node" đã thất bại với lỗi: :message',
        'reinstall' => [
            'failed' => 'Yêu cầu cài đặt lại cho ":name" (#:id) trên node ":node" đã thất bại với lỗi: :message',
            'confirm' => 'Bạn sắp sửa cài đặt lại trên một nhóm máy chủ. Bạn có muốn tiếp tục không?',
        ],
        'power' => [
            'confirm' => 'Bạn sắp thực hiện hành động :action trên :count máy chủ. Bạn có muốn tiếp tục không?',
            'action_failed' => 'Yêu cầu hành động nguồn cho ":name" (#:id) trên node ":node" đã thất bại với lỗi: :message',
        ],
    ],
    'environment' => [
        'mail' => [
            'ask_smtp_host' => 'Máy chủ SMTP (ví dụ: smtp.gmail.com)',
            'ask_smtp_port' => 'Cổng SMTP',
            'ask_smtp_username' => 'Tên người dùng SMTP',
            'ask_smtp_password' => 'Mật khẩu SMTP',
            'ask_mailgun_domain' => 'Tên miền Mailgun',
            'ask_mailgun_endpoint' => 'Điểm cuối Mailgun',
            'ask_mailgun_secret' => 'Secret của Mailgun',
            'ask_mandrill_secret' => 'Secret của Mandrill',
            'ask_postmark_username' => 'Khóa API của Postmark',
            'ask_driver' => 'Trình điều khiển nào sẽ được sử dụng để gửi email?',
            'ask_mail_from' => 'Địa chỉ email mà email sẽ được gửi từ',
            'ask_mail_name' => 'Tên xuất hiện trong email',
            'ask_encryption' => 'Phương pháp mã hóa được sử dụng',
        ],
    ],
];
