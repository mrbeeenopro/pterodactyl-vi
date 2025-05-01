<?php

/**
 * Chứa tất cả các chuỗi dịch cho các sự kiện nhật ký hoạt động khác nhau.
 * Các chuỗi này nên được đặt theo khóa là giá trị trước dấu hai chấm (:)
 * trong tên sự kiện. Nếu không có dấu hai chấm, chúng nên được đặt ở
 * cấp cao nhất.
 */
return [
    'auth' => [
        'fail' => 'Đăng nhập thất bại',
        'success' => 'Đã đăng nhập',
        'password-reset' => 'Đặt lại mật khẩu',
        'reset-password' => 'Yêu cầu đặt lại mật khẩu',
        'checkpoint' => 'Yêu cầu xác thực hai yếu tố',
        'recovery-token' => 'Sử dụng mã khôi phục hai yếu tố',
        'token' => 'Hoàn thành thử thách hai yếu tố',
        'ip-blocked' => 'Yêu cầu từ địa chỉ IP không được liệt kê đã bị chặn: :identifier',
        'sftp' => [
            'fail' => 'Đăng nhập SFTP thất bại',
        ],
    ],
    'user' => [
        'account' => [
            'email-changed' => 'Đã thay đổi email từ :old thành :new',
            'password-changed' => 'Đã thay đổi mật khẩu',
        ],
        'api-key' => [
            'create' => 'Đã tạo khóa API mới :identifier',
            'delete' => 'Đã xóa khóa API :identifier',
        ],
        'ssh-key' => [
            'create' => 'Đã thêm khóa SSH :fingerprint vào tài khoản',
            'delete' => 'Đã xóa khóa SSH :fingerprint khỏi tài khoản',
        ],
        'two-factor' => [
            'create' => 'Đã bật xác thực hai yếu tố',
            'delete' => 'Đã tắt xác thực hai yếu tố',
        ],
    ],
    'server' => [
        'reinstall' => 'Cài đặt lại máy chủ',
        'console' => [
            'command' => 'Đã thực thi lệnh ":command" trên máy chủ',
        ],
        'power' => [
            'start' => 'Khởi động máy chủ',
            'stop' => 'Tắt máy chủ',
            'restart' => 'Khởi động lại máy chủ',
            'kill' => 'Dừng tiến trình máy chủ',
        ],
        'backup' => [
            'download' => 'Đã tải xuống bản sao lưu :name',
            'delete' => 'Đã xóa bản sao lưu :name',
            'restore' => 'Khôi phục bản sao lưu :name (đã xóa tệp: :truncate)',
            'restore-complete' => 'Đã hoàn tất khôi phục bản sao lưu :name',
            'restore-failed' => 'Không thể hoàn tất khôi phục bản sao lưu :name',
            'start' => 'Bắt đầu tạo bản sao lưu :name',
            'complete' => 'Đã đánh dấu bản sao lưu :name là hoàn tất',
            'fail' => 'Đã đánh dấu bản sao lưu :name là thất bại',
            'lock' => 'Đã khóa bản sao lưu :name',
            'unlock' => 'Đã mở khóa bản sao lưu :name',
        ],
        'database' => [
            'create' => 'Tạo cơ sở dữ liệu mới :name',
            'rotate-password' => 'Đã thay đổi mật khẩu cơ sở dữ liệu :name',
            'delete' => 'Đã xóa cơ sở dữ liệu :name',
        ],
        'file' => [
            'compress_one' => 'Nén :directory:file',
            'compress_other' => 'Nén :count tệp trong :directory',
            'read' => 'Xem nội dung của :file',
            'copy' => 'Sao chép :file',
            'create-directory' => 'Tạo thư mục :directory:name',
            'decompress' => 'Giải nén :files trong :directory',
            'delete_one' => 'Đã xóa :directory:files.0',
            'delete_other' => 'Đã xóa :count tệp trong :directory',
            'download' => 'Tải xuống :file',
            'pull' => 'Tải xuống tệp từ xa từ :url đến :directory',
            'rename_one' => 'Đổi tên :directory:files.0.from thành :directory:files.0.to',
            'rename_other' => 'Đổi tên :count tệp trong :directory',
            'write' => 'Ghi nội dung mới vào :file',
            'upload' => 'Bắt đầu tải lên tệp',
            'uploaded' => 'Đã tải lên :directory:file',
        ],
        'sftp' => [
            'denied' => 'Chặn truy cập SFTP do quyền hạn chế',
            'create_one' => 'Tạo :files.0',
            'create_other' => 'Tạo :count tệp mới',
            'write_one' => 'Chỉnh sửa nội dung của :files.0',
            'write_other' => 'Chỉnh sửa nội dung của :count tệp',
            'delete_one' => 'Xóa :files.0',
            'delete_other' => 'Xóa :count tệp',
            'create-directory_one' => 'Tạo thư mục :files.0',
            'create-directory_other' => 'Tạo :count thư mục',
            'rename_one' => 'Đổi tên :files.0.from thành :files.0.to',
            'rename_other' => 'Đổi tên hoặc di chuyển :count tệp',
        ],
        'allocation' => [
            'create' => 'Thêm :allocation vào máy chủ',
            'notes' => 'Cập nhật ghi chú cho :allocation từ ":old" thành ":new"',
            'primary' => 'Đặt :allocation là phân bổ chính của máy chủ',
            'delete' => 'Xóa phân bổ :allocation',
        ],
        'schedule' => [
            'create' => 'Tạo lịch trình :name',
            'update' => 'Cập nhật lịch trình :name',
            'execute' => 'Thực thi thủ công lịch trình :name',
            'delete' => 'Xóa lịch trình :name',
        ],
        'task' => [
            'create' => 'Tạo tác vụ mới ":action" cho lịch trình :name',
            'update' => 'Cập nhật tác vụ ":action" cho lịch trình :name',
            'delete' => 'Xóa tác vụ khỏi lịch trình :name',
        ],
        'settings' => [
            'rename' => 'Đổi tên máy chủ từ :old thành :new',
            'description' => 'Thay đổi mô tả máy chủ từ :old thành :new',
        ],
        'startup' => [
            'edit' => 'Thay đổi biến :variable từ ":old" thành ":new"',
            'image' => 'Cập nhật hình ảnh Docker của máy chủ từ :old thành :new',
        ],
        'subuser' => [
            'create' => 'Thêm :email làm người dùng phụ',
            'update' => 'Cập nhật quyền của người dùng phụ :email',
            'delete' => 'Xóa :email khỏi danh sách người dùng phụ',
        ],
    ],
];
