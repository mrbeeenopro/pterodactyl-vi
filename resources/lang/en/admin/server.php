<?php

return [
    'exceptions' => [
        'no_new_default_allocation' => 'Bạn đang cố gắng xóa phân bổ mặc định cho máy chủ này nhưng không có phân bổ dự phòng để sử dụng.',
        'marked_as_failed' => 'Máy chủ này đã được đánh dấu là đã thất bại trong việc cài đặt trước đó. Trạng thái hiện tại không thể thay đổi trong trạng thái này.',
        'bad_variable' => 'Đã xảy ra lỗi xác thực với biến :name.',
        'daemon_exception' => 'Đã xảy ra ngoại lệ khi cố gắng giao tiếp với daemon, dẫn đến mã phản hồi HTTP/:code. Ngoại lệ này đã được ghi lại. (mã yêu cầu: :request_id)',
        'default_allocation_not_found' => 'Không tìm thấy phân bổ mặc định yêu cầu trong phân bổ của máy chủ này.',
    ],
    'alerts' => [
        'startup_changed' => 'Cấu hình khởi động cho máy chủ này đã được cập nhật. Nếu tổ hợp hoặc ảnh trứng của máy chủ này đã thay đổi, một lần cài đặt lại sẽ được thực hiện ngay bây giờ.',
        'server_deleted' => 'Máy chủ đã được xóa thành công khỏi hệ thống.',
        'server_created' => 'Máy chủ đã được tạo thành công trên bảng điều khiển. Vui lòng để daemon vài phút để hoàn tất việc cài đặt máy chủ này.',
        'build_updated' => 'Chi tiết bản dựng cho máy chủ này đã được cập nhật. Một số thay đổi có thể yêu cầu khởi động lại để có hiệu lực.',
        'suspension_toggled' => 'Trạng thái đình chỉ của máy chủ đã được thay đổi thành :status.',
        'rebuild_on_boot' => 'Máy chủ này đã được đánh dấu là cần cài đặt lại Docker Container. Việc này sẽ xảy ra khi máy chủ được khởi động lại lần tiếp theo.',
        'install_toggled' => 'Trạng thái cài đặt của máy chủ này đã được thay đổi.',
        'server_reinstalled' => 'Máy chủ này đã được đưa vào danh sách để cài đặt lại, bắt đầu ngay bây giờ.',
        'details_updated' => 'Chi tiết máy chủ đã được cập nhật thành công.',
        'docker_image_updated' => 'Đã thay đổi thành công ảnh Docker mặc định để sử dụng cho máy chủ này. Cần khởi động lại để áp dụng thay đổi này.',
        'node_required' => 'Bạn phải có ít nhất một node được cấu hình trước khi có thể thêm máy chủ vào bảng điều khiển này.',
        'transfer_nodes_required' => 'Bạn phải có ít nhất hai node được cấu hình trước khi có thể chuyển máy chủ.',
        'transfer_started' => 'Quá trình chuyển máy chủ đã được bắt đầu.',
        'transfer_not_viable' => 'Node bạn chọn không có đủ dung lượng đĩa hoặc bộ nhớ cần thiết để chứa máy chủ này.',
    ],
];
