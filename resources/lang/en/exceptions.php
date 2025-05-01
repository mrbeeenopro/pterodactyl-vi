<?php

return [
    'daemon_connection_failed' => 'Đã xảy ra lỗi khi cố gắng giao tiếp với daemon, dẫn đến mã phản hồi HTTP/:code. Lỗi này đã được ghi lại.',
    'node' => [
        'servers_attached' => 'Một nút không được có máy chủ nào liên kết để có thể bị xóa.',
        'daemon_off_config_updated' => 'Cấu hình daemon <strong>đã được cập nhật</strong>, tuy nhiên đã xảy ra lỗi khi cố tự động cập nhật tệp cấu hình trên Daemon. Bạn cần phải tự tay cập nhật tệp cấu hình (config.yml) để áp dụng các thay đổi này.',
    ],
    'allocations' => [
        'server_using' => 'Một máy chủ hiện đang được gán cho phân bổ này. Phân bổ chỉ có thể bị xóa nếu không có máy chủ nào đang được gán.',
        'too_many_ports' => 'Không hỗ trợ thêm hơn 1000 cổng trong một phạm vi cùng lúc.',
        'invalid_mapping' => 'Ánh xạ được cung cấp cho :port không hợp lệ và không thể xử lý.',
        'cidr_out_of_range' => 'Ký hiệu CIDR chỉ cho phép mặt nạ trong khoảng từ /25 đến /32.',
        'port_out_of_range' => 'Các cổng trong phân bổ phải lớn hơn 1024 và nhỏ hơn hoặc bằng 65535.',
    ],
    'nest' => [
        'delete_has_servers' => 'Một Nest có máy chủ đang hoạt động không thể bị xóa khỏi Panel.',
        'egg' => [
            'delete_has_servers' => 'Một Egg có máy chủ đang hoạt động không thể bị xóa khỏi Panel.',
            'invalid_copy_id' => 'Egg được chọn để sao chép kịch bản không tồn tại hoặc tự nó đang sao chép một kịch bản.',
            'must_be_child' => 'Tùy chọn "Sao chép cài đặt từ" cho Egg này phải là tùy chọn con của Nest đã chọn.',
            'has_children' => 'Egg này là cha của một hoặc nhiều Egg khác. Vui lòng xóa các Egg con trước khi xóa Egg này.',
        ],
        'variables' => [
            'env_not_unique' => 'Biến môi trường :name phải là duy nhất cho Egg này.',
            'reserved_name' => 'Biến môi trường :name được bảo vệ và không thể gán cho một biến.',
            'bad_validation_rule' => 'Quy tắc xác thực ":rule" không phải là quy tắc hợp lệ cho ứng dụng này.',
        ],
        'importer' => [
            'json_error' => 'Đã xảy ra lỗi khi phân tích tệp JSON: :error.',
            'file_error' => 'Tệp JSON được cung cấp không hợp lệ.',
            'invalid_json_provided' => 'Tệp JSON được cung cấp không đúng định dạng có thể nhận diện.',
        ],
    ],
    'subusers' => [
        'editing_self' => 'Không được phép chỉnh sửa tài khoản người dùng phụ của chính bạn.',
        'user_is_owner' => 'Bạn không thể thêm chủ sở hữu máy chủ làm người dùng phụ cho máy chủ này.',
        'subuser_exists' => 'Người dùng với địa chỉ email này đã được chỉ định làm người dùng phụ cho máy chủ này.',
    ],
    'databases' => [
        'delete_has_databases' => 'Không thể xóa máy chủ cơ sở dữ liệu có cơ sở dữ liệu đang hoạt động được liên kết.',
    ],
    'tasks' => [
        'chain_interval_too_long' => 'Thời gian tối đa cho một tác vụ chuỗi là 15 phút.',
    ],
    'locations' => [
        'has_nodes' => 'Không thể xóa vị trí có các nút đang hoạt động được liên kết.',
    ],
    'users' => [
        'node_revocation_failed' => 'Không thể thu hồi khóa trên <a href=":link">Node #:node</a>. :error',
    ],
    'deployment' => [
        'no_viable_nodes' => 'Không tìm thấy nút nào đáp ứng các yêu cầu được chỉ định cho triển khai tự động.',
        'no_viable_allocations' => 'Không tìm thấy phân bổ nào đáp ứng các yêu cầu cho triển khai tự động.',
    ],
    'api' => [
        'resource_not_found' => 'Tài nguyên yêu cầu không tồn tại trên máy chủ này.',
    ],
];
