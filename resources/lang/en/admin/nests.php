<?php

return [
    'notices' => [
        'created' => 'Một tổ mới, :name, đã được tạo thành công.',
        'deleted' => 'Đã xóa thành công tổ được yêu cầu khỏi Bảng điều khiển.',
        'updated' => 'Đã cập nhật thành công các tùy chọn cấu hình của tổ.',
    ],
    'eggs' => [
        'notices' => [
            'imported' => 'Đã nhập thành công Quả trứng này và các biến liên quan.',
            'updated_via_import' => 'Quả trứng này đã được cập nhật bằng tệp được cung cấp.',
            'deleted' => 'Đã xóa thành công quả trứng được yêu cầu khỏi Bảng điều khiển.',
            'updated' => 'Cấu hình quả trứng đã được cập nhật thành công.',
            'script_updated' => 'Tập lệnh cài đặt quả trứng đã được cập nhật và sẽ chạy mỗi khi cài đặt máy chủ.',
            'egg_created' => 'Một quả trứng mới đã được tạo thành công. Bạn cần khởi động lại bất kỳ daemon nào đang chạy để áp dụng quả trứng mới này.',
        ],
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => 'Biến ":variable" đã bị xóa và sẽ không còn khả dụng cho các máy chủ sau khi được xây dựng lại.',
            'variable_updated' => 'Biến ":variable" đã được cập nhật. Bạn cần xây dựng lại các máy chủ sử dụng biến này để áp dụng thay đổi.',
            'variable_created' => 'Biến mới đã được tạo thành công và gán cho quả trứng này.',
        ],
    ],
];
