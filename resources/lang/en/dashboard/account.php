<?php

return [
    'email' => [
        'title' => 'Cập nhật email của bạn',
        'updated' => 'Địa chỉ email của bạn đã được cập nhật.',
    ],
    'password' => [
        'title' => 'Thay đổi mật khẩu của bạn',
        'requirements' => 'Mật khẩu mới của bạn phải có ít nhất 8 ký tự.',
        'updated' => 'Mật khẩu của bạn đã được cập nhật.',
    ],
    'two_factor' => [
        'button' => 'Cấu hình Xác thực Hai yếu tố',
        'disabled' => 'Xác thực hai yếu tố đã bị vô hiệu hóa trên tài khoản của bạn. Bạn sẽ không cần cung cấp mã khi đăng nhập nữa.',
        'enabled' => 'Xác thực hai yếu tố đã được kích hoạt trên tài khoản của bạn! Từ bây giờ, khi đăng nhập, bạn sẽ cần cung cấp mã được tạo bởi thiết bị của mình.',
        'invalid' => 'Mã token cung cấp không hợp lệ.',
        'setup' => [
            'title' => 'Thiết lập xác thực hai yếu tố',
            'help' => 'Không thể quét mã? Nhập mã dưới đây vào ứng dụng của bạn:',
            'field' => 'Nhập mã token',
        ],
        'disable' => [
            'title' => 'Vô hiệu hóa xác thực hai yếu tố',
            'field' => 'Nhập mã token',
        ],
    ],
];
