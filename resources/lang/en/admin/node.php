<?php

return [
    'validation' => [
        'fqdn_not_resolvable' => 'Tên miền FQDN hoặc địa chỉ IP được cung cấp không trỏ tới một địa chỉ IP hợp lệ.',
        'fqdn_required_for_ssl' => 'Một tên miền đầy đủ (FQDN) trỏ tới một địa chỉ IP công cộng là bắt buộc để sử dụng SSL cho node này.',
    ],
    'notices' => [
        'allocations_added' => 'Các phân bổ đã được thêm thành công vào node này.',
        'node_deleted' => 'Node đã được xóa thành công khỏi bảng điều khiển.',
        'location_required' => 'Bạn cần có ít nhất một vị trí được cấu hình trước khi có thể thêm node vào bảng điều khiển này.',
        'node_created' => 'Đã tạo node mới thành công. Bạn có thể tự động cấu hình daemon trên máy này bằng cách truy cập tab \'Cấu hình\'. <strong>Trước khi có thể thêm bất kỳ máy chủ nào, bạn cần phân bổ ít nhất một địa chỉ IP và cổng.</strong>',
        'node_updated' => 'Thông tin node đã được cập nhật. Nếu bất kỳ cài đặt daemon nào đã thay đổi, bạn cần khởi động lại nó để các thay đổi có hiệu lực.',
        'unallocated_deleted' => 'Đã xóa tất cả các cổng chưa được phân bổ cho <code>:ip</code>.',
    ],
];
