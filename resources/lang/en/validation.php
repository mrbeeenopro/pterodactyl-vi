<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Dòng ngôn ngữ xác thực
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau chứa thông báo lỗi mặc định được sử dụng bởi
    | lớp trình xác thực. Một số quy tắc có nhiều phiên bản, chẳng hạn
    | như các quy tắc về kích thước. Bạn có thể tùy chỉnh các thông báo
    | tại đây.
    |
    */

    'accepted' => ':attribute phải được chấp nhận.',
    'active_url' => ':attribute không phải là URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => ':attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash' => ':attribute chỉ có thể chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num' => ':attribute chỉ có thể chứa chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => ':attribute phải nằm trong khoảng :min và :max.',
        'file' => ':attribute phải có kích thước từ :min đến :max kilobyte.',
        'string' => ':attribute phải có độ dài từ :min đến :max ký tự.',
        'array' => ':attribute phải có từ :min đến :max mục.',
    ],
    'boolean' => 'Trường :attribute phải là đúng hoặc sai.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'date_format' => ':attribute không khớp với định dạng :format.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải có :digits chữ số.',
    'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'email' => ':attribute phải là địa chỉ email hợp lệ.',
    'exists' => ':attribute được chọn không hợp lệ.',
    'file' => ':attribute phải là một tệp tin.',
    'filled' => 'Trường :attribute là bắt buộc.',
    'image' => ':attribute phải là một hình ảnh.',
    'in' => ':attribute được chọn không hợp lệ.',
    'in_array' => 'Trường :attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là một số nguyên.',
    'ip' => ':attribute phải là địa chỉ IP hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max kilobyte.',
        'string' => ':attribute không được lớn hơn :max ký tự.',
        'array' => ':attribute không được có nhiều hơn :max mục.',
    ],
    'mimes' => ':attribute phải là tệp có định dạng: :values.',
    'mimetypes' => ':attribute phải là tệp có định dạng: :values.',
    'min' => [
        'numeric' => ':attribute phải ít nhất là :min.',
        'file' => ':attribute phải ít nhất là :min kilobyte.',
        'string' => ':attribute phải ít nhất là :min ký tự.',
        'array' => ':attribute phải có ít nhất :min mục.',
    ],
    'not_in' => ':attribute được chọn không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'present' => 'Trường :attribute phải tồn tại.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values tồn tại.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi tất cả :values tồn tại.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không tồn tại.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có :values tồn tại.',
    'same' => ':attribute và :other phải khớp.',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải có kích thước :size kilobyte.',
        'string' => ':attribute phải có độ dài :size ký tự.',
        'array' => ':attribute phải chứa :size mục.',
    ],
    'string' => ':attribute phải là một chuỗi.',
    'timezone' => ':attribute phải là múi giờ hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'uploaded' => ':attribute tải lên thất bại.',
    'url' => 'Định dạng :attribute không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Thuộc tính xác thực tùy chỉnh
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau được sử dụng để thay thế các chỗ giữ vị trí
    | thành một cái gì đó dễ đọc hơn như Địa chỉ E-Mail thay cho "email".
    | Điều này giúp làm cho thông báo dễ hiểu hơn.
    |
    */

    'attributes' => [],

    // Logic xác thực nội bộ cho Pterodactyl
    'internal' => [
        'variable_value' => 'Biến :env',
        'invalid_password' => 'Mật khẩu được cung cấp không hợp lệ cho tài khoản này.',
    ],
];
